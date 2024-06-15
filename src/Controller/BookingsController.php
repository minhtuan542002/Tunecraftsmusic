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
    protected array $paginate = [
        'limit' => 10000,
        'maxLimit' => 10000,
    ];

    public function initialize():void {
        parent::initialize();
        
        // Load Authentication component
        $this->loadComponent('Authentication.Authentication');

        // Allow unauthenticated access to specific actions
        $this->Authentication->allowUnauthenticated(['add']);

        // Get Users Table
        $this->Users = $this->fetchTable('Users');

        // Load other components or configurations as needed
        $loggedIn = false;
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $loggedIn = true;
        }

        $this->set('loggedIn', $loggedIn);
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id);
            $this->role_id = $user->role_id;
            $this->user_id = $user->user_id;
            $this->set('role_id', $user->role_id);
            $this->set('user_id', $user->user_id);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Users = $this->fetchTable('Users');
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
                    'contain' => ['Students', 'Lessons', 'Packages', 'Students.Users'],
                ]);
                $bookings = $query->all();
                //debug($bookings);
                
                foreach($bookings as $booking){
                    $booking->remain_count = 0;
                    $booking->upcoming = $booking->lessons[sizeof($booking->lessons)-1];
                    
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
                //debug($bookings);
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
        $this->Users = $this->fetchTable('Users');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id==1){
                //debug($user->Students[0]);
                $query = $this->Bookings->find('all', [
                    'conditions'=> [
                        'student_id IS NOT NULL',
                        'student_id'=>$user->students[0]->student_id,
                    ],
                    'contain' => ['Packages', 'Lessons'],
                ]);
                $bookings = $query->all();
                
                //debug($bookings);
                foreach($bookings as $booking){
                    $booking->remain_count = 0;
                    $booking->upcoming = $booking->lessons[sizeof($booking->lessons)-1];
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
                //debug($bookings);
                
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
        if($this->role_id==3){
            $this->Lessons = $this->fetchTable('Lessons');
            $booking = $this->Bookings->get($id, [
                'contain' => ['Students', 'Packages', 'Students.Users'],
            ]);
            $lessons = $this->Lessons->find('all', [
                'conditions'=> [
                    'booking_id' => $booking->booking_id,
                ],
            ])->all();
            foreach($lessons as $lesson){
                if($lesson->lesson_start_time >= date('Y-m-d H:i:s')){
                    $booking->remain_count++;
                    $booking->upcoming =  $lesson;
                    if($booking->upcoming->lesson_start_time > $lesson->lesson_start_time){
                        $booking->upcoming =  $lesson;
                    }
                }
            }
        }    
        else{
            return $this->redirect(['action' => 'my']);
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
        $this->Lessons = $this->fetchTable('Lessons');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Students', 'Packages'],
        ]);
        $lessons = $this->Lessons->find('all', [
            'conditions'=> [
                'booking_id' => $booking->booking_id,
            ],
        ])->all();
        if ($booking->student_id == $this->user_id) {
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
        }
        else{
            return $this->redirect(['action' => 'my']);
        }

        $this->set(compact('booking', 'lessons'));
    }

    /**
     * Add method 
     * Only serve one teacher, need to reconfigure to do otherwise
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Packages = $this->fetchTable('Packages');
        $this->Students = $this->fetchTable('Students');
        $this->Blockers = $this->fetchTable('Blockers');
        $this->Lessons = $this->fetchTable('Lessons');
        //Get all blocker elements ------------------------------------------------
        $lessons = [];
        $query = $this->Lessons->find('all', [
            'conditions'=> [
                'teacher_id IS NOT NULL',
                'teacher_id' => '1',
                'Bookings.student_id IS NOT NULL',
                'lesson_start_time >=' => (new FrozenTime('now'))->modify('+6 days'),
            ],
            'contain' => [
                'Bookings', 
                'Bookings.Packages',
                'Bookings.Students',
                'Bookings.Students.Users',
            ],
        ]);
        $lessons = $query->all();
        //debug($lessons);
        foreach ($lessons as $line) {
            $package = $line->booking->package;
            $student_user = $line->booking->student;
            $student = $line->booking->student->user;
            //debug($student);
            //debug($student_user);
            $line->student_full_name = $student->first_name." ".$student->last_name;
            $line->duration = $package->lesson_duration_minutes;
            $line->student_name = $student->first_name;
            $end_datetime = $line -> lesson_start_time;
            $line->lesson_end_time = $end_datetime->modify(
                "+". $package->lesson_duration_minutes ." minutes");
        }
        $this->set('lessons', $lessons);
        $query = $this->Blockers->find('all', [
            'conditions'=> [
                'teacher_id IS NOT NULL',
                'teacher_id' => '1',
            ],
        ]);
        $blockers = $query->all();
        $this->set('blockers', $blockers);

        //Actual booking logic start--------------------------------------------------
        $this->Users = $this->fetchTable('Users');
        $query = $this->Packages->find('all', [
            'conditions'=> [
                'is_deleted IS NOT NULL',
                'is_deleted' => false,
            ],
        ]);
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
        
        //When request method is POST or form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($stage==0) $stage=2;
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());

            //After logging in and post booking
            if($this->viewBuilder()->getVar('loggedIn')){
                $user = $this->Authentication->getIdentity();
                $user = $this->Users->get($user->user_id, [
                    'contain' => ['Students'],
                ]);

                //Get the booking instance temporary data saved
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
                $booking = $this->Bookings->get($booking->booking_id, [
                    'contain' => ['Packages', 'Lessons'],
                ]);
                if(sizeof($booking->lessons) != $booking->package->number_of_lessons){
                    $start_date=$booking->booking_datetime;
                    for($i = 0; $i < $booking->package->number_of_lessons; $i++) {
                        $new_lesson = $this->Lessons->newEmptyEntity();
                        $new_lesson->teacher_id = 1;
                        $new_lesson->booking_id = $booking->booking_id;

                        //Check if this week time is blocked and skip to next week
                        $is_blocked = true;
                        while($is_blocked){
                            $end_date = $start_date;
                            $end_date->modify("+". 
                                $booking->package->lesson_duration_minutes ." minutes");
                            $query = $this->Lessons->find('all', [
                                'conditions'=> [
                                    'teacher_id IS NOT NULL',
                                    'teacher_id' => '1',
                                    'Bookings.student_id IS NOT NULL',
                                    'lesson_start_time <=' => $end_date,
                                ],
                                'contain' => ['Bookings', 'Bookings.Packages'],
                            ]);
                            $block_lesson = $query->all();
                            $is_blocked = false;
                            foreach($block_lesson as $line) {
                                $package_line = $line->booking->package;
                                $line_end = $line->lesson_start_time;
                                $line_end->modify("+". 
                                    $package_line->lesson_duration_minutes ." minutes");
                                if($line_end >= $start_date) {
                                    $is_blocked = true;
                                    break;
                                }
                            }
                            
                            $query = $this->Blockers->find('all', [
                                'conditions'=> [
                                    'teacher_id IS NOT NULL',
                                    'teacher_id' => '1',
                                    'start_time <' => $end_date,
                                    'end_time >' => $start_date,
                                ],
                            ]);
                            $block_blockers = $query->all();
                            if(sizeof($block_blockers) != 0){
                                $is_blocked = true;
                            }
                            if($is_blocked){
                                $start_date = $start_date->modify("+". 1 ." week");
                            }
                        }
                        $new_lesson->lesson_start_time = $start_date;
                        $this->Lessons->save($new_lesson);
                        $start_date = $start_date->modify("+". 1 ." week");
                    }
                }            
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
                $this->Flash->success(__('The new booking has been saved.'));
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
        $this->Lessons = $this->fetchTable('Lessons');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Lessons'],
        ]);
        //debug($booking);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            
            if ($this->Bookings->save($booking)) {
                // $count =0;
                // $start_date=$booking->booking_datetime;
                // $lessons = $this->Lessons->find('all', [
                //     'conditions'=> [
                //         'booking_id' => $booking->booking_id,
                //     ],
                // ]);
                // foreach($lessons as $new_lesson) {
                //     $date= FrozenTime::now()->modify("+6 day");
                //     if($new_lesson->lesson_start_time >= $date){
                //         $lesson = $this->Lessons->get($new_lesson->lesson_id);
                //         $lesson->lesson_start_time = $start_date->modify("+". $count*7 ." day");
                //         if(!$this->Lessons->save($lesson)){
                //             $this->Flash->error(__('The booking could not be saved. Please, try again.'));
                //         }
                //         $count++;
                        
                //     }
                //     //$this->Flash->error(__('The booking could not be saved. Please, try again.'));
                // }
                
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'view_one', $booking->booking_id]);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));

            
        }
        $Students = $this->Bookings->Students->find('list', ['limit' => 200])->all();
        $this->set(compact('booking'));
    }

    /**
     * Edit admin method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editAdmin($id = null)
    {
        $this->Lessons = $this->fetchTable('Lessons');
        $booking = $this->Bookings->get($id, [
            'contain' => ['Lessons'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            
            if ($this->Bookings->save($booking)) {
                // $count =0;
                // $start_date=$booking->booking_datetime;
                // $lessons = $this->Lessons->find('all', [
                //     'conditions'=> [
                //         'booking_id' => $booking->booking_id,
                //     ],
                // ]);
                // foreach($lessons as $new_lesson) {
                //     $date= FrozenTime::now()->modify("+6 day");
                //     if($new_lesson->lesson_start_time >= $date){
                //         $lesson = $this->Lessons->get($new_lesson->lesson_id);
                //         $lesson->lesson_start_time = $start_date->modify("+". $count*7 ." day");
                //         if(!$this->Lessons->save($lesson)){
                //             $this->Flash->error(__('The booking could not be saved. Please, try again.'));
                //         }
                //         $count++;
                        
                //     }
                //     //$this->Flash->error(__('The booking could not be saved. Please, try again.'));
                // }
                
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'view', $booking->booking_id]);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));

            
        }
        $Students = $this->Bookings->Students->find('list', ['limit' => 200])->all();
        $this->set(compact('booking'));
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
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id);
            $this->set('role_id', $user->role_id);
        }

        // Only allow role_id = 3 (admin)
        if ($this->viewBuilder()->getVar('role_id') !== 3) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        
        $this->Lessons = $this->fetchTable('Lessons');
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
