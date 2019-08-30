<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use yii\captcha\Captcha;
use app\models\IndonesiaDate;

$inDate = new IndonesiaDate();


/* @var $this yii\web\View */

$this->title = 'Konfirmasi Akun';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Konfirmasi AKun
                </div>
                <div class="panel-body">
                    <?php
                    if (Yii::$app->session->hasFlash('konfirmed')) {
                        ?>
                        <div class="alert alert-success">
                            Selamat, akun anda telah diaktifkan.<br/>
                            Silahkan login untuk melanjutkan pengisian data profil biodata alumni.
                        </div>
                        <a href="<?php echo Url::to(['login']); ?>" class="btn btn-sm btn-default btn-flat fa fa-key"> Masuk</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>