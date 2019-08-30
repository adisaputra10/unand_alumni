<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\WisudaWisudawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wisuda-wisudawan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wwNim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwNoAlumni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwIdSkripsi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwNik')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwGlrDepan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwGlrBelakang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJenkel')->dropDownList([ 'L' => 'L', 'P' => 'P', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wwTmpLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwTglLahir')->textInput() ?>

    <?= $form->field($model, 'wwTglLahirText')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwHp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwKabId')->textInput() ?>

    <?= $form->field($model, 'wwAlamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wwPendTerakhir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwAngkatan')->textInput() ?>

    <?= $form->field($model, 'wwProdiKode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwProgKekhususan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJenKode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwModelrId')->textInput() ?>

    <?= $form->field($model, 'wwJalurId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJalurNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwIsBidikmisi')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wwDosenPa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJudulTa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wwIsNoTa')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wwTglMulaiBimb')->textInput() ?>

    <?= $form->field($model, 'wwTglSelesaiBimb')->textInput() ?>

    <?= $form->field($model, 'wwLamaStudiThn')->textInput() ?>

    <?= $form->field($model, 'wwLamaStudiBln')->textInput() ?>

    <?= $form->field($model, 'wwThnWisuda')->textInput() ?>

    <?= $form->field($model, 'wwTglLulus')->textInput() ?>

    <?= $form->field($model, 'wwIPK')->textInput() ?>

    <?= $form->field($model, 'wwPredikatId')->textInput() ?>

    <?= $form->field($model, 'wwScoreToefl')->textInput() ?>

    <?= $form->field($model, 'wwSapsPredikat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwSapsLamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwTurnitinSimilar')->textInput() ?>

    <?= $form->field($model, 'wwTurnitinLamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwRepositoryLink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJurnalNama')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wwJurnalLink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJurnalLampSk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwJurnalVerifikasiTgl')->textInput() ?>

    <?= $form->field($model, 'wwJurnalVerifikasiStatus')->dropDownList([ 'Ditolak' => 'Ditolak', 'Diterima' => 'Diterima', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wwJurnalVerifikasiKet')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wwOrtuAyah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwOrtuIbu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwFoto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwWpId')->textInput() ?>

    <?= $form->field($model, 'wwConfirmed')->textInput() ?>

    <?= $form->field($model, 'wwIjazahPreviewed')->textInput() ?>

    <?= $form->field($model, 'wwIsSetuju')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wwTglSetuju')->textInput() ?>

    <?= $form->field($model, 'wwMengetahuiNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwMengetahuiNip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwMengetahuiJab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wwAnDekan')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'wwCreate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
