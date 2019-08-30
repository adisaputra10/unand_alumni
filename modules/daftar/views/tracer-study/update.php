<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\TracerStudy */

$this->title = 'Update Tracer Study: ' . $model->idtracer;
$this->params['breadcrumbs'][] = ['label' => 'Tracer Studies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtracer, 'url' => ['view', 'id' => $model->idtracer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tracer-study-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
