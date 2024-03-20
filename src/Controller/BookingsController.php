<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Component\AuthComponent;
use Cake\Routing\Router;
use Cake\View\Helper\PaginatorHelper;

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
        $query = $this->Bookings->find();
        $bookings = $this->paginate($query);

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
        $this->Lessons = $this->getTableLocator()->get('Lessons');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id=="1"){
                //debug($user->Students[0]);
                $query = $this->Bookings->find('all', [
                    'conditions'=> [
                        'student_id'=>$user->students[0]->student_id,
                    ],
                    'contain' => ['Packages', 'Lessons'],
                ]);
                $bookings = $this->paginate($query);
                
                //debug($bookings);
                foreach($bookings as $booking){
                    $booking->remain_count = 0;
                    $booking->upcoming = $booking->lessons[sizeof($booking->lessons)-1];
                    foreach($booking->lessons as $lesson){
                        if($lesson->lesson_start_time >= $date = date('Y-m-d H:i:s')){
                            $booking->remain_count++;
                            if($booking->upcoming->lesson_start_time < $lesson->lesson_start_time){
                                $booking->upcoming =  $lesson;
                                //debug($lesson);
                            }
                        }
                    }
                }
                debug($bookings);
                
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
        $this->Packages = $this->getTableLocator()->get('Packages');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Students', 'Packages', 'Invoices'],
        ]);
        $booking_lines = $this->Packages->find('all', [
            'conditions'=> [
                'booking_id' => $booking->booking_id,
            ],
            'contain' => ['Packages'],
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
        $this->Packages = $this->getTableLocator()->get('Packages');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Students', 'Packages', 'Invoices'],
        ]);
        $booking_lines = $this->Packages->find('all', [
            'conditions'=> [
                'booking_id' => $booking->booking_id,
            ],
            'contain' => ['Packages'],
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
        $this->Packages = $this->getTableLocator()->get('Packages');
        $this->Lessons = $this->getTableLocator()->get('Lessons');
        $this->Users = $this->getTableLocator()->get('Users');
        $query = $this->Packages->find();
        $packages = $this->paginate($query);
        //debug($packages);
        $booking = $this->Bookings->newEmptyEntity();
        $user=null;
        if(!isset($stage))$stage = 0;

        //After logging in redirect
        if($this->request->getSession()->read('booking.in_progress')=='true'){
            $stage= 2;
            $booking = $this->Bookings->find('all', [
                'conditions'=> [
                    'session_id' => $this->request->getSession()->read('booking.session_id'),
                    'student_id IS NULL',
                ],
                'contain' => ['Packages'],
            ])->first();
            if($this->viewBuilder()->getVar('loggedIn')){
                
                $user = $this->Authentication->getIdentity();
                if($user->user_id != NULL){
                    
                    $user = $this->Users->get($user->user_id, [
                        'contain' => ['Students'],
                    ]);
                }
            }
        }

        //Get user instance 
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            //debug($user);
            if($user->user_id != NULL){
                $user = $this->Users->get($user->user_id, [
                    'contain' => ['Students'],
                ]);
            }
        }
        
        //After logging in and post booking
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($stage==0) $stage=2;
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            //debug($booking);
            //debug($booking->student);

            if($this->viewBuilder()->getVar('loggedIn')){      
                $user = $this->Authentication->getIdentity();
                $user = $this->Users->get($user->user_id, [
                    'contain' => ['Students'],
                ]);
                $booking->student_id = $user->students[0]->student_id;
                //if($booking->student_id == NULL)$booking->student_id = 1;
                //debug($booking);

                $stage=0;
                $this->request->getSession()->delete('booking.in_progress');
                $this->request->getSession()->delete('booking.session_id');
            }     
            else{
                $session = $this->request->getSession();
                $booking->session_id = $this->request->getSession()->id(); 
            }
            $booking->is_paid=false;
            $booking->completed=true;
            $booking->booking_datetime=$booking->lessons[0]->lesson_start_time;
            
            if ($this->Bookings->save($booking, ['associated' => []])) {
                $this->Flash->success(__('The booking has been saved.'));                
            }

            $booking = $this->Bookings->get($booking->booking_id, [
                'contain' => ['Packages', 'Lessons'],
            ]);
            for($i = 0; $i<$booking->package->number_of_lessons; $i++) {
                $new_lesson = $this->Lessons->newEmptyEntity();
                $new_lesson->teacher_id = 1;
                $new_lesson->booking_id = $booking->booking_id;
                $new_lesson->lesson_start_time = $booking->booking_datetime->modify("+". $i ." week");
                //debug($new_lesson);
                $this->Lessons->save($new_lesson);
                
            }
            
            //debug($booking);

            if($booking->student_id==null){
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
            //$this->set(compact('booking', 'user', 'Packages', 'stage'));
            //return $this->redirect(['action' => 'add']);
            //$this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        //$Students = $this->Bookings->Students->find('list', ['limit' => 200])->all();
        //PaginatorHelper::setPaginated($bookings, []);
        $this->set(compact('booking', 'user', 'packages', 'stage'));
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
        $Students = $this->Bookings->Students->find('list', ['limit' => 200])->all();
        $this->set(compact('booking', 'Students'));
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
        $this->Packages = $this->getTableLocator()->get('Packages');
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id, [
            'contain' => ['Packages'],
        ]);
        foreach($booking->booking_lines as $key=>$value) {
            //debug()
            $this->Packages->delete($value);
        }
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }
        $this->redirect( Router::url( $this->referer(), true ) );
    }
}
