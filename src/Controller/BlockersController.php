<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;

/**
 * Blockers Controller
 *
 * @property \App\Model\Table\BlockersTable $Blockers
 */
class BlockersController extends AppController
{
    protected array $paginate = [
        'limit' => 10000,
        'maxLimit' => 10000,
    ];
    
    public function initialize():void {
        parent::initialize();
        $this->viewBuilder()->setLayout('dashboard');
        
        // Load Authentication component
        $this->loadComponent('Authentication.Authentication');

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
            $this->set('role_id', $user->role_id);
        }

        $this->Users = $this->fetchTable('Users');
        $this->Packages = $this->fetchTable('Packages');
        $this->Students = $this->fetchTable('Students');
        $this->Lessons = $this->fetchTable('Lessons');
        $lessons = [];
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Teachers'],
            ]);

            $query = $this->Lessons->find('all', [
                'conditions'=> [
                    'teacher_id IS NOT NULL',
                    'teacher_id' => $user->teachers[0]->teacher_id,
                    'Bookings.student_id IS NOT NULL',
                ],
                'contain' => ['Bookings'],
            ]);
            $lessons = $this->paginate($query);
            //debug($lessons);
            foreach ($lessons as $line) {
                $package = $this->Packages->get($line->booking->package_id);
                $student_user = $this->Students->get($line->booking->student_id);
                $student = $this->Users->get($student_user->user_id);
                //debug($student);
                //debug($student_user);
                $line->student_full_name = $student->first_name." ".$student->last_name;
                $line->duration = $package->lesson_duration_minutes;
                $line->student_name = $student->first_name;
                $end_datetime = $line -> lesson_start_time;
                $line->lesson_end_time = $end_datetime->modify(
                    "+". $package->lesson_duration_minutes ." minutes");
            }
        }
        $this->set('lessons', $lessons);
        $query = $this->Blockers->find('all', [
            'conditions'=> [
                'teacher_id IS NOT NULL',
                'teacher_id' => $user->teachers[0]->teacher_id,
            ],
        ]);
        $blockers = $this->paginate($query);
        $this->set('blockers', $blockers);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index()
    // {
    //     $query = $this->Blockers->find()
    //         ->contain(['Teachers']);
    //     $blockers = $this->paginate($query);

    //     $this->set(compact('blockers'));
    // }

    /**
     * View method
     *
     * @param string|null $id Blocker id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $blocker = $this->Blockers->get($id, contain: ['Teachers']);
    //     $this->set(compact('blocker'));
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Teachers'],
            ]);
            if($user->role_id==1){
                return $this->redirect("/");
            }
            $blocker = $this->Blockers->newEmptyEntity();
            if ($this->request->is('post')) {
                $blocker = $this->Blockers->patchEntity($blocker, $this->request->getData());
                $blocker->recurring = false;
                $blocker->teacher_id = 1;
                if ($this->Blockers->save($blocker)) {
                    $this->Flash->success(__('The blocker has been saved.'));

                    return $this->redirect(['action' => 'edit', $blocker->blocker_id]);
                }
                $this->Flash->error(__('The blocker could not be saved. Please, try again.'));
            }
            $teachers = $this->Blockers->Teachers->find('list', limit: 200)->all();
        }
        $this->set(compact('blocker', 'teachers'));
    }

    /**
     * Add recurring method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addRecur()
    {
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Teachers'],
            ]);
            if($user->role_id==1){
                return $this->redirect("/");
            }
            $blocker = $this->Blockers->newEmptyEntity();
            if ($this->request->is('post')) {
                $blocker = $this->Blockers->patchEntity($blocker, $this->request->getData());
                //debug($blocker);
                $frozenTime = new FrozenTime('now');
                $daysToAdd = ($blocker->week_day - $frozenTime->format('N') + 7) % 7;
                $frozenTime = $frozenTime->addDays($daysToAdd);
                $frozenTime = FrozenTime::parse($frozenTime->format('Y-m-d') . ' ' . $blocker->start_time_time .':00');
                $blocker->start_time = $frozenTime;
                $frozenTime = FrozenTime::parse($frozenTime->format('Y-m-d') . ' ' . $blocker->end_time_time .':00');
                $blocker->end_time = $frozenTime;
                $blocker->recurring = true;
                $blocker->teacher_id = 1;
                //debug($blocker);
                if ($this->Blockers->save($blocker)) {
                    $this->Flash->success(__('The blocker has been saved.'));

                    return $this->redirect(['action' => 'edit', $blocker->blocker_id]);
                }
                $this->Flash->error(__('The blocker could not be saved. Please, try again.'));
            }
            $teachers = $this->Blockers->Teachers->find('list', limit: 200)->all();
        }
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
        if($this->viewBuilder()->getVar('loggedIn')){
            $user = $this->Authentication->getIdentity();
            $user = $this->Users->get($user->user_id, [
                'contain' => ['Teachers'],
            ]);
            if($user->role_id==1){
                return $this->redirect("/");
            }
            $blocker = $this->Blockers->get($id, contain: []);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $blocker = $this->Blockers->patchEntity($blocker, $this->request->getData());
                //debug($blocker);
                if ($this->Blockers->save($blocker)) {
                    $this->Flash->success(__('The blocker has been saved.'));
                    //debug($blocker);
                    return $this->redirect(['action' => 'edit', $blocker->blocker_id]);
                }
                $this->Flash->error(__('The blocker could not be saved. Please, try again.'));
            }
            $teachers = $this->Blockers->Teachers->find('list', limit: 200)->all();
            $this->set(compact('blocker', 'teachers'));
        }
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

        return $this->redirect(['controller' => 'lessons', 'action' => 'index']);
    }
}
