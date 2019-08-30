<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\IdentitasAlumni */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identitas-alumni-form">
    <?php
    $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'idalumni')->textInput(['maxlength' => true]) ?>
              <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

           
        </div>
        <div class="col-md-6">
        
                <?= $form->field($model, 'nim')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput([]) ?>
            
            

          
        </div>
        <div class="col-md-6">
          
           
              <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
          
            


        </div>
        
   <div class="col-md-6">
       
            
        </div>

        <?php ActiveForm::end(); ?>

    </div>
