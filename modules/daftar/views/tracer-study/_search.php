<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\TracerStudySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tracer-study-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idtracer') ?>

    <?= $form->field($model, 'idalumni') ?>

    <?= $form->field($model, 'alamatemail') ?>

    <?= $form->field($model, 'hp') ?>

    <?= $form->field($model, 'tahunangkatan') ?>

    <?php // echo $form->field($model, 'tahunlulus') ?>

    <?php // echo $form->field($model, 'masatunggu') ?>

    <?php // echo $form->field($model, 'institusipertama') ?>

    <?php // echo $form->field($model, 'pekerjaanpertama') ?>

    <?php // echo $form->field($model, 'gajipertama') ?>

    <?php // echo $form->field($model, 'pekerjaanskrg') ?>

    <?php // echo $form->field($model, 'posisiskrg') ?>

    <?php // echo $form->field($model, 'gajiskrg') ?>

    <?php // echo $form->field($model, 'lokasiskrg') ?>

    <?php // echo $form->field($model, 'relevansiilmu') ?>

    <?php // echo $form->field($model, 'saran') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
