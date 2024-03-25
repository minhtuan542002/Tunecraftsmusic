<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Component\AuthComponent;
use Cake\Routing\Router;
use Cake\View\Helper\PaginatorHelper;
use Cake\I18n\FrozenTime;
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
        $this->Users = $this->getTableLocator()->get('Users');

        $this->Authentication->allowUnauthenticated(['add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Users = $this->getTableLocator()->get('Users');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id==3){
                //debug($user->Students[0]);
                $query = $this->Bookings->find('all', [
                    'conditions'=> [
                        'Bookings.student_id IS NOT NULL',
                    ],
                    'contain' => ['Students', 'Lessons', 'Packages'],
                ]);
                $bookings = $this->paginate($query);
                //debug($bookings);
                
                foreach($bookings as $booking){
                    $booking->remain_count = 0;
                    $booking->upcoming = $booking->lessons[sizeof($booking->lessons)-1];
                    $booking->student->user = $this->Users->get($booking->student->user_id);
                    
                    foreach($booking->lessons as $lesson){
                        if($lesson->lesson_start_time >= date('Y-m-d H:i:s')){
                            $booking->remain_count++;
                            if($booking->upcoming->lesson_start_time > $lesson->lesson_start_time){
                                $booking->upcoming =  $lesson;
                                //debug($lesson);
                            }
                        }
                    }
                }
                debug($bookings);
            }
            else{
                return $this->redirect(['action' => 'my']);
            }
            
        }
        else{
            return $this->redirect("/");
        }
        
        $this->set(compact('bookings', 'user'));
    }
    
    /**
     * My method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function my()
    {
        $this->Users = $this->getTableLocator()->get('Users');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id==1){
                //debug($user->Students[0]);
                $query = $this->Bookings->find('all', [
                    'conditions'=> [
                        'Bookings.student_id IS NOT NULL',
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
                        if($lesson->lesson_start_time >= date('Y-m-d H:i:s')){
                            $booking->remain_count++;
                            if($booking->upcoming->lesson_start_time > $lesson->lesson_start_time){
                                $booking->upcoming =  $lesson;
                                debug($lesson);
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
        $this->Lessons = $this->getTableLocator()->get('Lessons');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Students', 'Packages'],
        ]);
        $lessons = $this->Lessons->find('all', [
            'conditions'=> [
                'booking_id' => $booking->booking_id,
            ],
        ])->all();
        $booking->student->user = $this->Users->get($booking->student->user_id);
        foreach($lessons as $lesson){
            if($lesson->lesson_start_time >= date('Y-m-d H:i:s')){
                $booking->remain_count++;
                $booking->upcoming =  $lesson;
                if($booking->upcoming->lesson_start_time > $lesson->lesson_start_time){
                    $booking->upcoming =  $lesson;
                }
            }
        }

        $this->set(compact('booking', 'lessons'));
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
        $this->Lessons = $this->getTableLocator()->get('Lessons');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Students', 'Packages'],
        ]);
        $lessons = $this->Lessons->find('all', [
            'conditions'=> [
                'booking_id' => $booking->booking_id,
            ],
        ])->all();
        $booking->student->user = $this->Users->get($booking->student->user_id);
        foreach($lessons as $lesson){
            if($lesson->lesson_start_time >= date('Y-m-d H:i:s')){
                $booking->remain_count++;
                $booking->upcoming =  $lesson;
                if($booking->upcoming->lesson_start_time > $lesson->lesson_start_time){
                    $booking->upcoming =  $lesson;
                }
            }
        }

        $this->set(compact('booking', 'lessons'));
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
                    'session_id IS NOT NULL',
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
            $start_date=$booking->booking_datetime;
            for($i = 0; $i<$booking->package->number_of_lessons; $i++) {
                $new_lesson = $this->Lessons->newEmptyEntity();
                $new_lesson->teacher_id = 1;
                $new_lesson->booking_id = $booking->booking_id;
                $new_lesson->lesson_start_time = $start_date->modify("+". $i ." week");
                //debug($new_lesson);
                $this->Lessons->save($new_lesson);
                
            }
            
            //debug($booking);

            if($booking->student_id==null){
                $stage=2;
                $session = $this->request->getSession();
                $session->write('booking.session_id', $booking->session_id);
                $session->write('booking.in_progress', 'true');
                //debug($user);
            }
            else{
                $stage=0;
                $this->request->getSession()->delete('booking.in_progress');
                $this->request->getSession()->delete('booking.session_id');
                return $this->redirect(['action' => 'my']);
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
        $this->Lessons = $this->getTableLocator()->get('Lessons');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Lessons'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            
            if ($this->Bookings->save($booking)) {
                $count =0;
                $start_date=$booking->booking_datetime;
                $lessons = $this->Lessons->find('all', [
                    'conditions'=> [
                        'booking_id' => $booking->booking_id,
                    ],
                ]);
                foreach($lessons as $new_lesson) {
                    $date= FrozenTime::now()->modify("+6 day");
                    if($new_lesson->lesson_start_time >= $date){
                        $lesson = $this->Lessons->get($new_lesson->lesson_id);
                        $lesson->lesson_start_time = $start_date->modify("+". $count*7 ." day");
                        if(!$this->Lessons->save($lesson)){
                            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
                        }
                        $count++;
                        
                    }
                    //$this->Flash->error(__('The booking could not be saved. Please, try again.'));
                }
                
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));

            
        }
        $Students = $this->Bookings->Students->find('list', ['limit' => 200])->all();
        $this->set(compact('booking', 'user'));
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
        $this->Lessons = $this->getTableLocator()->get('Lessons');
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id, [
            'contain' => ['Lessons'],
        ]);
        foreach($booking->lessons as $key=>$value) {
            //debug()
            $this->Lessons->delete($value);
        }
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }
        $this->redirect( Router::url( $this->referer(), true ) );
    }
    /**
     * Toggle payment
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function togglePaid($id = null)
    {
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id);
            $this->set('role_id', $user->role_id);
        }

        // Only allow role_id = 3 (admin)
        if ($this->viewBuilder()->getVar('role_id') !== 3) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        $this->request->allowMethod(['post', 'put']);
        $booking = $this->Bookings->get($id);
        $booking->is_paid = !$booking->is_paid;
        if ($this->Bookings->save($booking)) {
            $this->Flash->success(__('The booking payment has been update.'));
        } else {
            $this->Flash->error(__('The booking payment could not be updated. Please, try again.'));
        }
        $this->redirect( Router::url( $this->referer(), true ) );
    }
}
