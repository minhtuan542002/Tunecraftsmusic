<?php
/**
 * Login layout
 *
 * This layout comes with no navigation bar and Flash renderer placeholder. Usually used for login page or similar.
 *
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;
use Cake\Routing\Router;

$appLocale = Configure::read('App.defaultLocale');
?>
<!DOCTYPE html>
<html lang="<?= $appLocale ?>">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo Router::url('/', true) ?>css/style.css"/>
    <!--    <link rel="stylesheet" href="css/style.css">-->

</head>
<body>
    <?= $this->fetch('content') ?>
<footer>
    <?= $this->element('footer_copyright', [], ['ignoreMissing' => true]); ?>

    <?= $this->fetch('footer_script') ?>
</footer>
</body>

<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/popper.js"></script>
<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Router::url("/", true) ?>js/login/js/main.js"></script>

</html>
