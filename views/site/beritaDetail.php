<?php

use yii\helpers\Html;
use app\models\IndonesiaDate;
use app\components\AppVersion;
use yii\helpers\Url;
use app\models\AppGroup;

$version = new AppVersion();
$inDate = new IndonesiaDate();


/* @var $this yii\web\View */

$this->title = 'Pengumuman dan Informasi';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Pengumuman dan Informasi
                </div> <?php //var_dump($berita); 
               ?>
                <div class="panel-body">
                    <h4><a href="<?php echo Url::to(['berita', 'act' => 'more', 'key' => $berita->beritaKey]); ?>"> <?php  echo $berita->beritaJudul; ?></a></h4>
                    <h5 style="font-style: italic;font-size: 12px;margin-top: -8px;">Last Update <?php echo $inDate->setDateTime($berita->beritaWktPublic); ?></h5>
                    <div style="margin-bottom: 25px;">
                        <?php echo $berita->beritaIsi; ?>
                    </div>
                    <a href="<?php echo Url::to(['berita', 'act' => 'list']); ?>" style="font-style: italic;">Daftar Pengumuman dan Informasi lainya...</a>
                </div>
            </div>
        </div>
    </div>
</div>