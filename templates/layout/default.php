<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = $this->ContentBlock->text('website-title');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Verify google index, please change later -->
  <meta name="google-site-verification" content="MwObaC-PVfYXYr2TXSZUwEfajmu1uXSFwoJ6GD_2slI" />
  
  <meta name="title" content="Afrooz Amini: Violin Instructor | Suzuki Method & AMEB Syllabus">
  <meta name="description" content="Afrooz Amini, an experienced violin instructor at Tunecraftstudio, specializes in the Suzuki teaching approach and AMEB violin exam syllabus. Offering personalized attention and tailored instruction, she ensures a comprehensive learning experience for aspiring violinists. Explore Suzuki Method and AMEB Theory lessons today!">
  <meta name="keywords" content="Afrooz Amini, violin instructor, Tunecraftstudio, Suzuki Method, AMEB syllabus, violin lessons, musical education, aspiring violinists, teacher, violin, AMEB">
  <meta name="author" content="Afrooz Amini">
  
  <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- <?= $this->Html->charset() ?> -->

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

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Mar 13 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    body {
      margin-top: 90px;
      min-height: 100%;
    }
    html {
      min-height: 100%;
    }
    @media (max-width: 575px) {
      body {
      margin-top: 70px;
      }
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

    <?php if ($loggedIn && $role_id == 3): ?>

      <a href="<?= $this->Url->build('/dashboard/my-schedule') ?>" class="logo d-flex align-items-center me-auto me-lg-0">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1>Admin Dashboard<span>.</span></h1>

      <?php else: ?>
      <a href="<?= $this->Url->build('/') ?>" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1><?= $this->ContentBlock->text('website-title'); ?><span>.</span></h1>
      </a>

    <?php endif; ?>

      <nav id="navbar" class="navbar">
        <ul>

        <li><a <?= ($this->getRequest()->getRequestTarget() === '/') ? 'class="active"' : '' ?> href="<?= $this->Url->build('/') ?>">Home</a></li>
        <li><a <?= ($this->getRequest()->getRequestTarget() === '/packages') ? 'class="active"' : '' ?> href="<?= $this->Url->build('/packages') ?>">Packages</a></li>
        
        <?php if ($loggedIn): ?>
          <li><a <?= (str_starts_with($this->getRequest()->getRequestTarget(), '/bookings/')) ? 'class="active"' : '' ?> href="<?= $this->Url->build(['controller'=>'bookings', 'action'=> 'my']) ?>">My Bookings</a></li>
          <li><a <?= ($this->getRequest()->getRequestTarget() === '/lessons/my') ? 'class="active"' : '' ?> href="<?= $this->Url->build(['controller'=>'lessons', 'action'=> 'my']) ?>">My Schedule</a></li>
        <?php else: ?>
          <li><a <?= ($this->getRequest()->getRequestTarget() === '/booking/add') ? 'class="active"' : '' ?> href="<?= $this->Url->build(['controller'=>'bookings', 'action'=> 'add']) ?>">Bookings</a></li>
        <?php endif; ?>
        <li>
          <a <?= ($this->getRequest()->getRequestTarget() === '/learning-resources') ? 'class="active"' : '' ?>
              href="<?= $this->Url->build('/learning-resources') ?>">Learning Resources</a>
        </li>
        <?php if ($loggedIn): ?>
          <li class="dropdown"><a href="#"><span>My Account</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                
                <li><a href="<?= $this->Url->build(['controller'=>'auth', 'action'=>'changePassword']) ?>">Change Password</a></li>
                <li><a href="<?= $this->Url->build(['controller'=>'auth', 'action'=>'logout']) ?>">Log Out</a></li>
              </ul>
            </li>
        <!-- <a class="btn-book-a-table" href="<?= $this->Url->build(['controller'=>'auth', 'action'=>'logout']) ?>">Logout</a> -->
        <?php endif; ?>
            <!--
            <li><a <?= ($this->getRequest()->getRequestTarget() === '/gallery') ? 'class="active"' : '' ?> href="<?= $this->Url->build('/gallery') ?>">Gallery</a></li>
            <li><a <?= ($this->getRequest()->getRequestTarget() === '/contact') ? 'class="active"' : '' ?> href="<?= $this->Url->build('/contact') ?>">Contact Us</a></li>
            -->

          <!-- <li><a href="#home">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#lessons">Lessons</a></li>
          <li><a href="#booking">Booking</a></li>
          <li><a href="#contact">Contact Us</a></li>
          <li><a href="#gallery">Gallery</a></li> -->

          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li> -->
            <!-- </ul>
          </li> -->
        </ul>
      </nav><!-- .navbar -->

      <?php if ($loggedIn): ?>
        <a class="btn-book-a-table" href="<?= $this->Url->build(['controller'=>'booking', 'action'=>'add']) ?>">New Booking</a>
      <?php else: ?>
        <a class="btn-book-a-table" href="<?= $this->Url->build(['controller'=>'auth', 'action'=>'login']) ?>">Login</a>
      <?php endif; ?>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <div class="pb-5">
      <?= $this->Flash->render() ?>
      <?= $this->fetch('content') ?>
    </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Address</h4>
            <p>
            <?= $this->ContentBlock->html('address'); ?>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Contact</h4>
            <p>
              <?= $this->ContentBlock->html('contact'); ?>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Opening Hours</h4>
            <p>
              <?= $this->ContentBlock->html('open-hours'); ?>
            </p>
          </div>
        </div>

        <!--
        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Us</h4>
          <div class="social-links d-flex">
            <a href="<?= $this->Url->build('/comingsoon') ?>" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="<?= $this->Url->build('/comingsoon') ?>" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="<?= $this->Url->build('/comingsoon') ?>" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="<?= $this->Url->build('/comingsoon') ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        -->

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><?= $this->ContentBlock->text('website-title'); ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <?= $this->Html->script('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>
  <?= $this->Html->script('/vendor/aos/aos.js') ?>
  <?= $this->Html->script('/vendor/glightbox/js/glightbox.min.js') ?>
  <?= $this->Html->script('/vendor/purecounter/purecounter_vanilla.js') ?>
  <?= $this->Html->script('/vendor/swiper/swiper-bundle.min.js') ?>
  <?= $this->Html->script('/vendor/php-email-form/validate.js') ?>

  <!-- Template Main JS File -->
  <?= $this->Html->script('main.js') ?>

</body>

</html>
