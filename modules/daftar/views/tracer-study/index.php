<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\daftar\models\TracerStudySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tracer Studies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracer-study-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tracer Study', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtracer',
            'idalumni',
            'alamatemail:email',
            'hp',
            'tahunangkatan',
            //'tahunlulus',
            //'masatunggu',
            //'institusipertama',
            //'pekerjaanpertama',
            //'gajipertama',
            //'pekerjaanskrg',
            //'posisiskrg',
            //'gajiskrg',
            //'lokasiskrg',
            //'relevansiilmu',
            //'saran:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
