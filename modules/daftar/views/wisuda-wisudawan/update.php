<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\WisudaWisudawan */

$this->title = 'Update Wisuda Wisudawan: ' . $model->wwNim;
$this->params['breadcrumbs'][] = ['label' => 'Wisuda Wisudawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wwNim, 'url' => ['view', 'id' => $model->wwNim]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wisuda-wisudawan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
