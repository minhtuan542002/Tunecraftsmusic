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
$this->assign('title', 'Services');
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <?php if (empty($packages)): ?>
            <p>No Packages found.</p>
        <?php else: ?>
            <?php foreach ($packages as $package): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo h($package->package_name); ?></h5>
                        <p class="card-text"><?php echo h($package->number_of_lessons); ?></p>
                        <p class="card-text">$<?php echo h($package->lesson_duration_minutes); ?></p>
                        <p class="card-text">$<?php echo h($package->cost_dollars); ?></p>
                        <p class="card-text">$<?php echo h($package->description); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section><!-- End Hero Section -->
