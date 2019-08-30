<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\WisudaWisudawan */

$this->title = 'Create Wisuda Wisudawan';
$this->params['breadcrumbs'][] = ['label' => 'Wisuda Wisudawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
