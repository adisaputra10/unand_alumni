<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\IdentitasAlumni */

$this->title = 'Update Data : ' . $model->namalengkap;
$this->params['breadcrumbs'][] = ['label' => 'Identitas Alumnis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idalumni, 'url' => ['view', 'id' => $model->idalumni]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="identitas-alumni-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
