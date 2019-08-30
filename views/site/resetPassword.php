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

$this->title = 'Reset Password';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Reset Password
                </div>
                <div class="panel-body">
                    <?php
                    if (Yii::$app->session->hasFlash('resetSubmitted')) {
                        ?>
                        <div class="alert alert-success">
                            Password baru telah dikirim...<br/>
                            Silahkan periksa <b>Inbox/Spam</b> di email anda.
                        </div>
                        <a href="<?php echo Url::to(['index']); ?>" class="btn btn-sm btn-default btn-flat fa fa-reply"> Kembali</a>
                        <?php
                    } else {
                        $form = ActiveForm::begin([
                                    'id' => 'frm-reset-password',
                                    'type' => ActiveForm::TYPE_HORIZONTAL
                        ]);

                        echo Form::widget([
                            'model' => $model,
                            'form' => $form,
                            'columns' => 1,
                            'attributes' => [
                                'item_5' => [
                                    'labelOptions' => ['hidden' => false],
                                    'label' => 'Email',
                                    'columns' => 6,
                                    'columnOptions' => ['rowspan' => 1],
                                    'attributes' => [
                                        'memberEmail' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => MaskedInput::className(), 'options' => [
                                                'clientOptions' => [
                                                    'alias' => 'email',
                                                ]
                                            ],
                                            'hint' => 'Email yang anda daftarkan pada sebagai akun SIMTB',
                                            'columnOptions' => ['colspan' => 3]
                                        ],
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
                                            Html::submitButton(' Reset', ['type' => 'button', 'class' => 'fa fa-send btn btn-primary btn-flat']) .
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