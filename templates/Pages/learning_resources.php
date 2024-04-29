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

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="row justify-content-between gy-5">
            <div class="col-lg-12 text-center text-lg-start">
                <h2 data-aos="fade-up" style="margin-bottom: 50px">Learning Resources</h2>
            </div>
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="row pt-3">
                    <div class="lesson">
                        <div class="row">
                            <?php if ($i % 2 == 1) { ?>
                                <div class="col-lg-6">
                                    <iframe width="100%" height="315"
                                            src="<?= $this->ContentBlock->text('learning-resource-' . $i); ?>"
                                            frameborder="0"
                                            allowfullscreen></iframe>
                                </div>
                                <div class="col-lg-6" style="margin: auto">
                                    <h2 data-aos="fade-up"><?= $this->ContentBlock->text('learning-heading-' . $i); ?></h2>
                                    <p data-aos="fade-up"
                                       data-aos-delay="100"><?= $this->ContentBlock->text('learning-description-' . $i); ?></p>
                                </div>
                            <?php } else { ?>

                                <div class="col-lg-6" style="margin: auto">
                                    <h2 data-aos="fade-up"><?= $this->ContentBlock->text('learning-heading-' . $i); ?></h2>
                                    <p data-aos="fade-up"
                                       data-aos-delay="100"><?= $this->ContentBlock->text('learning-description-' . $i); ?></p>
                                </div>
                                <div class="col-lg-6" >
                                    <iframe width="100%" height="315"
                                            src="<?= $this->ContentBlock->text('learning-resource-' . $i); ?>"
                                            frameborder="0"
                                            allowfullscreen></iframe>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section><!-- End Hero Section -->
