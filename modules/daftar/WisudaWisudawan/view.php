<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\WisudaWisudawan */

$this->title = $model->wwNim;
$this->params['breadcrumbs'][] = ['label' => 'Wisuda Wisudawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="wisuda-wisudawan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->wwNim], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->wwNim], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'wwNim',
            'wwNoAlumni',
            'wwIdSkripsi',
            'wwNik',
            'wwNama',
            'wwGlrDepan',
            'wwGlrBelakang',
            'wwJenkel',
            'wwTmpLahir',
            'wwTglLahir',
            'wwTglLahirText',
            'wwEmail:email',
            'wwHp',
            'wwKabId',
            'wwAlamat:ntext',
            'wwPendTerakhir',
            'wwAngkatan',
            'wwProdiKode',
            'wwProgKekhususan',
            'wwJenKode',
            'wwModelrId',
            'wwJalurId',
            'wwJalurNama',
            'wwIsBidikmisi',
            'wwDosenPa',
            'wwJudulTa:ntext',
            'wwIsNoTa',
            'wwTglMulaiBimb',
            'wwTglSelesaiBimb',
            'wwLamaStudiThn',
            'wwLamaStudiBln',
            'wwThnWisuda',
            'wwTglLulus',
            'wwIPK',
            'wwPredikatId',
            'wwScoreToefl',
            'wwSapsPredikat',
            'wwSapsLamp',
            'wwTurnitinSimilar',
            'wwTurnitinLamp',
            'wwRepositoryLink',
            'wwJurnalNama:ntext',
            'wwJurnalLink',
            'wwJurnalLampSk',
            'wwJurnalVerifikasiTgl',
            'wwJurnalVerifikasiStatus',
            'wwJurnalVerifikasiKet:ntext',
            'wwOrtuAyah',
            'wwOrtuIbu',
            'wwFoto',
            'wwWpId',
            'wwConfirmed',
            'wwIjazahPreviewed',
            'wwIsSetuju',
            'wwTglSetuju',
            'wwMengetahuiNama',
            'wwMengetahuiNip',
            'wwMengetahuiJab',
            'wwAnDekan',
            'wwCreate',
        ],
    ]) ?>

</div>
