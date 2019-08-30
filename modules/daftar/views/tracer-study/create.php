<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\TracerStudy */

$this->title = 'Pengisian Tracer Study';
$this->params['breadcrumbs'][] = ['label' => 'Tracer Studies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracer-study-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
