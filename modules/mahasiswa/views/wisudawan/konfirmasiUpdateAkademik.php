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
<style>
    .hidden-btn-add-multi{
        display: none;
    }
    .hidden-btn-remove-multi{
        display: none;
    }
</style>
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-file-text"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center" style="padding-bottom: 0px;">
            <div class="alert alert-warning">
                <i class="fa fa-warning"></i>
                Silahkan periksa dengan teliti kebenaran biodata anda.
            </div>
            <?php
            $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_HORIZONTAL,
                        'options' => ['enctype' => 'multipart/form-data']
            ]);
            ?>
            <div class="panel panel-success" style="margin-top: -15px;">
                <div class="panel-heading" style="padding: 7px;padding-left: 10px;">
                    <i class="fa fa-tag"></i> Akademik
                </div>
                <div class="panel-body">
                    <?php
                    //Get Predikat
                    $dataPredikat = RefPredikat::find()
                            ->where("predikatId=:id", [':id' => $model->wwPredikatId])
                            ->all();
                    //Get Program Studi
                    $dataProdi = RefProdiNasional::find()
                            ->select(['prodiKode', 'CONCAT(prodiNama," - ",fakNama)AS prodiNama', 'fakNama'])
                            ->join('JOIN', 'ref_fakultas', 'fakId=prodiFakId')
                            ->where("prodiKode=:kode", [':kode' => $model->wwProdiKode])
                            ->all();
                    //Get Jenjang
                    $dataJenjang = RefJenjang::find()
                            ->where("jenKode<>'-' AND jenKode=:kode", [':kode' => $model->wwJenKode])
                            ->all();

                    echo Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'columns' => 1,
                        'attributes' => [
                            'item_19' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Nomor Alumni',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwNoAlumni' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nomor Alumni'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Nomor alumni didapat dari fakultas masing-masing. Nomor Alumni akan terisi otomatis apabila fakultas telah mengentrikan nomor alumni anda.'],
                                ]
                            ],
                            'item_20' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Angkatan/ Jenjang',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwAngkatan' => ['type' => Form::INPUT_TEXT, 'options' => ['readonly' => 'readonly'], 'columnOptions' => ['colspan' => 1]],
                                    'wwJenKode' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                            'data' => ArrayHelper::map($dataJenjang, 'jenKode', 'jenNama'),
                                            'size' => Select2:: MEDIUM,
                                            'options' => [
                                                'placeholder' => '- Pilih Jenjang -',
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => false,
                                                'multiple' => false,
                                            ],
                                        ],
                                        'columnOptions' => ['colspan' => 1]
                                    ]
                                ]
                            ],
                            'item_21' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Program Studi',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwProdiKode' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                            'data' => ArrayHelper::map($dataProdi, 'prodiKode', 'prodiNama', 'fakNama'),
                                            'size' => Select2:: MEDIUM,
                                            'options' => [
                                                'placeholder' => '- Pilih Program Studi -',
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => false,
                                                'multiple' => false,
                                            ],
                                        ],
                                        'columnOptions' => ['colspan' => 2]
                                    ],
                                ]
                            ],
                            'item_22' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Program Kekhususan/Pemusatan',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwProgKekhususan' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Program Kekhususan'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Diisi apabila ada program kekhususan/ pemusatan/ konsentrasi'],
                                ]
                            ],
                            'item_23' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Apakah Anda Mahasiswa Bidikmisi?',
                                'columns' => 6,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwIsBidikmisi' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                            'data' => ['0' => 'Tidak', '1' => 'Ya'],
                                            'size' => Select2:: MEDIUM,
                                            'pluginOptions' => [
                                                'allowClear' => false,
                                                'multiple' => false,
                                            ],
                                        ],
                                        'columnOptions' => ['colspan' => 1]
                                    ],
                                ]
                            ],
                            'item_24' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Pembimbing Akademik',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwDosenPa' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Pembimbing Akademik'], 'columnOptions' => ['colspan' => 2]],
                                ]
                            ],
                        ]
                    ]);
                    if ($model->wwIsNoTa == '0') {
                        echo Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'item_25' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Judul TA/Skripsi/Tesis/Disertasi',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwJudulTa' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => CKEditor::className(), 'options' => ['preset' => 'basic'], 'columnOptions' => ['colspan' => 2]],
                                    ]
                                ],
                                'item_pbb' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Pembimbing TA/Skripsi/Tesis/Disertasi',
                                    'columns' => 1,
                                    'columnOptions' => ['rowspan' => 2],
                                    'attributes' => [
                                        'pembimbing' => ['label' => false, 'type' => Form::INPUT_WIDGET, 'widgetClass' => MultipleInput::className(), 'options' => [
                                                'columns' => [
                                                        [
                                                        'name' => 'pbbNama',
                                                        'title' => 'Nama Pembimbing',
                                                        'type' => MultipleInputColumn::TYPE_TEXT_INPUT,
                                                        'headerOptions' => [
                                                            'style' => 'width:300px;'
                                                        ],
                                                        'options' => [
                                                            'style' => 'text-align:left;margin-left:-15px;',
                                                        //'readonly' => 'readonly',
                                                        ]
                                                    ],
                                                        [
                                                        'name' => 'pbbKet',
                                                        'title' => 'Keterangan',
                                                        'type' => Select2::className(),
                                                        'headerOptions' => [
                                                            'style' => 'width:180px;padding-left:20px;'
                                                        ],
                                                        'options' => [
                                                            'data' => [
                                                                //'Pembimbing Utama' => 'Pembimbing Utama',
                                                                'Pembimbing 1' => 'Pembimbing 1',
                                                                'Pembimbing 2' => 'Pembimbing 2',
                                                                'Pembimbing 3' => 'Pembimbing 3',
                                                                'Pembimbing 4' => 'Pembimbing 4',
                                                            //'Pembimbing I' => 'Pembimbing I',
                                                            //'Pembimbing II' => 'Pembimbing II',
                                                            //'Pembimbing III' => 'Pembimbing III',
                                                            //'Pembimbing IV' => 'Pembimbing IV',
                                                            ],
                                                            'options' => [
                                                                'placeholder' => '- Pilih Keterangan -',
                                                            ],
                                                        ]
                                                    ],
                                                ],
                                                'max' => 4
//                                                'addButtonOptions' => [
//                                                    'class' => 'hidden-btn-add-multi',
//                                                ],
//                                                'removeButtonOptions' => [
//                                                    'class' => 'hidden-btn-remove-multi',
//                                                ]
                                            ],
                                        ],
                                    ]
                                ],
                                'item_26' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Mulai/ Selesai Bimbingan',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwTglMulaiBimb' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DatePicker::className(), 'options' => [
                                                'convertFormat' => true,
                                                'options' => ['placeholder' => 'Mulai Bimbingan'],
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-MM-dd',
                                                    'todayHighlight' => true,
                                                    'autoclose' => true
                                                ],
                                            //'disabled' => true
                                            ],
                                        ],
                                        'wwTglSelesaiBimb' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DatePicker::className(), 'options' => [
                                                'convertFormat' => true,
                                                'options' => ['placeholder' => 'Selesai Bimbingan'],
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-MM-dd',
                                                    'todayHighlight' => true,
                                                    'autoclose' => true
                                                ],
                                            //'disabled' => true
                                            ],
                                        ],
                                    ]
                                ],
                            ]
                        ]);
                    }

                    echo Form::widget([
                        'model' => $model,
                        'form' => $form,
                        'columns' => 1,
                        'attributes' => [
                            'item_27' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Lama Studi',
                                'columns' => 6,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwLamaStudiThn' => ['type' => Form::INPUT_TEXT, 'options' => ['readonly' => 'readonly'], 'columnOptions' => ['colspan' => 1]],
                                    'tahun' => ['type' => Form::INPUT_RAW, 'value' => '<div style="text-align: left; margin-top: 5px;margin-left:-20px;">Tahun</div>', 'columnOptions' => ['colspan' => 1]],
                                    'wwLamaStudiBln' => ['type' => Form::INPUT_TEXT, 'options' => ['readonly' => 'readonly'], 'columnOptions' => ['colspan' => 1]],
                                    'bulan' => ['type' => Form::INPUT_RAW, 'value' => '<div style="text-align: left; margin-top: 5px;margin-left:-20px;">Bulan</div>', 'columnOptions' => ['colspan' => 1]],
                                ]
                            ],
                            'item_28' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Tanggal Lulus',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwTglLulus' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DatePicker::className(), 'options' => [
                                            'convertFormat' => true,
                                            'options' => ['placeholder' => 'Tanggal Lulus', 'readonly' => 'readonly'],
                                            'pluginOptions' => [
                                                'format' => 'yyyy-MM-dd',
                                                'todayHighlight' => false,
                                                'autoclose' => true,
                                            ],
                                            'disabled' => true
                                        ],
                                    ]
                                ]
                            ],
                            'item_29' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'IPK',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwIPK' => ['type' => Form::INPUT_TEXT, 'options' => ['readonly' => 'readonly'], 'columnOptions' => ['colspan' => 1]],
                                ]
                            ],
                            'item_30' => [
                                'labelOptions' => ['hidden' => false],
                                'label' => 'Predikat Lulus',
                                'columns' => 3,
                                'columnOptions' => ['rowspan' => 1],
                                'attributes' => [
                                    'wwPredikatId' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                            'data' => ArrayHelper::map($dataPredikat, 'predikatId', 'predikatNama'),
                                            'size' => Select2:: MEDIUM,
                                            'options' => [
                                                'placeholder' => '- Pilih Predikat Lulus -',
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => false,
                                                'multiple' => false,
                                            ],
                                        ],
                                        'columnOptions' => ['colspan' => 1]
                                    ],
                                ]
                            ],
                        ]
                    ]);

                    if ($model->wwJenKode == 'D3' || $model->wwJenKode == 'S1') {
                        echo Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'item_31' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Score TOEFL',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwScoreToefl' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Score TOEFL'], 'columnOptions' => ['colspan' => 1]],
                                    ]
                                ],
                            ]
                        ]);
                        if ($model->wwJalurId != 'K' && $model->wwJalurId != 'N' && $model->wwJalurId != 'O') {
                            echo Form::widget([
                                'model' => $model,
                                'form' => $form,
                                'columns' => 1,
                                'attributes' => [
                                    'item_32' => [
                                        'labelOptions' => ['hidden' => false],
                                        'label' => 'Predikat SAPS/ Sertifikat',
                                        'columns' => 3,
                                        'columnOptions' => ['rowspan' => 1],
                                        'attributes' => [
                                            'wwSapsPredikat' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
                                                    'data' => [
                                                        'Kurang Aktif' => 'Kurang Aktif',
                                                        'Cukup Aktif' => 'Cukup Aktif',
                                                        'Aktif' => 'Aktif',
                                                        'Sangat Aktif' => 'Sangat Aktif',
                                                    ],
                                                    'size' => Select2:: MEDIUM,
                                                    'options' => [
                                                        'placeholder' => '- Pilih Predikat SAPS -',
                                                    ],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'multiple' => false,
                                                    ],
                                                ],
                                            ],
                                            'wwSapsLamp' => ['type' => Form::INPUT_FILE, 'options' => ['placeholder' => 'Sertifikat SAPS'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Upload Sertifikat SAPS. Ukuran maksimum 200kb, format .PDF'],
                                            'lampiranSaps' => ['type' => Form::INPUT_RAW, 'value' => empty($model->wwSapsLamp) ? '' : Html::a(' Sertifikat SAPS', Url::to(['download', 'act' => 'saps', 'filename' => $model->wwSapsLamp]), ['target' => '_blank', 'class' => 'label label-info fa fa-paperclip', 'style' => 'margin-left:0px;']) . '<div class="hint-block">Untuk mengganti file cukup dengan mengupload ulang foto pengganti</div>', 'columnOptions' => ['colspan' => 1]]
                                        ]
                                    ],
                                ]
                            ]);
                        }
                    }

                    if ($isVT == 1) {
                        echo Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'item_41' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Persentase Index Kesamaan pada Turnitin (%)',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwTurnitinSimilar' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Index Kemiripan (%)'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Diisi dengan total persentase index kesamaan yang diperoleh dari <a href="https://www.turnitin.com/" target="_blank">https://www.turnitin.com/</a>.'],
                                        'wwTurnitinLamp' => ['type' => Form::INPUT_FILE, 'options' => ['placeholder' => 'Lampiran Hasil Koreksi Turnitin'], 'columnOptions' => ['colspan' => 1], 'hint' => 'Upload Hasil Koreksi Turnitin. Ukuran maksimum 200kb, format .PDF'],
                                        'lampiranTurnitin' => ['type' => Form::INPUT_RAW, 'value' => empty($model->wwTurnitinLamp) ? '' : Html::a(' Lampiran Hasil Turnitin', Url::to(['download', 'act' => 'turnitin', 'filename' => $model->wwTurnitinLamp]), ['target' => '_blank', 'class' => 'label label-info fa fa-paperclip', 'style' => 'margin-left:0px;']) . '<div class="hint-block">Untuk mengganti file cukup dengan mengupload ulang file pengganti</div>', 'columnOptions' => ['colspan' => 1]]
                                    ]
                                ],
                                'item_42' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Link Scholar Unand',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwRepositoryLink' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(), 'options' => [
                                                'clientOptions' => [
                                                    'alias' => 'url',
                                                ]
                                            ],
                                            'columnOptions' => ['colspan' => 2],
                                            'hint' => 'Diisi dengan URL Scholar Skripsi/Tesis/Disertasi/dll yang anda upload di <a href="http://scholar.unand.ac.id" target="_blank">http://scholar.unand.ac.id</a>'
                                        ]
                                    ]
                                ],
                            ]
                        ]);
                    }

                    if ($isVJ == 1) {
                        echo Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'item_51' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Judul Artikel',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwJurnalNama' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Judul Artikel pada Jurnal/Proceeding'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Diisi dengan Judul Artikel pada Jurnal/Proceeding yang telah dipublish.'],
                                    ]
                                ],
                                'item_511' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Surat Pernyataan Keabsahan Artikel',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwJurnalLampSk' => ['type' => Form::INPUT_FILE, 'options' => ['placeholder' => 'Lampiran Hasil Koreksi Turnitin'], 'columnOptions' => ['colspan' => 2], 'hint' => 'Upload Surat Pernyataan Keabsahan Artikel. Ukuran maksimum 200kb, format .PDF'],
                                        'lampiranSkJurnal' => ['type' => Form::INPUT_RAW, 'value' => empty($model->wwJurnalLampSk) ? '' : Html::a(' Lampiran Surat Pernyataan Keabsahan Artikel', Url::to(['download', 'act' => 'surat-absah-artikel', 'filename' => $model->wwJurnalLampSk]), ['target' => '_blank', 'class' => 'label label-info fa fa-paperclip', 'style' => 'margin-left:0px;']) . '<div class="hint-block">Untuk mengganti file cukup dengan mengupload ulang file pengganti</div>', 'columnOptions' => ['colspan' => 1]]
                                    ]
                                ],
                                'item_52' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Link Artikel pada Jurnal/ Proceeding',
                                    'columns' => 3,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'wwJurnalLink' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(), 'options' => [
                                                'clientOptions' => [
                                                    'alias' => 'url',
                                                ]
                                            ],
                                            'columnOptions' => ['colspan' => 2],
                                            'hint' => 'Diisi dengan URL Artikel pada Jurnal/Proceeding anda yang telah dipublish'
                                        ]
                                    ]
                                ],
                            ]
                        ]);
                    }

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
