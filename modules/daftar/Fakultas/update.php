<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\Fakultas */

$this->title = 'Update Fakultas: ' . $model->idfk;
$this->params['breadcrumbs'][] = ['label' => 'Fakultas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idfk, 'url' => ['view', 'id' => $model->idfk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fakultas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
