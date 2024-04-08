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
        $lesson = $this->Lessons->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson has been saved.'));

                return $this->redirect(['controller' => 'bookings', 'action' => 'index', $lesson->booking_id]);
            }
            debug($lesson);
            $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
        }
        $bookings = $this->Lessons->Bookings->find('list', limit: 200)->all();
        $teachers = $this->Lessons->Teachers->find('list', limit: 200)->all();
        $this->set(compact('lesson', 'bookings', 'teachers'));
    }
}
