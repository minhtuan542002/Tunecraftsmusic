<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

use Cake\Core\Configure;
use Cake\Routing\Router;

$debug = Configure::read('debug');
$this->disableAutoLayout();
$this->layout = 'login';
$this->assign('title', 'Reset Password');
?>

<!doctype html>
<html lang="en">
<head>
    <title>Forgot Password</title>
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
                                <h4 class="mb-4">Reset Password</h4>
                            </div>

                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="/"
                                       class="social-icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-home"></span></a>
                                </p>
                            </div>
                        </div>
                        <?= $this->Flash->render() ?>
                        <?= $this->Form->create(null, ['class' => 'signin-form']) ?>


                        <div class="form-group mb-3">
                            <?= $this->Form->label('password', 'Password', ['class' => 'required-asterisk']) ?>
                            <div class="input-group mb-3" id="show_hide_password">
                                <div class="input-group-prepend">
            <span class="input-group-text" id="login-password">
                <a href="" style="color: #212529;"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
            </span>
                                </div>
                                <?= $this->Form->password('password', ['id' => 'password', 'class' => 'form-control mr-1', 'label' => false, 'placeholder' => 'Password']) ?>
                            </div>
                            <div id="password-error" style="display: none; color: red;"></div>
                        </div>


                        <small class="form-text text-muted">Password Criteria:</small>
                        <ul class="password-criteria">
                            <li>Must be at least 8 characters long.</li>
                            <li>Contain at least one uppercase letter.</li>
                            <li>Contain at least one lowercase letter.</li>
                            <!-- <li>Contain at least one digit and one special character.</li> -->
                        </ul>
                        <div class="form-group mb-3">
                            <?= $this->Form->label('password_confirm', 'Password Confirm', ['class' => 'required-asterisk']) ?>
                            <div class="input-group mb-3" id="show_hide_password">
                                <div class="input-group-prepend">
            <span class="input-group-text" id="login-password">
                <a href="" style="color: #212529;"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
            </span>
                                </div>
                                <?= $this->Form->password('password_confirm', ['id' => 'password_confirm', 'class' => 'form-control mr-1', 'label' => false, 'placeholder' => '']) ?>
                            </div>
                            <div id="password-confirm-error" style="display: none; color: red;"></div>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->button('Reset', ['class' => 'form-control btn btn-primary rounded submit px-3']) ?>
                        </div>
                        <?= $this->Form->end() ?>


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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordField = document.getElementById('password');
        const passwordConfirmField = document.getElementById('password_confirm');
        const passwordError = document.getElementById('password-error');
        const passwordConfirmError = document.getElementById('password-confirm-error');

        // Function to validate password criteria
        function validatePasswordCriteria(password) {
            const errors = [];

            // Check length
            if (password.length < 8) {
                errors.push('Must be at least 8 characters long.');
            }

            // Check for uppercase letter
            if (!/[A-Z]/.test(password)) {
                errors.push('Must contain at least one uppercase letter.');
            }

            // Check for lowercase letter
            if (!/[a-z]/.test(password)) {
                errors.push('Must contain at least one lowercase letter.');
            }

            // Check for digit and special character
            if (!/\d/.test(password) || !/[^0-9]/.test(password)) {
                errors.push('Must contain at least one digit');
            }

            return errors;
        }


        // Function to validate password match
        function validatePasswordMatch() {
            const password = passwordField.value;
            const confirmPassword = passwordConfirmField.value;

            if (password !== confirmPassword) {
                passwordConfirmError.innerHTML = 'Passwords do not match.';
                passwordConfirmError.style.display = 'block';
            } else {
                passwordConfirmError.innerHTML = '';
                passwordConfirmError.style.display = 'none';
            }
        }

        // Event listeners for password fields
        passwordField.addEventListener('input', function () {
            const password = passwordField.value;
            const errors = validatePasswordCriteria(password);

            if (errors.length > 0) {
                passwordError.innerHTML = errors.join('<br>');
                passwordError.style.display = 'block';
            } else {
                passwordError.innerHTML = '';
                passwordError.style.display = 'none';
            }

            // Also validate password match
            validatePasswordMatch();
        });

        passwordConfirmField.addEventListener('input', function () {
            // Validate password match
            validatePasswordMatch();
        });

    });
</script>
