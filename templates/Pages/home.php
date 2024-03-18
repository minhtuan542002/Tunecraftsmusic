<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>



<!-- ======= Home Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class = "container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                <h2 data-aos="fade-up">TuneCraft Studio<br>
                <p data-aos="fade-up" data-aos-delay="100" style="font-size: 30px;" style="font-weight: bold;"> Are you ready to take your violin skills to the next level? Look no further as this is the perfect place to enhance your skills. </p>
                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <!-- <div class="button-border"> -->
                <a class="btn-book-a-table" href="#book-a-table" style="font-size: 34px;">Book a Lesson</a>


                <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
            <?= $this->Html->image('violin-background.jpg', [
                    'alt' => 'CakePHP', 
                    'class' => "img-fluid",
                    'data-aos' => "zoom-out",
                    'data-aos-delay' => "300"
                    ]); ?>
            </div>
        </div>
    </div>
</section><!-- End Home Section -->