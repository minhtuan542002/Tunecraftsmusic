<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Component\AuthComponent;
use Cake\Routing\Router;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 * @method \App\Model\Entity\Booking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController
{
    public function initialize():void {
        parent::initialize();
        $loggedIn = false;
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $loggedIn = true;
        }
        $this->set('loggedIn', $loggedIn);

        $this->Authentication->allowUnauthenticated(['add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers'],
        ];
        $bookings = $this->paginate($this->Bookings);

        $this->set(compact('bookings'));
    }

    /**
     * All method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function all()
    {
        $this->Users = $this->getTableLocator()->get('Users');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->id, [
                'contain' => ['Customers'],
            ]);
            if($user->role_id=="C"){
                //debug($user->customers[0]);
                $bookings = $this->Bookings->find('all', [
                    'conditions'=> [
                        'customer_id'=>$user->customers[0]->id,
                    ],
                    'contain' => ['BookingLines'],
                ]);
            }
            else{
                return $this->redirect(['action' => 'index']);
            }
        }
        else{
            return $this->redirect("/");
        }
        
        $this->set(compact('bookings', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->BookingLines = $this->getTableLocator()->get('BookingLines');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Customers', 'BookingLines', 'Invoices'],
        ]);
        $booking_lines = $this->BookingLines->find('all', [
            'conditions'=> [
                'booking_id' => $booking->id,
            ],
            'contain' => ['Services'],
        ]);

        $this->set(compact('booking', 'booking_lines'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewOne($id = null)
    {
        $this->BookingLines = $this->getTableLocator()->get('BookingLines');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Customers', 'BookingLines', 'Invoices'],
        ]);
        $booking_lines = $this->BookingLines->find('all', [
            'conditions'=> [
                'booking_id' => $booking->id,
            ],
            'contain' => ['Services'],
        ]);

        $this->set(compact('booking', 'booking_lines'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Services = $this->getTableLocator()->get('Services');
        $this->BookingLines = $this->getTableLocator()->get('BookingLines');
        $this->Users = $this->getTableLocator()->get('Users');
        $services = $this->paginate($this->Services);
        $booking = $this->Bookings->newEmptyEntity();
        //debug($this->Authentication->getResult());
        //if($logged_in===true){ debug($this->Auth->user('id'));}
        //debug($this->request->getSession()->read('booking.session_id'));
        $user=null;
        if(!isset($stage))$stage = 0;

        /** 
        if($id!=null){
            $booking = $this->Bookings->get($id, [
                'contain' => ['BookingLines'],
            ]);
            $stage = 2;
        }
        */

        //After logging in redirect
        if($this->request->getSession()->read('booking.in_progress')=='true'){
            $stage= 2;
            $booking = $this->Bookings->find('all', [
                'conditions'=> [
                    'session_id' => $this->request->getSession()->read('booking.session_id'),
                    'customer_id IS NULL',
                ],
                'contain' => ['BookingLines'],
            ])->first();
            if($this->viewBuilder()->getVar('loggedIn')){
                $user = $this->Authentication->getIdentity();
                $user = $this->Users->get($user->id, [
                    'contain' => ['Customers'],
                ]);
                //$booking->customer_id=$user->customers[0]->id;
            }
            //debug($booking);
        }

        //Get user instance $this->viewBuilder()->getVar('loggedIn')
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->id, [
                'contain' => ['Customers'],
            ]);
            //$booking->customer_id=$user->customers[0]->id;
        }
        //debug($booking);
        //debug($_SERVER['REQUEST_METHOD'] == 'POST');
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($stage==0) $stage=2;
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());

            //debug($user);
            //debug($booking);
            //debug($this->request->getSession()->read('booking.in_progress'));
            if($this->viewBuilder()->getVar('loggedIn')){      
                $user = $this->Authentication->getIdentity();
                $user = $this->Users->get($user->id, [
                    'contain' => ['Customers'],
                ]);
                $booking->customer_id = $user->customers[0]->id;
                //debug($booking);

                $stage=0;
                $this->request->getSession()->delete('booking.in_progress');
                $this->request->getSession()->delete('booking.session_id');
            }     
            else{
                $session = $this->request->getSession();
                $booking->session_id = $this->request->getSession()->id(); 
            }
            $booking->service_completed=false;
            $booking->additional_notes="None";
                           
            $totalTime = 0;
            foreach($booking->booking_lines as $key=>$value) {
                if($value->no_of_unit >0){
                    $totalTime = $totalTime + $this->Services->get($key +1)->duration_minute;
                }
            }
            $booking->end_datetime= $booking->start_datetime->modify('+'.$totalTime.' minutes');
            

            if ($this->Bookings->save($booking, ['associated' => []])) {
                $this->Flash->success(__('The booking has been saved.'));                
            }

            foreach($booking->booking_lines as $key=>$value) {
                if($value->no_of_unit >0){
                    $new_booking_line = $this->BookingLines->newEmptyEntity();
                    $new_booking_line->service_id = $key +1;
                    $new_booking_line->booking_id = $booking->id;
                    $new_booking_line->no_of_unit = $value->no_of_unit;
                    $this->BookingLines->save($new_booking_line);
                    //debug($new_booking_line);
                }
            }
            $booking = $this->Bookings->get($booking->id, [
                'contain' => ['BookingLines'],
            ]);

            if($booking->customer_id==null){
                $stage=2;
                $session->write('booking.session_id', $booking->session_id);
                $session->write('booking.in_progress', 'true');
                //debug($user);
            }
            else{
                $stage=0;
                $this->request->getSession()->delete('booking.in_progress');
                $this->request->getSession()->delete('booking.session_id');
                return $this->redirect(['action' => 'all']);
            }
            //$this->set(compact('booking', 'user', 'services', 'stage'));
            //return $this->redirect(['action' => 'add']);
            //$this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        //$customers = $this->Bookings->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('booking', 'user', 'services', 'stage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $customers = $this->Bookings->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('booking', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->BookingLines = $this->getTableLocator()->get('BookingLines');
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id, [
            'contain' => ['BookingLines'],
        ]);
        foreach($booking->booking_lines as $key=>$value) {
            //debug()
            $this->BookingLines->delete($value);
        }
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }
        $this->redirect( Router::url( $this->referer(), true ) );
    }
}
