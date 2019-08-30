<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\TracerStudy */


$this->params['breadcrumbs'][] = ['label' => 'Tracer Studies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tracer-study-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      Tracer Study Berhasil Diisi
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idtracer',
            'idalumni',
            'alamatemail:email',
            'hp',
            'tahunangkatan',
            'tahunlulus',
            'masatunggu',
            'institusipertama',
            'pekerjaanpertama',
            'gajipertama',
            'pekerjaanskrg',
            'posisiskrg',
            'gajiskrg',
            'lokasiskrg',
            'relevansiilmu',
            'saran:ntext',
        ],
    ]) ?>

</div>
