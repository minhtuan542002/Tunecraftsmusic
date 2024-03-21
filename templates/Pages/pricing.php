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

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-4 order-lg-1 text-center text-lg-start">
                <div class="lesson">
                    <?= $this->Html->image('pricing-1.jpg', [
                        'alt' => '30 Minute Lesson', 
                        'class' => "img-fluid",
                        'data-aos' => "zoom-out",
                        'data-aos-delay' => "300"
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-7 order-lg-2 text-center text-lg-start">
                <div class="lesson">
                    <h2 data-aos="fade-up">30 Minute Lesson</h2>
                    <h3 data-aos="fade-up" data-aos-delay="200">$50 per session</h3>
                    <p data-aos="fade-up" data-aos-delay="100">Wanting to start your violin journey but have a busy schedule? Book our 30 minute weekly class to get started without having to move your schedule around.</p>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero Section -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-4 order-lg-2 text-center text-lg-start">
                <div class="lesson">
                    <?= $this->Html->image('pricing-2.jpg', [
                        'alt' => '45 Minute Lesson', 
                        'class' => "img-fluid",
                        'data-aos' => "zoom-out",
                        'data-aos-delay' => "300"
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-7 order-lg-1 text-center text-lg-start">
                <div class="lesson">
                    <h2 data-aos="fade-up">45 Minute Lesson</h2>
                    <h3 data-aos="fade-up" data-aos-delay="200">$60 per session</h3>
                    <p data-aos="fade-up" data-aos-delay="100">This lesson type provides a balanced duration for comprehensive learning without feeling too rushed. Our 45 minute weekly lesson are a good way to take your journey to the next level.</p>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero Section -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-4 order-lg-1 text-center text-lg-start">
                <div class="lesson">
                    <?= $this->Html->image('pricing-3.jpg', [
                        'alt' => '60 Minute Lesson', 
                        'class' => "img-fluid",
                        'data-aos' => "zoom-out",
                        'data-aos-delay' => "300"
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-7 order-lg-2 text-center text-lg-start">
                <div class="lesson">
                    <h2 data-aos="fade-up">60 Minute Lesson</h2>
                    <h3 data-aos="fade-up" data-aos-delay="200">$75 per session</h3>
                    <p data-aos="fade-up" data-aos-delay="100">This is perfect for anyone seeking an in-depth learning experience with ample time for practice and exploration. Our 60 minute weekly lessons allow you to immerse yourself and really hone in on bringing out your inner musician!</p>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero Section -->
