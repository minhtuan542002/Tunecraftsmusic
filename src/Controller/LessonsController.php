<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons
 */
class LessonsController extends AppController
{
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
        if ($this->viewBuilder()->getVar('role_id') !== 3) {
            $this->redirect(['controller' => 'Pages', 'action' => 'display']);
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
        $this->Users = $this->fetchTable('Users');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id==1){
                return $this->redirect("/");
            }
        }

        $lesson = $this->Lessons->get($id, [
            'contain' => [],
        ]);
        //debug($lesson);
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
        $this->set(compact('lesson'));
    }

    /**
     * Index method
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function index()
    {
        $this->Users = $this->fetchTable('Users');
        $this->Packages = $this->fetchTable('Packages');
        $this->Students = $this->fetchTable('Students');
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Students'],
            ]);
            if($user->role_id==1){
                return $this->redirect("/");
            }
        }

        $query = $this->Lessons->find('all', ['contain' => ['Bookings'],]);
        $lessons = $this->paginate($query);
        foreach ($lessons as $lesson) {
            $package = $this->Packages->get($lesson->booking->package_id);
            $student_user = $this->Students->get($lesson->booking->student_id);
            $student = $this->Users->get($student_user->student_id);
            debug($student);
            debug($student_user);
            $lesson->student_name = $student->first_name;
            $end_datetime = $lesson -> lesson_start_time;
            $lesson->lesson_end_time = $end_datetime->modify(
                "+". $package->lesson_duration_minutes ." minutes");
        }
        debug($lessons);
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
