<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'login';
$this->assign('title', 'Login');
?>
<div class="container my-5 p-3 login d-flex justify-content-center section-bg">
        <div class="col-md-12">
            <div class="users form content">

                <?= $this->Form->create() ?>

                <fieldset>

                    <legend>Login</legend>

                    <?= $this->Flash->render() ?>

                    <?php
                    /*
                     * NOTE: regarding 'value' config in the login page form controls
                     * In this demo the email and password fields will be filled by demo account
                     * credentials when debug mode is on. You should NOT do that in your production
                     * systems. Also it's a good practice to clear (set password value to empty)
                     * in the view so when an error occurred with form validation, the password
                     * values are always cleared.
                     */
                    echo $this->Form->control('email', [
                        'type' => 'email',
                        'required' => true,
                        'autofocus' => true,
                        'value' => $debug ? "test@example.com" : "",
                        'class' => 'form-control',
                    ]);
                    echo $this->Form->control('password', [
                        'type' => 'password',
                        'required' => true,
                        'value' => $debug ? 'password' : '',
                        'class' => 'form-control',
                    ]);
                    ?>
                </fieldset>
                <div class="d-flex justify-content-between pt-3">
                    <?= $this->Form->button('Login', ['class'=> 'btn btn-danger']) ?>
                    <?= $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword'], ['class' => 'btn btn-outline-danger']) ?>
                </div>
                <?= $this->Form->end() ?>

                <hr class="hr-between-buttons">
                <div class="d-flex justify-content-between pt-3">
                    <?= $this->Html->link('Register new user', ['controller' => 'Auth', 'action' => 'register'], ['class'=> 'btn btn-outline-danger']) ?>
                    <?= $this->Html->link('Go to Homepage', '/', ['class'=> 'btn btn-outline-danger']) ?>
                </div>
            </div>
        </div>
</div>
