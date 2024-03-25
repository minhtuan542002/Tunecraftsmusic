<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$debug = Configure::read('debug');

$this->layout = 'login';
$this->assign('title', 'Login');
?>
<div class="container login-div section-bg">
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
            <?= $this->Html->link('Register', ['controller' => 'Auth', 'action' => 'register'], ['class'=> 'btn btn-outline-danger']) ?>
            <?= $this->Html->link('Homepage', '/', ['class'=> 'btn btn-outline-danger']) ?>
        </div>
    </div>
</div>
<style>
@media screen and (min-width: 1280px) {
  .login-div {
    width: 25%;
  }
}
@media screen and (max-width: 768px) {
  .login-div {
    width: 100%;
  }
}
</style>