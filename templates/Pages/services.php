<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Services');
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            background-color: #fff;
            border: 1px solid #e1e1e1;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .card-text {
            margin-bottom: 5px;
            color: #666;
        }

        .card-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .card-button:hover {
            background-color: #0056b3;
        }

        .lesson-label {
            color: #007bff; /* Blue */
            font-weight: bold;
        }

        .duration-label {
            color: #8e44ad; /* Purple */
            font-weight: bold;
        }

        .price-label {
            color: #dc3545; /* Red */
            font-weight: bold;
        }

        #hero {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .section-bg {
            background-color: #f8f9fa;
        }
    </style>
    
    <div class="container">
        <div class="row justify-content-center">
            <?php if (empty($packages)): ?>
                <div class="col-md-12 text-center" data-aos="fade-up">
                    <p>No Packages found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($packages as $package): ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo h($package->package_name); ?></h5>
                                <p class="card-text"><span class="lesson-label">Lessons:</span> <?php echo h($package->number_of_lessons); ?></p>
                                <p class="card-text"><span class="duration-label">Duration:</span> <?php echo h($package->lesson_duration_minutes); ?> minutes</p>
                                <p class="card-text"><span class="price-label">Price:</span> $<?php echo h($package->cost_dollars); ?></p>
                                <p class="card-text"><?php echo h($package->description); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section><!-- End Hero Section -->

<script>
  AOS.init();
</script>