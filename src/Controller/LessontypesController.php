<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lessontypes Controller
 *
 * @property \App\Model\Table\LessontypesTable $Lessontypes
 */
class LessontypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Lessontypes->find();
        $lessontypes = $this->paginate($query);

        $this->set(compact('lessontypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Lessontype id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessontype = $this->Lessontypes->get($id, contain: []);
        $this->set(compact('lessontype'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessontype = $this->Lessontypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $lessontype = $this->Lessontypes->patchEntity($lessontype, $this->request->getData());
            if ($this->Lessontypes->save($lessontype)) {
                $this->Flash->success(__('The lessontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lessontype could not be saved. Please, try again.'));
        }
        $this->set(compact('lessontype'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lessontype id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessontype = $this->Lessontypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessontype = $this->Lessontypes->patchEntity($lessontype, $this->request->getData());
            if ($this->Lessontypes->save($lessontype)) {
                $this->Flash->success(__('The lessontype has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lessontype could not be saved. Please, try again.'));
        }
        $this->set(compact('lessontype'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lessontype id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessontype = $this->Lessontypes->get($id);
        if ($this->Lessontypes->delete($lessontype)) {
            $this->Flash->success(__('The lessontype has been deleted.'));
        } else {
            $this->Flash->error(__('The lessontype could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
