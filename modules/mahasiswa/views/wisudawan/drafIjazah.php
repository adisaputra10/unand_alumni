<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\mahasiswa\models\WisudaWisudawan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preview Draf Ijazah';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-certificate"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center">
            <?php
            if (empty($model->wwIjazahPreviewed)) {
                ?>
                <div class="alert alert-warning">
                    <i class="fa fa-warning"></i>
                    Silahkan periksa biodata anda dalam draf ijazah dibawah ini dengan seksama.
                </div>
                <?php
            }
            ?>
            <div style="margin-top: 0px;margin-bottom: 25px;border: solid 1px #cccccc;border-radius: 2px;">
                <?php
                if ($model->wwJenKode == 'D3'||$model->wwJenKode == 'S1') {
                    echo $this->render('_drafIjazahS1', [
                        'result' => $result
                    ]);
                } else if ($model->wwJenKode == 'S2') {
                    echo $this->render('_drafIjazahS2', [
                        'result' => $result
                    ]);
                } else if ($model->wwJenKode == 'S3') {
                    echo $this->render('_drafIjazahS3', [
                        'result' => $result
                    ]);
                } else if ($model->wwJenKode == 'SP-1') {
                    echo $this->render('_drafIjazahSp1', [
                        'result' => $result
                    ]);
                } else if ($model->wwJenKode == 'PR') {
                    echo $this->render('_drafIjazahProfesi', [
                        'result' => $result
                    ]);
                }
                ?>
            </div>
            <div class="callout callout-important" style="margin-top: -10px;">
                Perhatikan data yang diberi warna <span style="background-color: yellow;">kuning</span>, apabila ada kesalahan silahkan perbaiki di menu <b>"Konfirmasi Biodata"</b> sebelum anda menerbitkan surat pernyataan.<br/><br/>
                Apakah biodata anda yang tercantum dalam <b>Draf Ijazah</b> diatas sudah <b>BENAR</b> dan yakin akan meneribitkan <b>Surat Pernyataan</b>? 
            </div>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'form-konfirmasi',
                        'type' => ActiveForm::TYPE_HORIZONTAL
            ]);

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
                'attributes' => [
                    'wwNim' => ['type' => Form::INPUT_HIDDEN, 'options' => ['readonly' => 'readonly']],
                    'actions' => [
                        'type' => Form::INPUT_RAW,
                        'value' => '<div style="text-align: left; margin-top: -10px">' .
                        (empty($model->wwIjazahPreviewed) ? Html::submitButton(' Ya, Terbitkan Surat Pernyataan', ['id' => 'btn-simpan', 'name' => 'btn-simpan', 'onclick' => '$(this).val(1);', 'type' => 'button', 'class' => 'fa fa-check-square-o btn btn-primary btn-flat btn-lg']) : Html::a(' Lihat Surat Pernyataan', Url::to(['pernyataan']), ['class' => 'btn btn-success btn-flat btn-lg fa fa-search']).Html::a(' Cetak Draf Ijazah', Url::to(['cetak','act'=>'draf-ijazah','ext'=>'pdf']), ['class' => 'btn btn-default btn-flat btn-lg fa fa-print','target'=>'_blank','style'=>'margin-left:5px;'])) .
                        '</div>'
                    ],
                ]
            ]);
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
