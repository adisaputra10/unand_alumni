<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\Kegiatan */

$this->title = 'Update Kegiatan: ' . $model->idkegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idkegiatan, 'url' => ['view', 'id' => $model->idkegiatan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
