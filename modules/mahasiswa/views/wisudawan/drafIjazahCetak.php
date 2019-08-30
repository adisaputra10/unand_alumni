<?php
/* @var $this yii\web\View */
/* @var $model app\modules\mahasiswa\models\WisudaWisudawan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Cetak Draf Ijazah";
?>
<style>
    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed, 
    figure, figcaption, footer, header, hgroup, 
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure, 
    footer, header, hgroup, menu, nav, section {
        display: block;
    }
    body {
        line-height: 1;
    }
    ol, ul {
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }


    .draf-watermark-ijazah{
        /*background-image: url("img/logo.png");*/
        /*background-color: yellow;*/
        background-position: center; 
        background-repeat: no-repeat;
        background-size: 25% 45%;
    }

    .draf-ijazah {
        font-family: Arial, Verdana, sans-serif;
        font-size: 12px;
        /*width: 100%;*/
        padding-top: 40px;
        color: black;
        /*font-weight: bold;*/
    }

    .ijazah-area {
        border:1px solid red;
    }
    .ijazah-header{
        height: 55px;
        margin-bottom: 20px;
    }
    .ijazah-header img{
        height: 50px;
        float: left;
        margin-right: 10px;
    }
    .ijazah-header h2{
        font-size: 21px;
        font-weight: bold;
        text-align: center;
    }
    .ijazah-header h3{
        font-size: 28px;
        font-weight: bold;
        letter-spacing: 5px;
        margin-top:3px;
        margin-bottom:3px;
        text-align: center;
    }
    .ijazah-header p{
        font-size: 12px;
        font-style: italic;
    }

    .ijazah-clear{
        clear: both;
    }
    .nomor-ijazah{
        /*border-bottom: solid 1px #cccccc;*/
        margin-bottom: 35px;
    }
    .nomor-ijazah .nomor-ijazah-universitas{
        float: right;
        margin-left: 70%;
        margin-top: -16px;
    }
    .nomor-ijazah .nomor-ijazah-nasional{
        float: left;
        /*margin-left: 0px;*/
    }

    .ijazah-content h3{
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }
    .ijazah-content h3 i{
        font-size: 15px;
    }
    .ijazah-content h4{
        font-size: 14px;
        text-align: center;
    }
    .ijazah-content table{
        margin-bottom: 10px;
    }
    .ijazah-content table th,.ijazah-content table td{
        text-align: left;
        padding: 2px;
    }
    .ijazah-content b{
        font-weight: bold;
    }
    .ijazah-content i{
        font-style: italic;
    }
    .ijazah-content ul{
        margin-left: 20px;
    }
    .ijazah-content .paragraf{
        text-align: justify;
        line-height: 21px;
        font-size: 14px;
    }
    .ijazah-content .paragraf h3{
        font-size: 30px;
        margin: 0px;
        margin-top:25px;
    }
    .ijazah-content .paragraf .mark-kata{
        background-color: #000;
        color: blue;
    }
    .ijazah-content table{
        font-size: 14px;
    }
</style>
<div class="draf-watermark-ijazah">
    <?php
    if ($model->wwJenKode == 'D3' || $model->wwJenKode == 'S1') {
        echo $this->render('_drafIjazahS1', [
            'result' => $result
        ]);
    } else if ($model->wwJenKode == 'S2') {
        echo $this->render('_drafIjazahS2', [
            'result' => $result
        ]);
    } else if ($model->wwJenKode == 'S3') {
        echo $this->render('_drafIjazahS3', [
            'result' => $result
        ]);
    } else if ($model->wwJenKode == 'Sp-1') {
        echo $this->render('_drafIjazahSp1', [
            'result' => $result
        ]);
    } else if ($model->wwJenKode == 'PR') {
        echo $this->render('_drafIjazahProfesi', [
            'result' => $result
        ]);
    }
    ?>
</div>
