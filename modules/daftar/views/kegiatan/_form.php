<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\Kegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

      <?=  $form-> field($model, 'tglmulai')->widget(DatePicker::classname(), [

                    'options' => ['placeholder' => 'Start time'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', 
                    ]
                ]);
    ?>  

       <?=  $form-> field($model, 'tglselesai')->widget(DatePicker::classname(), [

                    'options' => ['placeholder' => 'End Time'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', 
                    ]
                ]);
    ?>  

    <?= $form->field($model, 'nosurat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ringkasan')->textarea(['rows' => 6]) ?>

     <?=  $form-> field($model, 'tglsurat')->widget(DatePicker::classname(), [

                    'options' => ['placeholder' => 'End Time'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', 
                    ]
                ]);
    ?>  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
