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

use Cake\Routing\Router;

$this->assign('title', 'Packages');
?>

<!-- ======= Packages Section ======= -->
<section id="chefs" class="chefs section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2> </h2>
            <p>Our <span>Services</span></p>
        </div>

        <div class="row gy-4 mt-1">
            <?php if (empty($packages)): ?>
                <div class="col-md-12 text-center" data-aos="fade-up">
                    <p>No Packages found.</p>
                </div>
            <?php else: ?>
                <?php foreach ($packages as $index => $package): ?>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="chef-member">
                            <div class="member-img">
                                <img style="height: 416px; width: 416px"
                                     src="<?php echo Router::url("/", true) ?>img/service-<?php echo ($index % 3) + 1 ?>.jpeg"
                                     class="img-fluid"
                                     alt="">
                            </div>
                            <div class="member-info">
                                <h4><?php echo h($package->package_name); ?></h4>
                                <span>Lessons: <?php echo h($package->number_of_lessons); ?></span>
                                <span>Duration: <?php echo h($package->lesson_duration_minutes); ?> minutes </span>
                                <span>Cost: $<?php echo h($package->cost_dollars); ?></span>
                                <p><?php echo h($package->description); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

    </div>
</section>

<script>
    AOS.init();
</script>
