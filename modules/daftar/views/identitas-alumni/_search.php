<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\IdentitasAlumniSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identitas-alumni-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idalumni') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'namalengkap') ?>

    <?= $form->field($model, 'nim') ?>

    <?php // echo $form->field($model, 'tgllahir') ?>

    <?php // echo $form->field($model, 'idprodi') ?>

    <?php // echo $form->field($model, 'angkatan') ?>

    <?php // echo $form->field($model, 'tahunlulus') ?>

    <?php // echo $form->field($model, 'tgllulus') ?>

    <?php // echo $form->field($model, 'tglwisuda') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'nohp') ?>

    <?php // echo $form->field($model, 'alamatrumah') ?>

    <?php // echo $form->field($model, 'namaperusahaan') ?>

    <?php // echo $form->field($model, 'posisipekerjaan') ?>

    <?php // echo $form->field($model, 'alamatperusahaan') ?>

    <?php // echo $form->field($model, 'emailperusahaan') ?>

    <?php // echo $form->field($model, 'bidangperusahaan') ?>

    <?php // echo $form->field($model, 'riwayatperusahaan') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
