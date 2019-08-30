<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body style="margin: 5px;">
        <?php
        $filename = $this->title.'.xls';
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment;Filename=".$filename);
        ?>
        <?= $content ?>
    </body>
</html>
<?php $this->endPage() ?>
