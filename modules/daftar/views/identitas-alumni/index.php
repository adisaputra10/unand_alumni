<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\daftar\models\IdentitasAlumniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Identitas Alumni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identitas-alumni-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Identitas Alumni', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idalumni',
            'username',
            'password',
            'namalengkap',
            'nim',
            //'tgllahir',
            //'idprodi',
            //'angkatan',
            //'tahunlulus',
            //'tgllulus',
            //'tglwisuda',
            //'email:email',
            //'nohp',
            //'alamatrumah:ntext',
            //'namaperusahaan',
            //'posisipekerjaan',
            //'alamatperusahaan:ntext',
            //'emailperusahaan:email',
            //'bidangperusahaan',
            //'riwayatperusahaan:ntext',
            //'foto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
