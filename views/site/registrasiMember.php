<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use yii\captcha\Captcha;
use app\models\IndonesiaDate;

$inDate = new IndonesiaDate();


/* @var $this yii\web\View */

$this->title = 'Registrasi Member';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Registrasi Member
                </div>
                <div class="panel-body">
                    <?php
                    if (Yii::$app->session->hasFlash('registrasiSubmitted')) {
                        ?>
                        <div class="alert alert-success">
                            Terima kasih, telah melakukan pendaftaran.<br/>
                            Silahkan periksa <b>Inbox/Spam</b> di email anda untuk aktivasi akun anda.
                        </div>
                        <a href="<?php echo Url::to(['index']); ?>" class="btn btn-sm btn-default btn-flat fa fa-reply"> Kembali</a>
                        <?php
                    } else {
                        ?>
                        <div class="alert alert-info">
                            <p class="note" style="margin:0px;">
                                Ketentuan pendaftaran member :
                            </p><ul style="margin-top:0px;">
                                <li>Pendaftaran member <span class="required"><b>wajib</b></span> menggunakan E-mail yang masih aktif, karena <b>Konfirmasi Aktivasi</b> akun akan dikirim ke email dan jika anda lupa password maka anda dapat melakukan reset password dan password anda akan dikirim ke e-mail <span class="required">(lihat inbox/spam pada e-mail anda)</span>.</li>
                                <li>Ketika member login pertama <span class="required"><b>wajib</b></span> mengunggah/ mengupload foto digital tampak wajah dengan ukuran 100 kb, foto akan diverifikasi ketika member mengikuti ujian/ tes.</li>
                                <li>Untuk member mahasiswa Universitas Andalas disarankan untuk <span class="required"><b>tidak</b></span> memiliki akun member lebih dari 1 (satu), karena NIM/No.BP yang sudah anda gunakan untuk mendaftar ujian/tes TOEFL pada 1 (satu) akun member tidak dapat digunakan pada akun member yang lain.</li>
                            </ul>
                            <p></p>
                        </div>
                        <?php
                        $form = ActiveForm::begin([
                                    'id' => 'frm-registrasi-member',
                                    'type' => ActiveForm::TYPE_HORIZONTAL
                        ]);

                        echo Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'item_1' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Nama',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'memberNama' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Nama'],
                                            'columnOptions' => ['colspan' => 5],
                                            'hint' => 'Nama lengkap dengan penulisan huruf kapital diawal kata, <i>Exp: Fulanah Bin Fulan</i>',
                                        ],
                                    ]
                                ],
                                'item_2' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Tempat/Tanggal Lahir',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-15px;'],
                                    'attributes' => [
                                        'memberTmpLahir' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Tempat Lahir'], 'columnOptions' => ['colspan' => 3]],
                                        'memberTglLahir' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => DatePicker::className(), 'options' => [
                                                'convertFormat' => true,
                                                'options' => ['placeholder' => 'Tanggal Lahir'],
                                                'pluginOptions' => [
                                                    'format' => 'yyyy-MM-dd',
                                                    'todayHighlight' => true,
                                                    'autoclose' => true
                                                ]
                                            ],
                                            'hint' => 'Format : yyyy-mm-dd',
                                            'columnOptions' => ['colspan' => 2]
                                        ],
                                    ]
                                ],
                                'item_3' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Jenis Kelamin',
                                    'columns' => 4,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-15px;'],
                                    'attributes' => [
                                        'memberJenkel' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Select2::className(), 'options' => [
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
                                'item_4' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'HP/Telp',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-15px;'],
                                    'attributes' => [
                                        'memberTelp' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'HP/Telp'],
                                            'columnOptions' => ['colspan' => 5],
                                            'hint' => 'Nomor HP/Telp yang dapat dihubungi.',
                                        ],
                                    ]
                                ],
                                'item_5' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Email',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-15px;'],
                                    'attributes' => [
                                        'memberEmail' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(), 'options' => [
                                                'clientOptions' => [
                                                    'alias' => 'email',
                                                ]
                                            ],
                                            'hint' => 'Email yang masih aktif dan sering dibuka',
                                            'columnOptions' => ['colspan' => 3]
                                        ],
                                    ]
                                ],
                                'item_6' => [
                                    'labelOptions' => ['hidden' => false,],
                                    'label' => 'Password',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-15px;'],
                                    'attributes' => [
                                        'memberPassword' => ['type' => Form::INPUT_PASSWORD, 'options' => ['placeholder' => 'Password'], 'columnOptions' => ['colspan' => 3]],
                                    ]
                                ],
                                'item_7' => [
                                    'labelOptions' => ['hidden' => false,],
                                    'label' => 'Ulangi Password',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-15px;'],
                                    'attributes' => [
                                        'verifyPass' => ['type' => Form::INPUT_PASSWORD, 'options' => ['placeholder' => 'Ulangi Password'], 'columnOptions' => ['colspan' => 3]],
                                    ]
                                ],
                                'item_99' => [
                                    'labelOptions' => ['hidden' => false,],
                                    'label' => 'Kode Verifikasi',
                                    'columns' => 1,
                                    'columnOptions' => ['rowspan' => 1, 'style' => 'margin-top:-5px;'],
                                    'attributes' => [
                                        'verifyCode' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => Captcha::className(), 'options' => [
                                                'template' => '<div class="row"><div class="col-lg-2">{image}</div><div class="col-lg-4">{input}</div></div>',
                                            ],
                                            'hint' => 'Masukan kode verifikasi'
                                        ],
                                    ]
                                ],
                                'item_act' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => '',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'actions' => [
                                            'type' => Form::INPUT_RAW,
                                            'value' => '<div style="text-align: left; margin-top: -5px">' .
                                            Html::submitButton(' Daftar', ['type' => 'button', 'class' => 'fa fa-send btn btn-primary btn-flat']) .
                                            '</div>'
                                        ],
                                    ]
                                ],
                            ]
                        ]);

                        ActiveForm::end();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>