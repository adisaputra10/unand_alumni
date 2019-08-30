<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\daftar\models\KegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agenda Kegiatan Fakultas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'idkegiatan',
            'nama',
            'tglmulai',
            'tglselesai',
            'nosurat',
            'ringkasan:ntext',
            'tglsurat',

         //   ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
