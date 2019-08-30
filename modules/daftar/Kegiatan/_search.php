<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\KegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idkegiatan') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'tglmulai') ?>

    <?= $form->field($model, 'tglselesai') ?>

    <?= $form->field($model, 'nosurat') ?>

    <?php // echo $form->field($model, 'ringkasan') ?>

    <?php // echo $form->field($model, 'tglsurat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
