<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Testimonials Controller
 *
 */
class TestimonialsController extends AppController
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
        if ($this->viewBuilder()->getVar('role_id') !== 3) {
            $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Testimonials->find();
        $testimonials = $query->all();

        $this->set(compact('testimonials'));
    }

    /**
     * View method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $testimonial = $this->Testimonials->get($id, contain: []);
        $this->set(compact('testimonial'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testimonial = $this->Testimonials->newEmptyEntity();
        if ($this->request->is('post')) {
            $testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->getData());
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
        }
        $this->set(compact('testimonial'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testimonial = $this->Testimonials->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testimonial = $this->Testimonials->patchEntity($testimonial, $this->request->getData());
            if ($this->Testimonials->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
        }
        $this->set(compact('testimonial'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testimonial = $this->Testimonials->get($id);
        if ($this->Testimonials->delete($testimonial)) {
            $this->Flash->success(__('The testimonial has been deleted.'));
        } else {
            $this->Flash->error(__('The testimonial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
