<?php

use yii\helpers\Html;
use app\models\IndonesiaDate;
use app\components\AppVersion;
use yii\helpers\Url;

$version = new AppVersion();
$inDate = new IndonesiaDate();


/* @var $this yii\web\View */

$this->title = '';
?>
<div class="site-index" style="margin-top: 0px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body center" style="padding-bottom: 0px;">
                    <div class="well">
                        <div class="panel-body center">
                            <h3>Hi <?php echo Yii::$app->user->identity->userNama; ?>, Selamat datang!</h3>
                            <p><?php echo Yii::$app->name; ?> adalah aplikasi yang dikembangkan untuk alumni Universitas Andalas dalam mengetahui berita dan agenda acara serta data lulusan setiap periode</p>
                            <span class="small-box-footer"><b><i class="fa fa-arrow-circle-right"></i> <?php echo 'Hari ini tanggal  ' . $inDate->setDate($inDate->getNOw()) . ' pukul ' . $inDate->setTime($inDate->getNow()); ?></b></span>
                        </div>
                    </div>
                </div>
            </div>
            
        <div class="panel panel-default" style="margin-top: -15px;">
                <div class="panel-body" style="padding-bottom: 0px;">
                    <div class="panel panel-warning">
                        <div class="panel-heading" style="padding: 4px;padding-left: 8px;">
                            <i class="fa fa-info-circle"></i>
                            Pengumuman dan Informasi
                       </div>
                       