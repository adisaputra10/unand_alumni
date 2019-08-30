<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\Kegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tglmulai')->textInput() ?>

    <?= $form->field($model, 'tglselesai')->textInput() ?>

    <?= $form->field($model, 'nosurat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ringkasan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tglsurat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
