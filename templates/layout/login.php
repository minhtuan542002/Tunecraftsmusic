<?php
/**
 * Login layout
 *
 * This layout comes with no navigation bar and Flash renderer placeholder. Usually used for login page or similar.
 *
 * @var \App\View\AppView $this
 */

use Cake\Core\Configure;

$appLocale = Configure::read('App.defaultLocale');
?>
<!DOCTYPE html>
<html lang="<?= $appLocale ?>">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?= $this->Html->charset() ?>
    
    <?= $this->Html->meta('icon') ?>

    <!-- <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?> -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <?= $this->Html->css('/vendor/bootstrap/css/bootstrap.min.css') ?>
  <?= $this->Html->css('/vendor/bootstrap-icons/bootstrap-icons.css') ?>
  <?= $this->Html->css('/vendor/aos/aos.css') ?>
  <?= $this->Html->css('/vendor/glightbox/css/glightbox.min.css') ?>
  <?= $this->Html->css('/vendor/swiper/swiper-bundle.min.css') ?>

  <!-- Template Main CSS File -->
  <?= $this->Html->css('main.css') ?>
  
  <?= $this->Html->script('/vendor/jquery/jquery.min.1.3.2.js') ?>

</head>
<body>
<main class="main">
    <?= $this->fetch('content') ?>
</main>
<footer>
    <?= $this->element('footer_copyright', [], ['ignoreMissing' => true]); ?>

    <?= $this->fetch('footer_script') ?>
</footer>
</body>
</html>
