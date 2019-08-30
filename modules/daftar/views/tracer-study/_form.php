<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\TracerStudy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tracer-study-form">

    <?php $form = ActiveForm::begin(); ?>
     <div class="col-md-6">
           


              <?= $form->field($model, 'idalumni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamatemail')->textInput(['maxlength' => true]) ?>
            
              </div>
   

   <div class="col-md-6">

    <?= $form->field($model, 'hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahunangkatan')->textInput() ?>
            </div>

            <div class="col-md-6">
    <?= $form->field($model, 'tahunlulus')->textInput() ?>

    <?= $form->field($model, 'masatunggu')->textInput(['maxlength' => true]) ?>

                
                            </div>
           <div class="col-md-6">

    <?= $form->field($model, 'institusipertama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pekerjaanpertama')->textInput(['maxlength' => true]) ?>
               
                            </div>
    <div class="col-md-6">

    <?= $form->field($model, 'gajipertama')->textInput() ?>

    <?= $form->field($model, 'pekerjaanskrg')->textInput(['maxlength' => true]) ?>
          </div>

    <div class="col-md-6">
    <?= $form->field($model, 'posisiskrg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gajiskrg')->textInput() ?>
         </div>
    
    <div class="col-md-6">

    <?= $form->field($model, 'lokasiskrg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relevansiilmu')->textInput(['maxlength' => true]) ?>
         </div>
    
       <div class="col-md-6">

    <?= $form->field($model, 'saran')->textarea(['rows' => 6]) ?>
             </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
