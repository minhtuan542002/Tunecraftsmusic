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
$this->assign('title', 'Learning Resources')
?>

<!-- ======= Learning Resources Section ======= -->
<section id="chefs" class="chefs d-flex align-items-center section-bg">
    <div class="container">

        <div class="section-header">
            <h2> </h2>
            <p>Our <span>Learning Resources</span></p>
        </div>

        <div class="row justify-content-between gy-5 mt-1">

            <?php foreach ($resources as $index => $resource) : ?>
                <div class="row pt-3">
                    <?php if ($index % 2 === 0) : ?>
                        <div class="lesson">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                                width="100%" 
                                                height="360"
                                                src="<?= 'https://www.youtube.com/embed/' . getYoutubeVideoId($resource->resource); ?>"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h2 data-aos="fade-up"><?= h($resource->heading); ?></h2>
                                    <p data-aos="fade-up"
                                    data-aos-delay="100"><?= h($resource->description); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="lesson">
                            <div class="row">
                                <div class="col-lg-6 order-lg-last">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                                width="100%" 
                                                height="360"
                                                src="<?= 'https://www.youtube.com/embed/' . getYoutubeVideoId($resource->resource); ?>"
                                                allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-6 order-lg-first">
                                    <h2 data-aos="fade-up"><?= h($resource->heading); ?></h2>
                                    <p data-aos="fade-up"
                                    data-aos-delay="100"><?= h($resource->description); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <?php
            // Function to extract YouTube video ID from shortened URL
            function getYoutubeVideoId($url) {
                $urlParts = explode('/', $url);
                $videoId = end($urlParts);
                return $videoId;
            }
            ?>
        </div>
    </div>
</section><!-- End Hero Section -->
