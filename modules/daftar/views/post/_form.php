<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    
   <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'clientOptions' => [
            'filebrowserImageUploadUrl' => Url::toRoute(['/ckeditor/store', 'command' => 'QuickUpload', 'responseType' => 'json']),
            'filebrowserUploadUrl' => Url::toRoute(['/ckeditor/store', 'command' => 'QuickUpload', 'responseType' => 'json']),
        ],
//        'kcfinder' => true,
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>
    
    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
