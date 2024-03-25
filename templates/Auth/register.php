<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = 'login';
$this->assign('title', 'Register new user');
?>
<div class="container register">
    <div class="users form content">

        <?= $this->Form->create($user) ?>

        <fieldset style="display: flex; justify-content: space-between;">
            <legend>Register New User</legend>

            <div style="width: 50%;">
                <?= $this->Flash->render() ?>

                <div class="input-container">
                    <?= $this->Form->control('email', ['label' => 'Email', 'style' => 'width: 210px;']); ?>
                </div>

                <div class="input-container">
                    <?= $this->Form->control('phone', ['label' => 'Phone', 'style' => 'width: 210px;']); ?>
                </div>

                <div class="input-container">
                    <?= $this->Form->control('first_name', ['label' => 'First Name', 'style' => 'width: 210px;']); ?>
                </div>

                <div class="input-container">
                    <?= $this->Form->control('last_name', ['label' => 'Last Name', 'style' => 'width: 210px;']); ?>
                </div>

                <div class="input-container">
                    <?= $this->Form->control('password', [
                        'value' => '',  // Ensure password is not sent back to the client side
                        'label' => 'Password',
                        'style' => 'width: 210px;'
                    ]); ?>
                </div>

                <div class="input-container">
                    <?= $this->Form->control('password_confirm', [
                        'type' => 'password',
                        'value' => '',  // Ensure password is not sent back to the client side
                        'label' => 'Retype Password',
                        'style' => 'width: 210px;'
                    ]); ?>
                </div>
            </div>

            <div style="width: 40%;">
                <div class="password-criteria">
                    <h4>Password Criteria:</h4>
                    <ul>
                        <li>Must be at least 8 characters long.</li>
                        <li>Contain at least one uppercase letter.</li>
                        <li>Contain at least one lowercase letter.</li>
                        <li>Contain at least one digit and one special character.</li>
                    </ul>
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
