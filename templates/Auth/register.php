<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;
use Cake\Routing\Router;

$debug = Configure::read('debug');
$this->disableAutoLayout();
$this->layout = 'login';
$this->assign('title', 'Register new user');
?>
<!doctype html>
<html lang="en">
<head>
    <title>Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo Router::url('/', true) ?>css/style.css"/>
    <!--    <link rel="stylesheet" href="css/style.css">-->

</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">TuneCraft Studio</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <div class="wrap d-md-flex">

                    <div class="img"
                         style="background-image: url('<?php echo Router::url("/", true) ?>img/login_form.jpg');">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Register</h3>
                            </div>

                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <!--                                    --><?php //= $this->Html->link('Homepage', '/', ['class' => 'btn btn-outline-danger']) ?>
                                    <a href="/"
                                       class="social-icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-home"></span></a>
                                    <!--                                    <a href="#"-->
                                    <!--                                       class="social-icon d-flex align-items-center justify-content-center"><span-->
                                    <!--                                            class="fa fa-twitter"></span></a>-->
                                </p>
                            </div>
                        </div>
                        <?= $this->Flash->render() ?>
                        <?= $this->Form->create(null, ['class' => 'signin-form']) ?>

                        <!--                        <form action="#" class="signin-form">-->

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <?= $this->Form->label('first_name', 'First Name', ['class' => 'required-asterisk']) ?>
                                <?php echo $this->Form->control('first_name', [
                                    'type' => 'text',
                                    'required' => true,
                                    'label' => false,
                                    'autofocus' => true,
                                    'value' => $debug ? "John" : "",
                                    'placeholder' => "John",
                                    'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <?= $this->Form->label('last_name', 'Last Name', ['class' => 'required-asterisk']) ?>
                                <?php echo $this->Form->control('last_name', [
                                    'type' => 'text',
                                    'required' => true,
                                    'label' => false,
                                    'autofocus' => true,
                                    'value' => $debug ? "Doe" : "",
                                    'placeholder' => "Doe",
                                    'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <?= $this->Form->label('email', 'Email', ['class' => 'required-asterisk']) ?>
                                <?= $this->Form->control('email', [
                                    'type' => 'email',
                                    'label' => false,
                                    'required' => true,
                                    'autofocus' => true,
                                    'value' => $debug ? "test@example.com" : "",
                                    'class' => 'form-control',
                                ]); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <?= $this->Form->label('phone', 'Phone', ['class' => 'required-asterisk']) ?>
                                <?= $this->Form->control('phone', [
                                    'type' => 'tel',
                                    'required' => true,
                                    'autofocus' => true,
                                    'label' => false,
                                    'value' => $debug ? "+61111111111" : "",
                                    'placeholder' => "+61111111111",
                                    'class' => 'form-control',
                                ]); ?>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <?= $this->Form->label('password', 'Password', ['class' => 'required-asterisk']) ?>

                            <?php echo $this->Form->control('password', [
                                'type' => 'password',
                                'required' => true,
                                'label' => false,
                                'value' => $debug ? 'password' : '',
                                'class' => 'form-control',
                            ]); ?>
                        </div>
                        <small class="form-text text-muted">Password Criteria:</small>
                        <ul class="password-criteria">
                            <li>Must be at least 8 characters long.</li>
                            <li>Contain at least one uppercase letter.</li>
                            <li>Contain at least one lowercase letter.</li>
                            <li>Contain at least one digit and one special character.</li>
                        </ul>
                        <div class="form-group mb-3">
                            <?= $this->Form->label('password_confirm', 'Password Confirm', ['class' => 'required-asterisk']) ?>

                            <?php echo $this->Form->control('password_confirm', [
                                'type' => 'password',
                                'label' => false,
                                'required' => true,
                                'value' => $debug ? 'password' : '',
                                'class' => 'form-control',
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->button('Register', ['class' => 'form-control btn btn-primary rounded submit px-3']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                        <p class="text-center">Back
                            to <?= $this->Html->link('Login', ['controller' => 'Auth', 'action' => 'login']) ?>?
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/popper.js"></script>
<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/main.js"></script>

</body>
</html>


<script>

    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
</script>

