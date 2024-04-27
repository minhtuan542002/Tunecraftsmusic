<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Blockers Controller
 *
 * @property \App\Model\Table\BlockersTable $Blockers
 */
class BlockersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Blockers->find()
            ->contain(['Teachers']);
        $blockers = $this->paginate($query);

        $this->set(compact('blockers'));
    }

    /**
     * View method
     *
     * @param string|null $id Blocker id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blocker = $this->Blockers->get($id, contain: ['Teachers']);
        $this->set(compact('blocker'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blocker = $this->Blockers->newEmptyEntity();
        if ($this->request->is('post')) {
            $blocker = $this->Blockers->patchEntity($blocker, $this->request->getData());
            if ($this->Blockers->save($blocker)) {
                $this->Flash->success(__('The blocker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blocker could not be saved. Please, try again.'));
        }
        $teachers = $this->Blockers->Teachers->find('list', limit: 200)->all();
        $this->set(compact('blocker', 'teachers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blocker id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blocker = $this->Blockers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blocker = $this->Blockers->patchEntity($blocker, $this->request->getData());
            if ($this->Blockers->save($blocker)) {
                $this->Flash->success(__('The blocker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blocker could not be saved. Please, try again.'));
        }
        $teachers = $this->Blockers->Teachers->find('list', limit: 200)->all();
        $this->set(compact('blocker', 'teachers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blocker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blocker = $this->Blockers->get($id);
        if ($this->Blockers->delete($blocker)) {
            $this->Flash->success(__('The blocker has been deleted.'));
        } else {
            $this->Flash->error(__('The blocker could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
