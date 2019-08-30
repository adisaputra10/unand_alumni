<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;




/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\IdentitasAlumni */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="identitas-alumni-formDaftar">
    <?php $form = ActiveForm::begin([
         'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'idalumni')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'password')->passwordInput([]) ?>

            <?= $form->field($model, 'namalengkap')->textInput(['maxlength' => true]) ?>
            
        </div>
        
         <div class="col-md-6">
             <?= $form->field($model, 'nim')->textInput(['maxlength' => true]) ?>
            
    <?= $form->field($model, 'idprodi')->dropDownList(
    	ArrayHelper::map(app\modules\daftar\models\Prodi::find()->all(),'idprodi','namaprodi'),
    	['prompt'=>'Select Prodi']
    ) ?>
            

        </div>
        
         <div class="col-md-6">
            
    <?= $form->field($model, 'angkatan')->textInput() ?>
              <?= $form->field($model, 'tahunlulus')->textInput() ?>
        </d iv>
        
        <div class="col-md-6">
          

  
         <?=  $form-> field($model, 'tgllulus')->widget(DatePicker::classname(), [

                    'options' => ['placeholder' => 'Start date & time'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', 
                    ]
                ]);
    ?>  
        </div>
                <?=  $form-> field($model, 'tglwisuda')->widget(DatePicker::classname(), [

                    'options' => ['placeholder' => 'Start date & time'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', 
                    ]
                ]);
    ?>  
        </div>
        
        <div class="col-md-6">
           
<?= $form->field($model, 'nohp')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'namaperusahaan')->textInput(['maxlength' => true]) ?>
   
        </div>
   
          <div class="col-md-6">

    <?= $form->field($model, 'posisipekerjaan')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'bidangperusahaan')->textInput(['maxlength' => true]) ?>

        </div>
        
        <div class="col-md-6">
           


                 <?= $form->field($model, 'alamatperusahaan')->textarea(['rows' => 6]) ?>
            
        </div>
        
         <div class="col-md-4">
           
   
         <?= $form->field($model, 'alamatrumah')->textarea(['rows' => 6]) ?>  
                 <?= $form->field($model, 'emailperusahaan')->textInput(['maxlength' => true]) ?>
   
              
        </div>
          <div class="col-md-4">
              <?= $form->field($model, 'riwayatperusahaan')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
             
            <?= $form->field($model, 'foto')->fileInput(['maxlength' => true]) ?>   
                 <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        
        
      
           <div class="col-md-6">
 
              
                    
         </div>
        
    </div>



   


    <div class="form-group">
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
