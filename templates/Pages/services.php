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
$this->assign('title', 'Pricing')
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-4 order-lg-1 text-center text-lg-start">
                <div class="lesson">
                    <?= $this->ContentBlock->image('pricing-image-1', [
                        'alt' => '30 Minute Lesson', 
                        'class' => "img-fluid",
                        'data-aos' => "zoom-out",
                        'data-aos-delay' => "300",
                        'style' => 'height: 300px; width: 500px; object-fit: cover;'
                    ]); ?>
                    <h2 data-aos="fade-up"><?= $this->ContentBlock->text('pricing-heading-1'); ?></h2>
                    <h3 data-aos="fade-up" data-aos-delay="200"><?= $this->ContentBlock->text('pricing-price-1'); ?></h3>
                    <p data-aos="fade-up" data-aos-delay="100"><?= $this->ContentBlock->text('pricing-text-1'); ?></p>
                </div>
            </div>
            <div class="col-lg-4 order-lg-2 text-center text-lg-start">
                <div class="lesson">
                    <?= $this->ContentBlock->image('pricing-image-2', [
                        'alt' => '45 Minute Lesson', 
                        'class' => "img-fluid",
                        'data-aos' => "zoom-out",
                        'data-aos-delay' => "300",
                        'style' => 'height: 300px; width: 500px; object-fit: cover;'
                    ]); ?>
                    <h2 data-aos="fade-up"><?= $this->ContentBlock->text('pricing-heading-2'); ?></h2>
                    <h3 data-aos="fade-up" data-aos-delay="200"><?= $this->ContentBlock->text('pricing-price-2'); ?></h3>
                    <p data-aos="fade-up" data-aos-delay="100"><?= $this->ContentBlock->text('pricing-text-2'); ?></p>
                </div>
            </div>
            <div class="col-lg-4 order-lg-3 text-center text-lg-start">
                <div class="lesson">
                    <?= $this->ContentBlock->image('pricing-image-3', [
                        'alt' => '60 Minute Lesson', 
                        'class' => "img-fluid",
                        'data-aos' => "zoom-out",
                        'data-aos-delay' => "300",
                        'style' => 'height: 300px; width: 500px; object-fit: cover;'
                    ]); ?>
                    <h2 data-aos="fade-up"><?= $this->ContentBlock->text('pricing-heading-3'); ?></h2>
                    <h3 data-aos="fade-up" data-aos-delay="200"><?= $this->ContentBlock->text('pricing-price-3'); ?></h3>
                    <p data-aos="fade-up" data-aos-delay="100"><?= $this->ContentBlock->text('pricing-text-3'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero Section -->
