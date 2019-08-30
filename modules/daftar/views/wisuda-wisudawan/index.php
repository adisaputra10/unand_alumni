<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\daftar\models\WisudaWisudawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pencarian Data Lulusan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
          //  'wwNik',
            'wwNim',
             'wwNama',
            'wwNoAlumni',
       
            //'wwGlrDepan',
            //'wwGlrBelakang',
            //'wwJenkel',
            //'wwTmpLahir',
            //'wwTglLahir',
            //'wwTglLahirText',
            //'wwEmail:email',
            //'wwHp',
            //'wwKabId',
            //'wwAlamat:ntext',
            //'wwPendTerakhir',
            //'wwAngkatan',
            //'wwProdiKode',
            //'wwProgKekhususan',
            //'wwJenKode',
            //'wwModelrId',
            //'wwJalurId',
            //'wwJalurNama',
            //'wwIsBidikmisi',
            //'wwDosenPa',
            //'wwJudulTa:ntext',
            //'wwIsNoTa',
            //'wwTglMulaiBimb',
            //'wwTglSelesaiBimb',
            //'wwLamaStudiThn',
            //'wwLamaStudiBln',
            'wwThnWisuda',
            
            'wwTglLulus',
            'wwLamaStudiThn',
            'wwLamaStudiBln',
         
            //'wwIPK',
            //'wwPredikatId',
            //'wwScoreToefl',
            //'wwSapsPredikat',
            //'wwSapsLamp',
            //'wwTurnitinSimilar',
            //'wwTurnitinLamp',
            //'wwRepositoryLink',
            //'wwJurnalNama:ntext',
            //'wwJurnalLink',
            //'wwJurnalLampSk',
            //'wwJurnalVerifikasiTgl',
            //'wwJurnalVerifikasiStatus',
            //'wwJurnalVerifikasiKet:ntext',
            //'wwOrtuAyah',
            //'wwOrtuIbu',
            //'wwFoto',
            //'wwWpId',
            //'wwConfirmed',
            //'wwIjazahPreviewed',
            //'wwIsSetuju',
            //'wwTglSetuju',
            //'wwMengetahuiNama',
            //'wwMengetahuiNip',
            //'wwMengetahuiJab',
            //'wwAnDekan',
            //'wwCreate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
