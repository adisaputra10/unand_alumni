<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\daftar\models\IdentitasAlumni */

$this->title = 'Create Identitas Alumni';
$this->params['breadcrumbs'][] = ['label' => 'Identitas Alumnis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identitas-alumni-create">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-info-circle"></i> <?php echo $this->title; ?>
        </div>
        <div class="panel-body center" style="padding-bottom: 15px;">
            <?=
            $this->render('_formDaftar', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
