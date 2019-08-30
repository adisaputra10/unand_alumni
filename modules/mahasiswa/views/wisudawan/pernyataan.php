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
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mahasiswa\models\WisudaWisudawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Pernyataan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-balance-scale"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center">
            <div style="margin-top: 0px;margin-bottom: 25px;border: solid 1px #cccccc;border-radius: 2px;">
                <?php
                echo $this->render('_pernyataan', [
                    'model' => $model,
                    'data' => $data
                ]);
                ?>
            </div>
<!--            <div style="margin-top: -20px;margin-bottom: 10px;">
                <a href="#" onclick="dialogGantiMengetahui('<?php //echo Url::to(['ganti-mengetahui']); ?>');" class="fa fa-gear btn btn-warning btn-flat btn-sm"> Ganti Mengetahui</a>
            </div>-->
            <div class="callout callout-important" style="">
                <?php
                if ($model->wwIsSetuju == 1) {
                    ?>
                    Terima kasih telah <b>menyetujui</b> pernyataan diatas.<br/>
                    Silahkan cetak <b>Surat Pernyataan</b> dan <b>Draf Ijazah</b> anda dan serahkan ke bagian akademik rektorat sebagai bukti anda telah resmi terdaftar sebagai peserta <b><?php echo $model->wwWp->wpNama.' Tahun '.$model->wwWp->wpTahun; ?></b>.<br/>
                    
                    <?php
                } else {
                    ?>
                    Silahkan periksa kembali <b>Draf Ijazah</b> anda dan pastikan data yang tercantum dalamnya <b>BENAR</b> sebelum menyetujui pernyataan ini. Anda tidak dapat merubah data anda apabila surat pernyataan telah disetujui.<br/><br/>
                    Apakah anda <b>Setuju</b> dengan pernyataan diatas? 
                    <?php
                }
                ?>
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
                        (empty($model->wwIsSetuju) ? Html::submitButton(' Ya, Saya Setuju', ['id' => 'btn-simpan', 'name' => 'btn-simpan', 'onclick' => '$(this).val(1);', 'type' => 'button', 'class' => 'fa fa-check-square-o btn btn-primary btn-flat btn-lg']) : Html::a(' Cetak Surat Pernyataan', Url::to(['cetak', 'act' => 'pernyataan','ext'=>'pdf']), ['class' => 'btn btn-default btn-flat btn-lg fa fa-print', 'target' => '_blank'])) .
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
//Popup
//Modal::begin([
//    'header' => 'Popup',
//    'id' => 'modal-popup',
//    'size' => 'modal-md',
//    'options' => [
//        'data-backdrop' => 'true',
//    ]
//]);
//echo '<div id="modalContentPopup"></div>';
//Modal::end();
//
//$currentUrl = Yii::$app->request->absoluteUrl;
//$js = <<<JS
//        function dialogGantiMengetahui(url) {
//            $('.modal-dialog').attr('class','modal-dialog modal-md');
//            $('#modalContentPopup').html('Loading...');
//            $('.modal-header').html('<b>Ganti Mengetahui</b><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>');
//            $('#modal-popup').modal('show')
//                    .find('#modalContentPopup')
//                    .load(url);
//        }        
//JS;
//$this->registerJs($js, yii\web\View::POS_HEAD);
?>