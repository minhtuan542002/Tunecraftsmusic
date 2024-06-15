<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->assign('title', 'Change User Password - Users');
$this->loadHelper('Form', [
  'templates' => 'app_form',
]);
?>

<div class="container login-div section-bg my-3">
    <div class="users form content">

        <?= $this->Form->create($user) ?>

        <fieldset>

            <legend class ="my-3">
              Change Password for <?= h($user->first_name) ?> <?= h($user->last_name) ?>
            </legend>
            <div class="row">
                <?php
                echo $this->Form->control('password', [
                    'label' => 'New Password',
                    'value' => '',  // Ensure password is not sending back to the client side
                    'templateVars' => ['inputClass'=> 'show_hide_password']
                ]);
                // Validate password by repeating it
                echo $this->Form->control('password_confirm', [
                    'type' => 'password',
                    'value' => '',  // Ensure password is not sending back to the client side
                    'label' => 'Retype New Password',
                    'templateVars' => ['container_class' => 'column']
                ]);
                ?>
            </div>

        </fieldset>

        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>

    </div>
</div>
<style>
.container.login-div {
  min-height: 55vh;
}
</style>
