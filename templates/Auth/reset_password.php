<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = 'login';
$this->assign('title', 'Reset Password');
?>
<div class="container login-div section-bg">

    <div class="users form content">

        <?= $this->Form->create($user) ?>

        <fieldset>

            <legend>Reset Your Password</legend>

            <?= $this->Flash->render() ?>

            <?php
            echo $this->Form->control('password', [
                'type' => 'password',
                'label' => 'New Password',
                'required' => true,
                'autofocus' => true,
                'value' => ''
            ]);
            echo $this->Form->control('password_confirm', [
                'type' => 'password',
                'label' => 'Repeat New Password',
                'required' => true,
                'value' => ''
            ]);
            ?>

        </fieldset>

        <?= $this->Form->button('Reset Password') ?>
        <?= $this->Form->end() ?>

        <hr class="hr-between-buttons">

        <?= $this->Html->link('Back to login', ['controller' => 'Auth', 'action' => 'login'], ['class' => 'button button-outline']) ?>

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