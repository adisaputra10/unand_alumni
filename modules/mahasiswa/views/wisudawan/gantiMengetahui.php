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
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use app\models\IndonesiaDate;
use yii\web\JsExpression;


$inDate = new IndonesiaDate();
?>
<div class="lhp-sebab-create">
    <div class="panel panel-default" style="margin-bottom: 0px;">
        <div class="panel-body center">
            <?php
            $form = ActiveForm::begin([
                        'id' => 'frm-mengetahui',
                        'type' => ActiveForm::TYPE_VERTICAL,
                        'options' => ['enctype' => 'multipart/form-data']
            ]);

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
                'attributes' => [
                    'wwMengetahuiNama' => ['label' => 'Nama Yang Mengetahui', 'type' => Form::INPUT_TEXT, 'options' => [ 'placeholder' => 'Nama Yang Mengetahui']],
                    'wwMengetahuiNip' => ['label' => 'NIP Yang Mengetahui', 'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'NIP Yang Mengetahui']],
                    'wwAnDekan' => ['label' => 'Yang Mengetahui Bukan Dekan?', 'type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                            'data' => ['0' => 'Tidak', '1' => 'Ya'],
                            'size' => Select2:: MEDIUM,
                            'pluginOptions' => [
                                'allowClear' => false,
                                'multiple' => false,
                                'dropdownParent' => new JsExpression('$("#frm-mengetahui")'),
                            ],
                        ],
                    ],
                    'wwMengetahuiJab' => ['label' => 'Jabatan Yang Mengetahui', 'type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Jabatan Yang Mengetahui']],
                ]
            ]);

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
                'attributes' => [
                    'actions' => [
                        'type' => Form::INPUT_RAW,
                        'value' => '<div style="text-align: center; margin-top: 0px">' .
                        Html::button(' Simpan', ['id' => 'btn-daftar', 'onclick' => 'btnSave();', 'type' => 'button', 'class' => 'fa fa-save btn btn-primary btn-flat btn-md']) .
                        '</div>'
                    ],
                ]
            ]);

            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
<?php
$urlSave = Yii::$app->request->absoluteUrl;
$urlReload = Url::to(['pernyataan']);
$js = <<<JS
    function btnSave(){
        $('#btn-daftar').attr('disabled','disabled');
        $.ajax({
            type: 'POST',
            url: '{$urlSave}',
            data: $('#frm-mengetahui').serialize(),
            success: function (data) {
                var rs = JSON.parse(data);
                if(rs.status=='success'){
                    $('#btn-daftar').removeAttr('disabled');
                    $('#modal-popup').modal('hide');
                    document.location='{$urlReload}';
                }else{
                    if(rs.status=='warning'){
                        $('div.form-group').removeClass('has-error');
                        $('div.form-group div.help-block').html('');
                        $('div.field-wisudawisudawan-'+rs.attribute.toLowerCase()).addClass('has-error');
                        $('.field-wisudawisudawan-'+rs.attribute.toLowerCase()+' div.help-block').html(rs.message);
                    }else{
                        alert(rs.message);
                    }
                    $('#btn-daftar').removeAttr('disabled');
                }
            },
        });
    }
    function btnClose(){
        $('#modal-popup').modal('hide');
    }
JS;
$this->registerJs($js, yii\web\View::POS_HEAD);
?>