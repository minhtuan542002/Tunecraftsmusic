<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons
 */
class LessonsController extends AppController
{
    protected array $paginate = [
        'limit' => 10000,
        'maxLimit' => 10000,
    ];
    
    /**
     * Initialize method
     * Authenticates permissions access
     * 
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('dashboard');

        $loggedIn = false;
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $loggedIn = true;
        }
        $this->set('loggedIn', $loggedIn);
        $this->Users = $this->fetchTable('Users');

       
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id);
            $this->set('role_id', $user->role_id);
        }

        // Only allow role_id = 3 (admin)
        // if ($this->viewBuilder()->getVar('role_id') !== 3) {
        //     $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        // }
        $this->Users = $this->fetchTable('Users');
        $this->Packages = $this->fetchTable('Packages');
        $this->Students = $this->fetchTable('Students');
        $this->Blockers = $this->fetchTable('Blockers');
        $user = $this->Users->get($user->user_id, [
            'contain' => ['Teachers'],
        ]);
        if($user->role_id!=1) {
            $query = $this->Blockers->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'teacher_id' => $user->teachers[0]->teacher_id,
                ],
            ]);
            $blockers = $this->paginate($query);
            $this->set('blockers', $blockers);
        }
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessons = [];
        $lesson = $this->Lessons->get($id);
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id!=1){
                return $this->redirect(['action'=>'edit_admin', $id]);
            }

            $query = $this->Lessons->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'Bookings.student_id IS NOT NULL',
                    'Bookings.student_id' => $user->students[0]->student_id,
                    'lesson_start_time >=' => FrozenTime::now()->modify('+7 days'),
                ],
                'contain' => ['Bookings'],
            ]);
            $lessons = $this->paginate($query);
            $query = $this->Lessons->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'Bookings.student_id IS NOT NULL',
                    'Bookings.student_id <>' => $user->students[0]->student_id,
                    'lesson_start_time <=' => FrozenTime::now()->modify('+7 days'),
                ],
                'contain' => ['Bookings'. 'Bookings.Packages'],
            ]);
            $block_lessons = $this->paginate($query);
            foreach ($block_lessons as $line) {
                $package = $line->booking->package;
                $line->duration = $package->lesson_duration_minutes;
                $end_datetime = $line->lesson_start_time;
                $line->lesson_end_time = $end_datetime->modify(
                    "+". $package->lesson_duration_minutes ." minutes");
            }

            $query = $this->Blockers->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'teacher_id' => '1',
                ],
                'contain' => [
                    'Bookings', 
                    'Bookings.Packages', 
                    'Bookings.Students',
                    'Bookings.Students.Users'
                ],
            ]);
            $blockers = $this->paginate($query);
            $this->set('blockers', $blockers);
            
            foreach ($lessons as $line) {
                $package = $line->booking->package;
                $student_user = $line->booking->student;
                $student = $student_user->user;
                //debug($student);
                //debug($student_user);
                $line->student_full_name = $student->first_name." ".$student->last_name;
                $line->duration = $package->lesson_duration_minutes;
                $line->student_name = $student->first_name;
                $end_datetime = $line->lesson_start_time;
                $line->lesson_end_time = $end_datetime->modify(
                    "+". $package->lesson_duration_minutes ." minutes");
                if($line->lesson_id == $id){
                    $lesson = $line;
                    //debug($lesson);
                }
            }
            
            if($lesson->lesson_start_time <= FrozenTime::now()->modify('+7 days')){
                return $this->redirect(['action'=>'my']);
            }
            //debug($lesson);
            if ($this->request->is(['patch', 'post', 'put'])) {
                //debug($lesson);
                $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
                if ($this->Lessons->save($lesson)) {
                    $this->Flash->success(__('The lesson has been saved.'));

                    // Retrieve the student email
                    $reschedule_notification = $this->Lessons->get($lesson->lesson_id, [
                        'conditions'=> [
                            'teacher_id IS NOT NULL',
                            'teacher_id' => $user->teachers[0]->teacher_id,
                            'Bookings.student_id IS NOT NULL',
                        ],
                        'contain' => [
                            'Bookings', 
                            'Bookings.Students',
                            'Bookings.Students.Users',
                        ],
                    ]);

                    // Send the email notification
                    $this->sendRescheduleNotificationEmail($reschedule_notification->booking->student->user->email, [
                        'first_name' => $reschedule_notification->booking->student->user->first_name,
                        'last_name' => $reschedule_notification->booking->student->user->last_name,
                        'lesson_date' => $reschedule_notification->lesson_start_time->format('Y-m-d'),
                        'lesson_time' => $reschedule_notification->lesson_start_time->format('H:i')
                    ]);

                    return $this->redirect(['action'=>'edit', $id]);
                    //return $this->redirect(['controller' => 'bookings', 'action' => 'view', $lesson->booking_id]);
                }
                //debug($lesson);
                else $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
            }
            $this->set(compact('lesson', 'lessons', 'blockers', 'block_lessons'));
        }
    }

    /**
     * EditAdmin method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editAdmin($id = null)
    {
        
        $lessons = [];
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Teachers'],
            ]);
            if($user->role_id==1){
                return $this->redirect(['action'=>'edit', $id]);
            }

            $query = $this->Lessons->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'teacher_id' => $user->teachers[0]->teacher_id,
                    'Bookings.student_id IS NOT NULL',
                ],
                'contain' => [
                    'Bookings', 
                    'Bookings.Packages', 
                    'Bookings.Students',
                    'Bookings.Students.Users'
                ],
            ]);
            $lessons = $this->paginate($query);
            //debug($lessons);
            foreach ($lessons as $line) {
                $package = $line->booking->package;
                $student_user = $line->booking->student;
                $student = $student_user->user;
                //debug($student);
                //debug($student_user);
                $line->student_full_name = $student->first_name." ".$student->last_name;
                $line->duration = $package->lesson_duration_minutes;
                $line->student_name = $student->first_name;
                $end_datetime = $line -> lesson_start_time;
                $line->lesson_end_time = $end_datetime->modify(
                    "+". $package->lesson_duration_minutes ." minutes");
                if($line->lesson_id == $id){
                    $lesson = $line;
                }
            }
            //debug($lesson);
            if ($this->request->is(['patch', 'post', 'put'])) {
                //debug($lesson);
                $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
                if ($this->Lessons->save($lesson)) {
                    $this->Flash->success(__('The lesson has been saved.'));

                    // Retrieve the student email
                    $reschedule_notification = $this->Lessons->get($lesson->lesson_id, [
                        'conditions'=> [
                            'teacher_id IS NOT NULL',
                            'teacher_id' => $user->teachers[0]->teacher_id,
                            'Bookings.student_id IS NOT NULL',
                        ],
                        'contain' => [
                            'Bookings', 
                            'Bookings.Students',
                            'Bookings.Students.Users',
                        ],
                    ]);

                    // Send the email notification
                    $this->sendRescheduleNotificationEmail($reschedule_notification->booking->student->user->email, [
                        'first_name' => $reschedule_notification->booking->student->user->first_name,
                        'last_name' => $reschedule_notification->booking->student->user->last_name,
                        'lesson_date' => $reschedule_notification->lesson_start_time->format('l d M Y'),
                        'lesson_time' => $reschedule_notification->lesson_start_time->format('H:ia'),
                    ]);

                    $this->Flash->success(__('Lesson rescheduled email sent to: ' . $reschedule_notification->booking->student->user->email));

                    return $this->redirect(['action'=>'edit_admin', $id]);
                    //return $this->redirect(['controller' => 'bookings', 'action' => 'view', $lesson->booking_id]);
                }
                //debug($lesson);
                else $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
            }
            $this->set(compact('lesson', 'lessons'));
        }
    }

    /**
     * Index method
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function index()
    {
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Teachers'],
            ]);
            if($user->role_id==1){
                return $this->redirect("/");
            }
            //debug($user);

            $query = $this->Lessons->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'teacher_id' => $user->teachers[0]->teacher_id,
                    'Bookings.student_id IS NOT NULL',
                ],
                'contain' => [
                    'Bookings', 
                    'Bookings.Packages', 
                    'Bookings.Students',
                    'Bookings.Students.Users'
                ],
            ]);
            $lessons = $this->paginate($query);
            //debug($blockers);
            foreach ($lessons as $lesson) {
                $package = $lesson->booking->package;
                $student_user = $lesson->booking->student;
                $student = $student_user->user;
                //debug($student);
                //debug($student_user);
                $lesson->student_name = $student->first_name;
                $end_datetime = $lesson -> lesson_start_time;
                $lesson->lesson_end_time = $end_datetime->modify(
                    "+". $package->lesson_duration_minutes ." minutes");
            }
            //debug($lessons);
            if ($this->request->is(['patch', 'post', 'put'])) {
                //debug($lesson);
                $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
                if ($this->Lessons->save($lesson)) {
                    $this->Flash->success(__('The lesson has been saved.'));

                    return $this->redirect(['controller' => 'bookings', 'action' => 'view', $lesson->booking_id]);
                }
                //debug($lesson);
                $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
            }
            $this->set(compact('lessons'));
        }        
    }

    /**
     * Index for customer method
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function my()
    {
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id!=1){
                return $this->redirect(['action' => 'index']);
            }
            //debug($user);

            $query = $this->Lessons->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'Bookings.student_id IS NOT NULL',
                    'Bookings.student_id' => $user->students[0]->student_id,
                ],
                'contain' => [
                    'Bookings', 
                    'Bookings.Packages', 
                    'Bookings.Students',
                    'Bookings.Students.Users'
                ],
            ]);
            $lessons = $this->paginate($query);
            //debug($blockers);
            foreach ($lessons as $lesson) {
                $package = $lesson->booking->package;
                $student_user = $lesson->booking->student;
                $student = $student_user->user;
                //debug($student);
                //debug($student_user);
                $lesson->student_name = $student->first_name;
                $end_datetime = $lesson -> lesson_start_time;
                $lesson->lesson_end_time = $end_datetime->modify(
                    "+". $package->lesson_duration_minutes ." minutes");
            }
            //debug($lessons);
            if ($this->request->is(['patch', 'post', 'put'])) {
                //debug($lesson);
                $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
                if ($this->Lessons->save($lesson)) {
                    $this->Flash->success(__('The lesson has been saved.'));

                    return $this->redirect(['controller' => 'bookings', 'action' => 'view', $lesson->booking_id]);
                }
                //debug($lesson);
                $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
            }
            $this->set(compact('lessons'));
        }        
    }

    private function sendRescheduleNotificationEmail($recipientEmail, $lessonDetails) {
        // Prepare the email
        $email = new Mailer('default');
        $email
            ->setEmailFormat('both')
            ->setTo($recipientEmail)
            ->setSubject('Lesson Rescheduled');
        
        // Select email template
        $email
            ->viewBuilder()
            ->setTemplate('reschedule_lesson');
        
        // Transfer required view variables to email template
        $email
            ->setViewVars([
                'first_name' => $lessonDetails['first_name'],
                'last_name' => $lessonDetails['last_name'],
                'lesson_date' => $lessonDetails['lesson_date'],
                'lesson_time' => $lessonDetails['lesson_time']
            ]);
        
        // Send email
        if (!$email->deliver()) {
            // Handle any errors in email delivery
            $this->Flash->error('We encountered an issue when sending the reschedule notification email. Please try again.');
            return false;
        }
        return true;
    }
    
    
}
