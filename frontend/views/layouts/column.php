<?php

use kartik\sidenav\SideNav;
?>

<? $this->beginContent('@frontends');?>
<div class="col-lg-6">
    <?= $content  ?>
    <p> Unified data shared on the left</p>
</div>
<div class="col-lg-6">
    <?
    echo SideNav::widget([
        'items' => [
            [
                'url' => ['/site/index'],
                'label' => 'Home',
                'icon' => 'home'
            ],
            [
                'url' => ['/site/about'],
                'label' => 'About',
                'icon' => 'info-sign',
                'items' => [
                    ['url' => ['/register'], 'label' => 'From'],
                    ['url' => ['/register/user'], 'label' => 'Table'],
                ],
            ],
        ],
    ]);
    ?>
</div>


<? $this->endContent(); ?>