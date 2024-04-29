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
<!--<div class="section-bg">-->
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
                   href="<?= $this->Url->build(['controller' => 'auth', 'action' => 'login']) ?>">Book an
                    appointment</a>

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
                <!--                <h2>About Us</h2>-->
                <p>Learn More <span>About Us</span></p>
            </div>

            <div class="row gy-4">

                <img
                    src="<?php echo Router::url('/', true) ?>img/about.jpeg"
                    class="col-lg-7 position-relative about-img img-fluid testimonial-img" alt=""
                >


                <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300"
                     style="margin: auto">
                    <div class="content ps-0 ps-lg-5">
                        <div class="section-header">

                            <p><?= $this->ContentBlock->text('about-heading-2') ?></p>
                        </div>

                        <p class="fst-italic" style="font-size: 20px">
                            <?= $this->ContentBlock->text('about-text-2') ?>
                        </p>
                        <!--                        <ul>-->
                        <!--                            <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo-->
                        <!--                                consequat.-->
                        <!--                            </li>-->
                        <!--                            <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate-->
                        <!--                                velit.-->
                        <!--                            </li>-->
                        <!--                            <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo-->
                        <!--                                consequat. Duis aute irure dolor in reprehenderit in voluptate trideta-->
                        <!--                                storacalaperda mastiro dolore eu fugiat nulla pariatur.-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                        <p>-->
                        <!--                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in-->
                        <!--                            reprehenderit in voluptate-->
                        <!--                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non-->
                        <!--                            proident-->
                        <!--                        </p>-->

                        <div class="position-relative mt-4">
                            <div class=" m-auto d-flex flex-column justify-content-center">
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
                            <!--                                <img src="assets/img/about-2.jpg" class="img-fluid" alt="">-->
                            <!--                                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>-->
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
                <p>Check <span>Testimonials</span></p>
            </div>

            <!-- Testimonials pulled from the controller -->
            <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <?php if (empty($testimonials)) : ?>
                        <div class="col-md-12 text-center" data-aos="fade-up">
                            <p>No Testimonials Found.</p>
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


    <!--    <!-- ======= Gallery Section ======= -->
    <!--    <section id="gallery" class="gallery section-bg">-->
    <!--        <div class="container" data-aos="fade-up">-->
    <!---->
    <!--            <div class="section-header">-->
    <!--                <p>Check <span>--><?php //= $this->ContentBlock->text('about-heading-3'); ?><!--</span></p>-->
    <!--            </div>-->
    <!---->
    <!--            <div class="gallery-slider swiper">-->
    <!--                <div class="swiper-wrapper align-items-center">-->
    <!--                    --><?php
    //                    $images = glob('./img/studio/*.{jpg,png,gif}', GLOB_BRACE);
    //                    foreach ($images as $img) {
    //                        echo "<div class='swiper-slide'><a class='glightbox' data-gallery='images-gallery' href=\"$img\"><img src=\"$img\" class='img-fluid' alt='''></a></div>";
    //                    }
    //                    ?>
    <!--                </div>-->
    <!--                <div class="swiper-pagination"></div>-->
    <!--            </div>-->
    <!---->
    <!--        </div>-->
    <!--    </section><!-- End Gallery Section -->
</main>

<!--</div>-->
