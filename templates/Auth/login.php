<?php
/**
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;
use Cake\Routing\Router;

$debug = Configure::read('debug');
$this->disableAutoLayout();
$this->layout = 'login';
$this->assign('title', 'Login');
?>
<!doctype html>
<html lang="en">
<head>
    <title>Login 04</title>
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
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">

                    <div class="img"
                         style="background-image: url('<?php echo Router::url("/", true) ?>img/login_form.jpg');">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Sign In</h3>
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

                        <div class="form-group mb-3">
                            <?php echo $this->Form->control('email', [
                                'type' => 'text',
                                'required' => true,
                                'autofocus' => true,
                                'value' => $debug ? "test@example.com" : "",
                                'class' => 'form-control',
                            ]);
                            ?>
                        </div>
                        <div class="form-group mb-3">
                            <?php echo $this->Form->control('password', [
                                'type' => 'password',
                                'required' => true,
                                'value' => $debug ? 'password' : '',
                                'class' => 'form-control',
                            ]); ?>
                        </div>

                        <!--                        <div class="form-group mb-3">-->
                        <!--                            <label class="label" for="name">Username</label>-->
                        <!--                            <input type="text" class="form-control" placeholder="Username" required>-->
                        <!--                        </div>-->
                        <!--                        <div class="form-group mb-3">-->
                        <!--                            <label class="label" for="password">Password</label>-->
                        <!--                            <input type="password" class="form-control" placeholder="Password" required>-->
                        <!--                        </div>-->

                        <div class="form-group">
                            <?= $this->Form->button('Login', ['class' => 'form-control btn btn-primary rounded submit px-3']) ?>
                            <!--                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In-->
                            <!--                            </button>-->
                        </div>
                        <div class="form-group d-md-flex">
                            <!--                                <div class="w-50 text-left">-->
                            <!--                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me-->
                            <!--                                        <input type="checkbox" checked>-->
                            <!--                                        <span class="checkmark"></span>-->
                            <!--                                    </label>-->
                            <!--                                </div>-->
                            <div class="w-50">
                                <?= $this->Html->link('Forgot password?', ['controller' => 'Auth', 'action' => 'forgetPassword']) ?>
                                <!--                                <a href="#">Forgot Password</a>-->
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                        <!--                        </form>-->
                        <p class="text-center">Not a
                            member? <?= $this->Html->link('Register', ['controller' => 'Auth', 'action' => 'register']) ?>
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

