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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TuneCraft Studios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container my-5">
    <div class="row">
        <div class="col-md-7" style="margin-top: 50px;">
            <h1>Hello, I'm Afrooz Amini </h1>
            <p style="margin-top: 40px;">Your violin instructor here at Tunecraftstudio. I bring over eight years of
                teaching experience to the table, alongside a degree in classical music performance. My journey began
                with studies at the Music Centre of Fine Arts and the Arts University of Tehran in Iran, shaping me into
                the educator I am today. I'm well-versed in the Suzuki teaching approach and familiar with the AMEB
                violin exam syllabus, ensuring a comprehensive learning experience for my students. My background in
                both Iranian and Australian music institutions gives me a unique perspective, enriching the education I
                provide. I'm excited to guide aspiring violinists on their musical journey here at Tunecraftstudio.</p>
        </div>
        <div class="col-md-4">
            <!-- Placeholder for image -->
            <!--            <img src="path-to-your-image.jpg" class="img-fluid" alt="Responsive image">-->
            <?= $this->Html->image('self-image.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300"
            ]); ?>
        </div>
    </div>

    <div class="row align-items-start my-5">
        <!-- Main heading and text -->
        <div class="col-md-6">
            <h2>My work</h2>
            <p>
                My teaching approach emphasizes personalized attention and tailored instruction, ensuring each student
                receives the support they need to thrive in a nurturing and inspiring learning environment. Specializing
                in Suzuki methodology, I adapt my teaching to suit individual student needs, offering both traditional
                violin lessons and comprehensive preparation for the AMEB examination in Australia, ensuring a
                well-rounded musical education for aspiring violinists.</p>
        </div>

        <!-- Sub-sections with icons -->
        <div class="col-md-6 m-auto d-flex flex-column justify-content-center">
            <div class="mb-3">
                <h4 class="d-flex align-items-center">
                    <span class="icon me-2">🎵</span> <!-- Replace with actual icon -->
                    Suzuki Method
                </h4>
                <!-- <p>Nostrud tempor cillum sunt excepteur du ot proident deserunt enim consequat exercitation</p> -->
            </div>
            <hr>
            <div class="d-flex align-items-center">
                <h4 class="me-2"> <!-- Removed unnecessary d-flex class here -->
                    <span class="icon me-2">🏅</span> <!-- Replace with actual icon -->
                    AMEB certified
                </h4>
                <!-- <p>Ad do dolore cillum dolor et ex non dolor qui. Dolor amet tempor pariatur officia pariatur et</p> -->
            </div>
        </div>

    </div>


    <h2>Our Studio</h2>
    <!-- Placeholder images for studio -->
    <div class="row">
        <div class="col-md-4">
            <?= $this->Html->image('studio_1.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300",
                'style' => 'height: 230px;'
            ]); ?>
            <!--            <img src="path-to-your-image.jpg" class="img-fluid" alt="Placeholder image">-->
        </div>
        <div class="col-md-4">
            <?= $this->Html->image('studio_2.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300",
                'style' => 'height: 230px;'
            ]); ?>
            <!--            <img src="path-to-your-image.jpg" class="img-fluid" alt="Placeholder image">-->
        </div>
        <div class="col-md-4">
            <?= $this->Html->image('studio_3.jpg', [
                'alt' => 'CakePHP',
                'class' => "img-fluid",
                'data-aos' => "zoom-out",
                'data-aos-delay' => "300",
                'style' => 'height: 230px;'
            ]); ?>
            <!--            <img src="path-to-your-image.jpg" class="img-fluid" alt="Placeholder image">-->
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


