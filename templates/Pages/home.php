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

use Cake\Routing\Router;

$this->assign('title', 'Home');
?>
<div id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-md-7" style="margin: auto;">
                <h2 data-aos="fade-up"><?= $this->ContentBlock->text('about-heading-1') ?></h2>
                <p style="margin-top: 20px;">
                    <?= $this->ContentBlock->text('about-text-1'); ?>
                    <!--
                    <a class="btn-book-a-table <?= $this->getRequest()->getRequestTarget() === '/auth/register' ? 'active' : '' ?>" href="<?= $this->Url->build(['controller' => 'auth', 'action' => 'register']) ?>" style="font-size: 20px; margin-top: 30px;">Sign Up</a>
                    -->
                </p>
                <a class="btn-book-a-table"
                   href="<?= $this->Url->build(['controller' => 'bookings', 'action' => 'add']) ?>">
                    Book an Appointment
                </a>

            </div>
            <div class="col-md-4">
                <?= $this->ContentBlock->image('about-heading-image', [
                    'alt' => 'CakePHP',
                    'class' => 'img-fluid',
                    'data-aos' => 'zoom-out',
                    'data-aos-delay' => '300',
                    'style' => 'height: 500px; width: 500px; object-fit: contain; margin: 0px',
                ]); ?>
            </div>
        </div>
    </div>
</div>
<main class="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <p>Learn More <span>About Us</span></p>
            </div>

            <div class="row gy-4">

                <div class="col-md-4">
                    <?= $this->ContentBlock->image('about-learn-more-image', [
                        'alt' => 'CakePHP',
                        'class' => 'img-fluid',
                        'data-aos' => 'zoom-out',
                        'data-aos-delay' => '300',
                        'style' => 'height: 500px; width: 500px; object-fit: contain; margin: 0px',
                    ]); ?>
                </div>


                <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300"
                     style="margin: auto">
                    <div class="content ps-0 ps-lg-5">
                        <div class="section-header">
                            <p>
                                <?= $this->ContentBlock->text('about-heading-2') ?>
                            </p>
                        </div>

                        <p class="fst-italic" style="font-size: 20px">
                            <?= $this->ContentBlock->text('about-text-2') ?>
                        </p>

                        <div class="position-relative mt-4">
                            <div class=" m-auto d-flex flex-column justify-content-center">
                                <div>
                                    <h4 class="d-flex align-items-center">
                                        <img
                                            src="<?php echo Router::url("/", true) ?>img/icons/suzuki_icon.jpg"
                                            class="me-2" alt="Music Icon" style="height: 40px">
                                        Suzuki Method
                                    </h4>
                                </div>
                                <hr>
                                <div>
                                    <h4 class="d-flex align-items-center">
                                        <img
                                            src="<?php echo Router::url("/", true) ?>img/icons/violin_icon.jpg"
                                            class="me-2" alt="Medal Icon"
                                            style="height: 40px">
                                        AMEB Syllabus
                                    </h4>
                                </div>
                                <hr>
                                <div>
                                    <h4 class="d-flex align-items-center">
                                        <img
                                            src="<?php echo Router::url("/", true) ?>img/icons/ameb.jpg"
                                            class="me-2" alt="Music Icon" style="height: 40px">
                                        AMEB Theory
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <p>Check <span><?= $this->ContentBlock->text('about-heading-3'); ?></span></p>
            </div>

            <!-- Testimonials pulled from the controller -->
            <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php if (empty($testimonials)) : ?>
                        <div class="col-md-12 text-center" data-aos="fade-up">
                            <p>No <?= $this->ContentBlock->text('about-heading-3'); ?> Found.</p>
                        </div>
                    <?php else : ?>
                        <?php foreach ($testimonials as $index => $testimonial) : ?>
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
                                                    <?php for ($i = 0; $i < $testimonial->rating; $i++) : ?>
                                                        <i class="bi bi-star-fill"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <?php if (empty($testimonial->image_url)) : ?>
                                                <img
                                                    src="<?php echo Router::url('/', true) ?>img/test-<?php echo ($index % 3) + 1 ?>.jpeg"
                                                    class="img-fluid testimonial-img" alt=""
                                                    style="height: 196px; width: 196px">
                                            <?php else : ?>
                                                <img src="<?= h($testimonial->image_url); ?>"
                                                     class="img-fluid testimonial-img" alt=""
                                                     style="height: 196px; width: 196px">
                                            <?php endif; ?>
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
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <p>Check <span><?= $this->ContentBlock->text('about-heading-4'); ?></span></p>
            </div>

            <!--            <div class="gallery-slider swiper">-->
            <!--                <div class="swiper-wrapper align-items-center">-->
            <!--                    --><?php
            //                    $dirPath = "img" . DS . "studio";
            //                    $images = preg_grep('~\.(jpeg|jpg|png)$~', scandir($dirPath));
            //                    if (empty($images)) {
            //                        echo "<div class='col-md-12 text-center' data-aos='fade-up'>
            //                                <p> No Images Found.</p>
            //                                </div>";
            //                    } else {
            //                        foreach ($images as $img) {
            //                            $imgPath = $dirPath . DS . $img;
            //                            if (is_file($imgPath)) {
            //                                echo "<div class='swiper-slide'><a class='glightbox' data-gallery='images-gallery' href=\"$imgPath\"><img src=\"$imgPath\" class='img-fluid' alt='''></a></div>";
            //                            }
            //                        }
            //                    }
            //                    ?>
            <!--                </div>-->
            <!--                <div class="swiper-pagination"></div>-->
            <!--            </div>-->
        </div>
    </section>
</main>
