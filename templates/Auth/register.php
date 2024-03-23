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

        <fieldset>
            <legend>Register New User</legend>

            <?= $this->Flash->render() ?>

            <?= $this->Form->control('email'); ?>

            <?= $this->Form->control('phone'); ?>

            <div class="row">
                <?= $this->Form->control('first_name', ['templateVars' => ['container_class' => 'column']]); ?>
                <?= $this->Form->control('last_name', ['templateVars' => ['container_class' => 'column']]); ?>
            </div>

            <div class="row">
                <?php
                echo $this->Form->control('password', [
                    'value' => '',  // Ensure password is not sending back to the client side
                    'templateVars' => ['container_class' => 'column']
                ]);
                // Validate password by repeating it
                echo $this->Form->control('password_confirm', [
                    'type' => 'password',
                    'value' => '',  // Ensure password is not sending back to the client side
                    'label' => 'Retype Password',
                    'templateVars' => ['container_class' => 'column']
                ]);
                ?>
            </div>

        </fieldset>

        <?= $this->Form->button('Register') ?>
        <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline float-right']) ?>
        <?= $this->Form->end() ?>
        <?= $this->Form->create() ?>
        <div>Password Criteria:<br>
        Must be at least 8 characters long.<br>
        Contain at least one uppercase letter.<br>
        Contain at least one lowercase letter.<br>
        Contain at least one digit and one special character.</div>



    </div>
</div>
