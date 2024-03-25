<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = 'login';
$this->assign('title', 'Register new user');
?>
<div class="container register-div section-bg">
    <div class="users form content">
        <?= $this->Form->create($user) ?>

            <fieldset>
                <legend>Register New User</legend>

                <?= $this->Flash->render() ?>

                <div class="input-container">
                    <div style="width: 210px;">
                        <?= $this->Form->control('email', ['label' => 'Email']); ?>
                    </div>
                </div>

                <div class="input-container">
                    <div style="width: 210px;">
                        <?= $this->Form->control('phone', ['label' => 'Phone']); ?>
                    </div>
                </div>

                <div class="input-container">
                    <div style="width: 210px;">
                        <?= $this->Form->control('first_name', ['label' => 'First Name']); ?>
                    </div>
                </div>

                <div class="input-container">
                    <div style="width: 210px;">
                        <?= $this->Form->control('last_name', ['label' => 'Last Name']); ?>
                    </div>
                </div>

                <div class="input-container">
                    <div style="width: 210px;">
                        <?= $this->Form->control('password', [
                            'value' => '',  // Ensure password is not sent back to the client side
                            'label' => 'Password'
                        ]); ?>
                    </div>
                    <div class="password-criteria" style="margin-left: 230px; margin-top: -120px;">
                        <h4>Password Criteria:</h4>
                        <ul>
                            <li>Must be at least 8 characters long.</li>
                            <li>Contain at least one uppercase letter.</li>
                            <li>Contain at least one lowercase letter.</li>
                            <li>Contain at least one digit and one special character.</li>
                        </ul>
                    </div>
                </div>

                <div class="input-container" style="margin-bottom: 10px;"> <!-- Add margin-bottom here -->
                    <div style="width: 210px;">
                        <?= $this->Form->control('password_confirm', [
                            'type' => 'password',
                            'value' => '',  // Ensure password is not sent back to the client side
                            'label' => 'Retype Password'
                        ]); ?>
                    </div>
                </div>
            </fieldset>

            <div class="buttons">
                <?= $this->Form->button('Register') ?>
                <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline float-right']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>
<style>
@media screen and (min-width: 1280px) {
  .register-div {
    width: 33%;
  }
}
@media screen and (max-width: 768px) {
  .register-div {
    width: 100%;
  }
}
</style>