<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <?php
    if ($model->foto == '') {
        echo Html::img(Url::to(['/site/image', 'filename' => 'nobody.png']), ['style' => 'height:200px;']);
    } else {
        echo Html::a(Html::img(Url::to(['/berkas/berkas-foto/getfoto', 'filename' => $model->foto]), ['style' => 'height:200px;']), Url::to(['download', 'act' => 'foto', 'filename' => $model->foto]), ['target' => '_blank']);
    }
    ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'category_id',
            'status',
            'create_time',
            'update_time:datetime',
            'user_id',
            'foto'
        ],
    ]);
    ?>

</div>
