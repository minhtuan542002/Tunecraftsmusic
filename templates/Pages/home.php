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


$this->assign('title', 'Home');
?>
<div class="section-bg">
    <div id="hero" class="hero container mt-5 section-bg">
        <div class="row">
            <div class="col-md-7" >
                <h2 data-aos="fade-up"><?= $this->ContentBlock->text('about-heading-1') ?></h2>
                <p style="margin-top: 20px;">
                    <?= $this->ContentBlock->text('about-text-1'); ?>
                    <!--
                    <a class="btn-book-a-table <?= ($this->getRequest()->getRequestTarget() === '/auth/register') ? 'active' : '' ?>" href="<?= $this->Url->build(['controller'=>'auth', 'action'=> 'register']) ?>" style="font-size: 20px; margin-top: 30px;">Sign Up</a>
                    -->
                </p>
            </div>
            <div class="col-md-4">
                <?= $this->ContentBlock->image('about-heading-image', [
                    'alt' => 'CakePHP',
                    'class' => "img-fluid",
                    'data-aos' => "zoom-out",
                    'data-aos-delay' => "300",
                    'style' => 'height: 400px; width: 500px; object-fit: contain;'
                ]); ?>
            </div>
        </div>

        <div class="row align-items-start my-5">
            <!-- Main heading and text -->
            <div class="col-md-6">
                <h2><?= $this->ContentBlock->text('about-heading-2') ?></h2>
                <p><?= $this->ContentBlock->text('about-text-2') ?></p>
            </div>

            <!-- Sub-sections with icons -->
            <div class="col-md-6 m-auto d-flex flex-column justify-content-center">
                <div>
                    <h4 class="d-flex align-items-center">
                        <span class="icon me-2">🎵</span>
                        Suzuki Method
                    </h4>
                </div>
                <hr>
                <div>
                    <h4 class="d-flex align-items-center">
                        <span class="icon me-2">🏅</span>
                        AMEB Syllabus
                    </h4>
                </div>
                <hr>
                <div>
                    <h4 class="d-flex align-items-center">
                        <span class="icon me-2">🎵</span>
                        AMEB Theory
                    </h4>
                </div>    
            </div>

        </div>

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <p>Check <span>Testimonials</span></p>
                </div>

                <!-- Testimonials pulled from the controller -->
                <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <?php if (empty($testimonials)): ?>
                            <div class="col-md-12 text-center" data-aos="fade-up">
                                <p>No Testimonials Found.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($testimonials as $testimonial): ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="row gy-4 justify-content-center">
                                            <div class="col-lg-6">
                                                <div class="testimonial-content">
                                                    <p>
                                                        <i class="bi bi-quote quote-icon-left"></i>
                                                        <?= h($testimonial->testimonial_text); ?>
                                                        <i class="bi bi-quote quote-icon-right"></i>
                                                    </p>
                                                    <h3><?= h($testimonial->student_name); ?></h3>
                                                    <h4><?= h($testimonial->testimonial_title); ?></h4>
                                                    <div class="stars">
                                                        <?php for ($i = 0; $i < $testimonial->rating; $i++): ?>
                                                            <i class="bi bi-star-fill"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 text-center">
                                                <img src="<?= h($testimonial->image_url); ?>" class="img-fluid testimonial-img" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <div class="swiper-pagination"></div>

            </div>
        </section><!-- End Testimonials Section -->


        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <p>Check <span><?= $this->ContentBlock->text('about-heading-3'); ?></span></p>
                </div>

                <div class="gallery-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <?php
                        $images = glob("./img/studio/*.{jpg,png,gif}", GLOB_BRACE);
                        foreach ($images as $img) {
                            echo "<div class='swiper-slide'><a class='glightbox' data-gallery='images-gallery' href=\"$img\"><img src=\"$img\" class='img-fluid' alt='''></a></div>";
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Gallery Section -->
       
    </div>
</div>
