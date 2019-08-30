<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\WisudaWisudawanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wisuda-wisudawan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'wwNim') ?>

    <?= $form->field($model, 'wwNoAlumni') ?>

    <?= $form->field($model, 'wwIdSkripsi') ?>

    <?= $form->field($model, 'wwNik') ?>

    <?= $form->field($model, 'wwNama') ?>

    <?php // echo $form->field($model, 'wwGlrDepan') ?>

    <?php // echo $form->field($model, 'wwGlrBelakang') ?>

    <?php // echo $form->field($model, 'wwJenkel') ?>

    <?php // echo $form->field($model, 'wwTmpLahir') ?>

    <?php // echo $form->field($model, 'wwTglLahir') ?>

    <?php // echo $form->field($model, 'wwTglLahirText') ?>

    <?php // echo $form->field($model, 'wwEmail') ?>

    <?php // echo $form->field($model, 'wwHp') ?>

    <?php // echo $form->field($model, 'wwKabId') ?>

    <?php // echo $form->field($model, 'wwAlamat') ?>

    <?php // echo $form->field($model, 'wwPendTerakhir') ?>

    <?php // echo $form->field($model, 'wwAngkatan') ?>

    <?php // echo $form->field($model, 'wwProdiKode') ?>

    <?php // echo $form->field($model, 'wwProgKekhususan') ?>

    <?php // echo $form->field($model, 'wwJenKode') ?>

    <?php // echo $form->field($model, 'wwModelrId') ?>

    <?php // echo $form->field($model, 'wwJalurId') ?>

    <?php // echo $form->field($model, 'wwJalurNama') ?>

    <?php // echo $form->field($model, 'wwIsBidikmisi') ?>

    <?php // echo $form->field($model, 'wwDosenPa') ?>

    <?php // echo $form->field($model, 'wwJudulTa') ?>

    <?php // echo $form->field($model, 'wwIsNoTa') ?>

    <?php // echo $form->field($model, 'wwTglMulaiBimb') ?>

    <?php // echo $form->field($model, 'wwTglSelesaiBimb') ?>

    <?php // echo $form->field($model, 'wwLamaStudiThn') ?>

    <?php // echo $form->field($model, 'wwLamaStudiBln') ?>

    <?php // echo $form->field($model, 'wwThnWisuda') ?>

    <?php // echo $form->field($model, 'wwTglLulus') ?>

    <?php // echo $form->field($model, 'wwIPK') ?>

    <?php // echo $form->field($model, 'wwPredikatId') ?>

    <?php // echo $form->field($model, 'wwScoreToefl') ?>

    <?php // echo $form->field($model, 'wwSapsPredikat') ?>

    <?php // echo $form->field($model, 'wwSapsLamp') ?>

    <?php // echo $form->field($model, 'wwTurnitinSimilar') ?>

    <?php // echo $form->field($model, 'wwTurnitinLamp') ?>

    <?php // echo $form->field($model, 'wwRepositoryLink') ?>

    <?php // echo $form->field($model, 'wwJurnalNama') ?>

    <?php // echo $form->field($model, 'wwJurnalLink') ?>

    <?php // echo $form->field($model, 'wwJurnalLampSk') ?>

    <?php // echo $form->field($model, 'wwJurnalVerifikasiTgl') ?>

    <?php // echo $form->field($model, 'wwJurnalVerifikasiStatus') ?>

    <?php // echo $form->field($model, 'wwJurnalVerifikasiKet') ?>

    <?php // echo $form->field($model, 'wwOrtuAyah') ?>

    <?php // echo $form->field($model, 'wwOrtuIbu') ?>

    <?php // echo $form->field($model, 'wwFoto') ?>

    <?php // echo $form->field($model, 'wwWpId') ?>

    <?php // echo $form->field($model, 'wwConfirmed') ?>

    <?php // echo $form->field($model, 'wwIjazahPreviewed') ?>

    <?php // echo $form->field($model, 'wwIsSetuju') ?>

    <?php // echo $form->field($model, 'wwTglSetuju') ?>

    <?php // echo $form->field($model, 'wwMengetahuiNama') ?>

    <?php // echo $form->field($model, 'wwMengetahuiNip') ?>

    <?php // echo $form->field($model, 'wwMengetahuiJab') ?>

    <?php // echo $form->field($model, 'wwAnDekan') ?>

    <?php // echo $form->field($model, 'wwCreate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
