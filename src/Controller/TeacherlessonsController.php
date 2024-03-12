<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Teacherlessons Controller
 *
 * @property \App\Model\Table\TeacherlessonsTable $Teacherlessons
 */
class TeacherlessonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Teacherlessons->find()
            ->contain(['Teachers']);
        $teacherlessons = $this->paginate($query);

        $this->set(compact('teacherlessons'));
    }

    /**
     * View method
     *
     * @param string|null $id Teacherlesson id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teacherlesson = $this->Teacherlessons->get($id, contain: ['Teachers', 'Lessons']);
        $this->set(compact('teacherlesson'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teacherlesson = $this->Teacherlessons->newEmptyEntity();
        if ($this->request->is('post')) {
            $teacherlesson = $this->Teacherlessons->patchEntity($teacherlesson, $this->request->getData());
            if ($this->Teacherlessons->save($teacherlesson)) {
                $this->Flash->success(__('The teacherlesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teacherlesson could not be saved. Please, try again.'));
        }
        $teachers = $this->Teacherlessons->Teachers->find('list', limit: 200)->all();
        $this->set(compact('teacherlesson', 'teachers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Teacherlesson id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teacherlesson = $this->Teacherlessons->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teacherlesson = $this->Teacherlessons->patchEntity($teacherlesson, $this->request->getData());
            if ($this->Teacherlessons->save($teacherlesson)) {
                $this->Flash->success(__('The teacherlesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teacherlesson could not be saved. Please, try again.'));
        }
        $teachers = $this->Teacherlessons->Teachers->find('list', limit: 200)->all();
        $this->set(compact('teacherlesson', 'teachers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Teacherlesson id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teacherlesson = $this->Teacherlessons->get($id);
        if ($this->Teacherlessons->delete($teacherlesson)) {
            $this->Flash->success(__('The teacherlesson has been deleted.'));
        } else {
            $this->Flash->error(__('The teacherlesson could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
