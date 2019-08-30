<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\IdentitasAlumni */

$this->title = $model->namalengkap;
$this->params['breadcrumbs'][] = ['label' => 'Identitas Alumnis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="identitas-alumni-view">

    <h1><?= Html::encode($this->title) ?></h1>

  
     <?php
    if ($model->foto == '') {
        echo Html::img(Url::to(['/site/image', 'filename' => 'nobody.png']), ['style' => 'height:200px;']);
    } else {
        echo Html::a(Html::img(Url::to(['/site/getfoto', 'filename' => $model->foto]), ['style' => 'height:200px;']), Url::to(['download', 'act' => 'foto', 'filename' => $model->foto]), ['target' => '_blank']);
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idalumni',
            'username',
    
            'namalengkap',
            'nim',
            'tgllahir',
            'idprodi',
            'angkatan',
            'tahunlulus',
            'tgllulus',
            'tglwisuda',
            'email:email',
            'nohp',
            'alamatrumah:ntext',
            'namaperusahaan',
            'posisipekerjaan',
            'alamatperusahaan:ntext',
            'emailperusahaan:email',
            'bidangperusahaan',
            'riwayatperusahaan:ntext',
           'foto',
        ],
    ]) ?>

</div>
