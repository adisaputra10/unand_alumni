<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="art-object567354297-fo" data-left="0%"></span><h1 class="art-headline-fo" data-left="10%">'.Yii::$app->versionApp->companyName().'</h1><h2 class="art-slogan-fo" data-left="10%">'.Yii::$app->name.'</h2>',//.Html::img(AppAsset::register($this)->baseUrl . '/images/logo-unand.png', ['style' => 'width:34px;margin-top:-10px;float:left;margin-right:5px;border:2px solid;border-radius:3px;background-color:white;']) . 'e-Office Universitas Andalas',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'style' => 'font-size:20px;'
        ],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav navbar-right',
            'style' => 'margin:0px;margin-right:15px;'
            ],
        'items' => [
            ['label' => ' Beranda', 'url' => ['/site/index'],'linkOptions' =>['class'=>'fa fa-home']],
           ['label' => ' Agenda', 'url' => ['/daftar/kegiatan'],'linkOptions' =>['class'=>'bg-orange fa fa-calendar']],
            ['label' => ' Pendaftaran Anggota Alumni', 'url' => ['/daftar/identitas-alumni/create'],'linkOptions' =>['class'=>'bg-purple fa fa-paper-plane-o']],

            ['label' => ' Pengisian Tracer Study', 'url' => ['/daftar/tracer-study/create'],'linkOptions' =>['class'=>'bg-red fa fa-key']],
                       ['label' => ' Login', 'url' => ['/site/login'],'linkOptions' =>['class'=>'bg-navy fa fa-key']],
        ],
    ]);
    NavBar::end();
    ?>
    <!--</nav>-->
</header>
