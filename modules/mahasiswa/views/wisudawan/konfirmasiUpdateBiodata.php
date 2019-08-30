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
use app\models\IndonesiaDate;
use app\modules\mahasiswa\models\RefPredikat;
use app\modules\mahasiswa\models\RefProdiNasional;
use app\modules\mahasiswa\models\RefKota;
use app\modules\mahasiswa\models\RefJenjang;

$inDate = new IndonesiaDate();

/* @var $this yii\web\View */
/* @var $model app\modules\mahasiswa\models\WisudaWisudawan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfirmasi Biodata';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-file-text"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center" style="padding-bottom: 0px;">
            <div class="alert alert-warning">
                <i class="fa fa-warning"></i>
                Silahkan periksa dengan teliti kebenaran biodata diri anda.
            </div>
            <?php
            $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'options' => ['enctype' => 'multipart/form-data']
            ]);
            ?>
            <div class="panel panel-success" style="margin-top: -10px;">
                <div class="panel-heading" style="padding: 7px;padding-left: 10px;">
                    <i class="fa fa-tag"></i> Biodata Diri
                </div>
                <div class="panel-body">
                    <?php
                    //Get Kota
//                    if (empty($model->wwKabId)) {
                        $dataKota = RefKota::find()
                                ->select(['kotaKode', 'CONCAT(kotaNamaResmi," - ",propNamaResmi)AS kotaNamaResmi', 'propNamaResmi AS propNama'])
                                ->join('JOIN', 'ref_propinsi', 'propKode=kotaPropKode')
                                ->where("LENGTH(kotaKode)=6")
                                ->orderBy('propNamaResmi ASC,kotaNamaResmi ASC')
                                ->all();
//                    } else {
//                        $dataKota = RefKota::find()
//                                ->select(['kotaKode', 'CONCAT(kotaNamaResmi," - ",propNamaResmi)AS kotaNamaResmi', 'propNamaResmi AS propNama'])
//                                ->join('JOIN', 'ref_propinsi', 'propKode=kotaPropKode')
//                                ->where("LENGTH(kotaKode)=LENGTH(:kode) AND LENGTH(propKode)=LENGTH(:lng)", [
//                                    ':kode' => $model->wwKabId,
//                                    ':lng' => RefKota::findOne($model->wwKabId)->kotaPropKode
//                                ])
//                                ->orderBy('propNamaResmi ASC,kotaNamaResmi ASC')
//                                ->all();
//                    }

                    echo Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'columns' => 1,
                        'attributes' => [
                            'item_1' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'NIM',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwNim' => ['type' => Form::INPUT_STATIC, 'options' => ['readonly' => 'readonly'], 'columnOptions' => ['colspan' => 1]],
                                ]
                            ],
                            'item_2' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Nama Lengkap',
                                'columns' => 4,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwGlrDepan' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Gelar Depan'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Gelar akademis yang sudah dimiliki bukan termasuk gelar yang akan diwisudakan. Contoh: Dr.'],
                                    'wwNama' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nama Lengkap'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Nama lengkap tanpa gelar dengan huruf kapital diawal kata. Contoh: Fulan'],
                                    'wwGlrBelakang' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Gelar Belakang'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Gelar belakang akademis yang sudah dimiliki bukan termasuk gelar yang akan diwisudakan. Contoh: , S.H.'],
                                ]
                            ],
                            'item_3' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Tempat/Tanggal Lahir',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwTmpLahir' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Tempat Lahir'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Tempat lahir sesuaikan dengan Ijazah sebelumnya'],
                                    'wwTglLahir' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DatePicker::className(), 'options' => [
                                            'convertFormat' => true,
                                            'options' => ['placeholder' => 'Tanggal Lahir'],
                                            'pluginOptions' => [
                                                'format' => 'yyyy-MM-dd',
                                                'todayHighlight' => true,
                                                'autoclose' => true
                                            ]
                                        ],
                                        'hint' => 'Format : yyyy-mm-dd'
                                    ],
                                    'wwTglLahirText'=> ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Tanggal Lahir'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Ketikan Tanggal Lahir sesuai dengan tulisan tanggal lahir pada Ijazah sebelumnya. Contoh: 17 Agustus 1991'],
                                ]
                            ],
                            'item_4' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Jenis Kelamin',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwJenkel' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                            'data' => ['L' => 'Laki-Laki', 'P' => 'Perempuan'],
                                            'size' => Select2:: MEDIUM,
                                            'options' => [
                                                'placeholder' => '- Pilih Jenis Kelamin -',
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => false,
                                                'multiple' => false,
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                            'item_5' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Nomor HP',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwHp' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nomor HP'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Nomor HP yang selalu aktif dan dapat dihubungi, hanya 1 (satu) Nomor HP saja. Contoh : 081374xxxxxx'],
                                ]
                            ],
                            'item_6' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Email',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwEmail' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(), 'options' => [
                                            'clientOptions' => [
                                                'alias' => 'email',
                                            ]
                                        ],
                                        'hint' => 'Email yang masih aktif dan sering dibuka',
                                        'columnOptions' => ['colspan' => 2]
                                    ],
                                ]
                            ],
                            'item_7' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Kabupaten/Kota',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwKabId' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                            'data' => ArrayHelper::map($dataKota, 'kotaKode', 'kotaNamaResmi', 'propNama'),
                                            'size' => Select2:: MEDIUM,
                                            'options' => [
                                                'placeholder' => '- Pilih Kabupaten/Kota -',
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => false,
                                                'multiple' => false,
                                            ],
                                        ],
                                        'hint' => 'Kab/Kota asal',
                                        'columnOptions' => ['colspan' => 2]
                                    ],
                                ]
                            ],
                            'item_8' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Alamat',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwAlamat' => ['type' => Form::INPUT_TEXTAREA, 'options' => [], 'columnOptions' => ['colspan' => 2], 'hint' => 'Alamat asal lengkap'],
                                ]
                            ],
                            'item_9' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Pendidikan Terakhir',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwPendTerakhir' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Pendidikan Terakhir'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Pendidikan terakhir anda sebelum menyelesaikan studi ini'],
                                ]
                            ],
                            'item_10' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Nama Ayah',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwOrtuAyah' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nama Ayah'], 'columnOptions' => ['colspan' => 2],'hint'=>'Nama ayah menggunakan huruf Kapital diawal kata. Contoh: Ayah Fulan.'],
                                ]
                            ],
                            'item_11' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Nama Ibu',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwOrtuIbu' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nama Ibu'], 'columnOptions' => ['colspan' => 2],'hint'=>'Nama ibu menggunakan huruf Kapital diawal kata. Contoh: Ibu Fulan.'],
                                ]
                            ],
                            'item_12' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Foto Formal',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwFoto' => ['type' => Form::INPUT_FILE, 'options' => ['placeholder' => 'Sertifikat SAPS'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Ukuran maksimum 200kb, format JPG/JPEG/PNG'],
                                    'foto' => ['type' => Form::INPUT_RAW, 'value' => Html::img(Url::to(['/site/getfoto', 'filename' => $model->wwFoto]), ['style' => 'height:100px;']) . '<div class="hint-block">Untuk mengganti foto cukup dengan mengupload ulang foto pengganti</div>', 'columnOptions' => ['colspan' => 2]]
                                ]
                            ],
                        ]
                    ]);
                    echo Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'columns' => 1,
                        'attributes' => [
                            'actions' => [
                                'type' => Form::INPUT_RAW,
                                'value' => '<div style="text-align: left; margin-top: 0px">' .
                                Html::a(' Batal', Url::to(['konfirmasi']), ['class' => 'btn btn-default btn-flat btn-lg fa fa-ban', 'style' => 'margin-right:5px;']) .
                                Html::submitButton(' Simpan', ['id' => 'btn-simpan', 'name' => 'btn-simpan', 'onclick' => '$(this).val(1);', 'type' => 'button', 'class' => 'fa fa-save btn btn-primary btn-flat btn-lg']) .
                                '</div>'
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
