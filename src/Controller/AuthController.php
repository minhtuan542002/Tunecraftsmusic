<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;

/**
 * Auth Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class AuthController extends AppController
{

    /**
     * @var \App\Model\Table\UsersTable $Users
     */
    private $Users;

    /**
     * Controller initialize override
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('default');

        // By default, CakePHP will (sensibly) default to preventing users from accessing any actions on a controller.
        // These actions, however, are typically required for users who have not yet logged in.
        $this->Authentication->allowUnauthenticated(['resetPassword', 'login', 'register', 'forgetPassword']);

        // CakePHP loads the model with the same name as the controller by default.
        // Since we don't have an Auth model, we'll need to load "Users" model when starting the controller manually.
        $this->Users = $this->fetchTable('Users');
        $this->Students = $this->fetchTable('Students');

        // set local variable user_id
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
     * Register method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity(['associated' => ['Students']]);
        $student = $this->Students->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['associated' => ['Students']]);
            // set default role on register to student (role_id = 1)
            $user->role_id = 1;
            //debug($user);

            if ($this->Users->save($user, ['associated' => ['Students']])) {
                $student->user_id = $user->user_id;
                $this->Students->save($student);
                $this->Flash->success('You have been registered. Please log in. ');

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('The user could not be registered. Please, try again.');
        }
        $this->set(compact('user'));
    }

    /**
     * Forget Password method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful email send, renders view otherwise.
     */
    public function forgetPassword()
    {
        if ($this->request->is('post')) {
            // Retrieve the user entity by provided email address
            $user = $this->Users->findByEmail($this->request->getData('email'))->first();
            if ($user) {
                // Set nonce and expiry date
                $user->nonce = Security::randomString(128);
                $user->nonce_expiry = new FrozenTime('7 days');
                if ($this->Users->save($user)) {
                    // Now let's send the password reset email
                    $mailer = new Mailer('default');

                    // email basic config
                    $mailer
                        ->setEmailFormat('both')
                        ->setTo($user->email)
                        ->setSubject('Reset your account password');

                    // select email template
                    $mailer
                        ->viewBuilder()
                        ->setTemplate('reset_password');

                    // transfer required view variables to email template
                    $mailer
                        ->setViewVars([
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'nonce' => $user->nonce,
                            'email' => $user->email
                        ]);

                    //Send email
                    if (!$mailer->deliver()) {
                        // Just in case something goes wrong when sending emails
                        $this->Flash->error('We have encountered an issue when sending you emails. Please try again. ');
                        return $this->render();  // Skip the rest of the controller and render the view
                    }
                } else {
                    // Just in case something goes wrong when saving nonce and expiry
                    $this->Flash->error('We are having issue to reset your password. Please try again. ');
                    return $this->render();  // Skip the rest of the controller and render the view
                }
            }

            /*
             * **This is a bit of a special design**
             * We don't tell the user if their account exists, or if the email has been sent,
             * because it may be used by someone with malicious intent. We only need to tell
             * the user that they'll get an email.
             */
            $this->Flash->success('Please check your inbox (or spam folder) for an email regarding how to reset your account password. ');
            return $this->redirect(['action' => 'login']);

        }
    }

    /**
     * Reset Password method
     *
     * @param string|null $nonce Reset password nonce
     * @return \Cake\Http\Response|null|void Redirects on successful password reset, renders view otherwise.
     */
    public function resetPassword($nonce = null)
    {
        $user = $this->Users->findByNonce($nonce)->first();

        // If nonce cannot find the user, or nonce is expired, prompt for re-reset password
        if (!$user || $user->nonce_expiry < FrozenTime::now()) {
            $this->Flash->error('Your link is invalid or expired. Please try again.');
            return $this->redirect(['action' => 'forgetPassword']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData(), 
                ['validate' => 'resetPassword']);
            // Also clear the nonce-related fields on successful password resets.
            // This ensures that the reset link can't be used a second time.
            $user->nonce = null;
            $user->nonce_expiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success('Your password has been successfully reset. Please login with new password. ');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('The password cannot be reset. Please try again.');
        }

        $this->set(compact('user'));
    }

    /**
     * Change Password method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePassword()
    {
        $user = $this->Users->get($this->user_id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');

                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
            $this->Flash->error('The user could not be saved. Please, try again.');
        }
        $this->set(compact('user'));
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|void|null Redirect to location before authentication
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // if user passes authentication, grant access to the system
        if ($result && $result->isValid()) {
            // set a fallback location in case user logged in without triggering 'unauthenticatedRedirect'
            $fallbackLocation = ['controller' => 'Lessons', 'action' => 'index'];
            if ($this->request->getSession()->read('booking.in_progress') == 'true') {
                $fallbackLocation = ['controller' => 'Bookings', 'action' => 'add'];
            }

            // and redirect user to the location they're trying to access
            return $this->redirect($this->Authentication->getLoginRedirect() ?? $fallbackLocation);
        }

        // display error if user submitted their credentials but authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Email address and/or Password is incorrect. Please try again. ');
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|void|null
     */
    public function logout()
    {
        // We only need to log out a user when they're logged in
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            $this->Flash->success('You have been logged out successfully. ');
        }

        // Otherwise just send them to the login page
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }

}
