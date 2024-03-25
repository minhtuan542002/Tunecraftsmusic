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
$this->assign('title', 'About');
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-7" style="margin-top: 50px;">
            <h1><?= $this->ContentBlock->text('about-heading-1') ?></h1>
            <p style="margin-top: 40px;">
            <?= $this->ContentBlock->text('about-text-1'); ?>
            <!--    
            <h4>
                <b>8</b> Years of teaching experience,
                </h4>
                Specialized in the Suzuki teaching approach and AMEB violin exam syllabus.
                I assure to provide a comprehensive learning experience for my students 
                on their musical journey here at Tunecraftstudio.
            -->
                
            </p>
        </div>
        <div class="col-md-4">
            <?= $this->ContentBlock->image('about-image-1'); ?>
            <!--
            <?= $this->Html->image('self-image.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300"
            ]); ?>
            -->
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
                    AMEB certified
                </h4>
            </div>
        </div>

    </div>


    <h2><?= $this->ContentBlock->text('about-heading-3'); ?></h2>
    <div class="row">
        <div class="col-md-4">
        <?= $this->ContentBlock->image('about-image-1'); ?>
            <!--
            <?= $this->Html->image('studio_1.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300",
                'style' => 'height: 230px;'
            ]); ?>
            -->
        </div>
        <div class="col-md-4">
        <?= $this->ContentBlock->image('about-image-2'); ?>
            <!--
            <?= $this->Html->image('studio_2.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300",
                'style' => 'height: 230px;'
            ]); ?>
            -->
        </div>
        <div class="col-md-4">
        <?= $this->ContentBlock->image('about-image-3'); ?>
            <!--
            <?= $this->Html->image('studio_3.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300",
                'style' => 'height: 230px;'
            ]); ?>
            -->
        </div>
    </div>
</div>