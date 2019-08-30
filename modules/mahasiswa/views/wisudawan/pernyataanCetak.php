<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mahasiswa\models\WisudaWisudawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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


    .surat-pernyataan {
        font-family: Arial, Verdana, sans-serif;
        font-size: 12px;
        line-height: 18px;
        /*width: 100%;*/
        /*padding: 40px;*/
    }

    .surat-pernyataan h3{
        font-size: 18px;
        font-weight: bold;
        text-decoration: underline;
        text-align: center;
    }

    .surat-pernyataan .paragraf{
        margin-top: 30px;
        font-size: 12px;
        text-align: justify;
    }
    .surat-pernyataan .paragraf table{
        margin-left: 10%;
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 12px;
    }
    .surat-pernyataan .paragraf table td{
        height: 25px;
    }
    .materai{
        border: solid 1px #cccccc;
        width: 100px;
        margin-left: -50px;
        color: #cccccc;
    }
    .header-surat{
        height: 63px;
        width: 100%;
        border-bottom: 1px double;
        margin-bottom: 20px;
        margin-top:0px;
        margin-right: 30px;
        /*position: absolute;*/
        display: block;
    }
    .header-surat .logo{
        float: left;
    }
    .header-surat h2{
        font-size: 14px;
        font-weight: bold;

    }
    .header-surat h3{
        font-size: 21px;
        font-weight: bold;
        letter-spacing: 5px;
        margin-top:3px;
        margin-bottom:3px;
    }
    .header-surat p{
        font-size: 12px;
        font-style: italic;
    }
    .header-surat .judul{
        float: left;
        margin-left: 60px;
        margin-top:-58px;
    }
</style>
<div class="header-surat">
    <div class="logo">
        <img src="<?php echo Yii::getAlias('@webroot/images/logo-header.png'); ?>" style="width: 50px;"/>
    </div>
    <div class="judul">
        <h2>KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</h2>
        <h3>UNIVERSITAS ANDALAS</h3>
        <p>Kampus Universitas Andalas Limau Manis, Padang - Sumatera Barat</p>
    </div>
    <div class="clear"></div>
</div>
<?php
echo $this->render('_pernyataan', [
    'model' => $model,
    'data' => $data
]);
?>
