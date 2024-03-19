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


use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = 'default';

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

// if (!Configure::read('debug')) :
//     throw new NotFoundException(
//         'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
//     );
// endif;


?>



<main>
    <section class="page-section">
                <div class="container">
                    <div class="product-item">
                        <div class="product-item-title d-flex">
                            <div class="bg-faded p-5 d-flex ms-auto rounded">
                                <h2 class="section-heading mb-0">
                                    <span class="section-heading-upper">Celebrate Your Beauty</span>
                                    <span class="section-heading-lower">Makeup Artistry</span>
                                </h2>
                            </div>
                        </div>
                        <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="img/<?=$setting->service_img1 ?>" alt="..." />
                        <div class="product-item-description d-flex me-auto">
                            <div class="bg-faded p-5 rounded"><p class="mb-0"><?=$setting->service_text1 ?></p></div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="page-section">
                <div class="container">
                    <div class="product-item">
                        <div class="product-item-title d-flex">
                            <div class="bg-faded p-5 d-flex me-auto rounded">
                                <h2 class="section-heading mb-0">
                                    <span class="section-heading-upper">Tailored Elegance</span>
                                    <span class="section-heading-lower">Custom Fashion Design</span>
                                </h2>
                            </div>
                        </div>
                        <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="img/<?=$setting->service_img2 ?>" alt="..." />
                        <div class="product-item-description d-flex ms-auto">
                            <div class="bg-faded p-5 rounded"><p class="mb-0"><?=$setting->service_text2 ?></p></div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="page-section">
                <div class="container">
                    <div class="product-item">
                        <div class="product-item-title d-flex">
                            <div class="bg-faded p-5 d-flex ms-auto rounded">
                                <h2 class="section-heading mb-0">
                                    <span class="section-heading-upper">Wig Perfection</span>
                                    <span class="section-heading-lower">Expert Styling Services</span>
                                </h2>
                            </div>
                        </div>
                        <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="img/<?=$setting->service_img3 ?>" alt="..." />
                        <div class="product-item-description d-flex me-auto">
                            <div class="bg-faded p-5 rounded"><p class="mb-0"><?=$setting->service_text3 ?></p></div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="page-section">
                <div class="container">
                    <div class="product-item">
                        <div class="product-item-title d-flex">
                            <div class="bg-faded p-5 d-flex ms-auto rounded">
                                <h2 class="section-heading mb-0">
                                    <span class="section-heading-upper">Your Signature Look</span>
                                    <span class="section-heading-lower">Professional Hairstyling Services</span>
                                </h2>
                            </div>
                        </div>
                        <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="img/<?=$setting->service_img4 ?>" alt="..." />
                        <div class="product-item-upper">Your Signature Look</span>
                        <div class="section-heading-lower">Professional Hairstyling Services</span>
                        <div class="product-item-description d-flex me-auto">
                            <div class="bg-faded p-5 rounded"><p class="mb-0"><?=$setting->service_text4 ?></p></div>
                        </div>
                    </div>
                </div>
            </section>
<main>