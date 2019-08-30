<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box" style="margin-top: 12%;" background-image:url('/web/alumni/web/images/logo-header.png');>
    <div class="box box-success">
        <div class="box-body">
            <div class="profile-user-img img-responsive img-circle" style="text-align: center;">
                <?php echo Html::img(AppAsset::register($this)->baseUrl . '/images/logo-header.png', ['style' => 'width:50%;text-align:center;']); ?>
            </div>
            <h3 class="profile-username text-center" style="font-weight: bold;">Sistem Informasi Alumni</h3>
            <div class="login-box-body" style="margin-top: 20px;">

                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => true, 'options' => ['style' => 'margin-top:-15px;']]); ?>

                <?php
                $session = Yii::$app->session;
                echo ($session->has('message')) ? '<div class="alert alert-warning" style="margin-bottom:5px;">' . $session->get('message') . '</div>' : '';
                ?>

                <?php
                echo $form
                        ->field($model, 'username', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('username')])
                ?>

                <?php
                echo $form
                        ->field($model, 'password', $fieldOptions2)
                        ->label(false)
                        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
                ?>

                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;text-align: center;">
                        <?= Html::submitButton(' Masuk', ['class' => 'fa fa-key btn btn-primary btn-flat', 'name' => 'login-button']); ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 25px;">
                    <div class="col-md-12">
                        Anda lupa password? Klik <a href="<?php echo Url::to(['reset-password']); ?>">disini.</a>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<!-- /.login-box-body -->
