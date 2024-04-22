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
                    <h4>
                        <b>8</b> Years of teaching experience,
                        </h4>
                        Specialized in the Suzuki teaching approach and AMEB violin exam syllabus.
                        I assure to provide a comprehensive learning experience for my students
                        on their musical journey here at Tunecraftstudio.
                    -->
                    <a class="btn-book-a-table <?= ($this->getRequest()->getRequestTarget() === '/auth/register') ? 'active' : '' ?>" href="<?= $this->Url->build(['controller'=>'auth', 'action'=> 'register']) ?>" style="font-size: 20px; margin-top: 30px;">Sign Up</a>

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
                <div class="mb-3">
                    <h4 class="d-flex align-items-center">
                        <span class="icon me-2">🎵</span>
                        Suzuki Method
                    </h4>
                </div>
                <hr>
                <div class="d-flex align-items-center">
                    <h4 class="me-2">
                        <span class="icon me-2">🏅</span>
                        AMEB Syllabus
                    </h4>
                </div>
            </div>

        </div>


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
