<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mahasiswa\models\WisudaWisudawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Pembayaran';
$this->params['breadcrumbs'][] = $this->title;
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

    body {
        font-family: Arial, Verdana, sans-serif;
        font-size: 12px;
        /*width: 100%;*/
    }
    .print-area {
        border:1px solid red;
        padding:1em;
    }
    .print-header{
        height: 55px;
        border-bottom: 1px solid;
        margin-bottom: 20px;
    }
    .print-header img{
        height: 50px;
        float: left;
        margin-right: 10px;
    }
    .print-header h2{
        font-size: 14px;
        font-weight: bold;

    }
    .print-header h3{
        font-size: 21px;
        font-weight: bold;
        letter-spacing: 5px;
        margin-top:3px;
        margin-bottom:3px;
    }
    .print-header p{
        font-size: 12px;
        font-style: italic;
    }

    .print-clear{
        clear: both;
    }

    .print-content h3{
        font-size: 13px;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 20px;
        text-align: center;
    }
    .print-content table{
        margin-bottom: 10px;
    }
    .print-content table th,.print-content table td{
        text-align: left;
        padding: 2px;
    }
    .print-content b{
        font-weight: bold;
    }
    .print-content i{
        font-style: italic;
    }
    .print-content ul{
        margin-left: 20px;
    }
    .print-content .paragraf{
        text-align: justify;
        line-height: 15px;
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
<div class="print-content">
    <h3>TAGIHAN BIAYA WISUDA</h3>
    <table>
        <tbody>
            <tr class="kv-child-table-row">
                <th style="width: 30%;">Nama</th><td style="width: 5px;">:</td>
                <th style="font-weight: bold;"><?php echo $data['invoiceNama']; ?></th>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">NIM</th><td style="width: 5px;">:</td>
                <th style="font-weight: bold;"><?php echo $data['invoiceNim']; ?></th>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">Periode Wisuda</th><td style="width: 5px;">:</td>
                <th style=""><?php echo $data['periodeNama']; ?></th>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">Uraian</th><td style="width: 5px;">:</td>
                <td style=""><?php echo $data['invoiceUraian']; ?></td>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">Bank</th><td style="width: 5px;">:</td>
                <td style=""><?php echo $data['bankNama']; ?></td>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">Jumlah (Rp)</th><td style="width: 5px;">:</td>
                <td style="font-weight: bold;"><?php echo Yii::$app->terbilang->setCurrency($data['invoiceJumlah']); ?></td>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">Nomor Virtual Account</th><td style="width: 5px;">:</td>
                <th style="font-weight: bold;"><?php echo $va['BANK_SAMA']; ?></th>
            </tr>
        </tbody>
    </table>
    <div class="paragraf" style="">
        <b>Catatan : </b><br/>
        <ul style="list-style: decimal;">
            <li>Silahkan melakukan pembayaran uang wisuda ke <b><?php echo $data['bankNama']; ?></b> sebelum melakukan konfirmasi biodata wisuda anda. Pembayaran dapat dilakukan :<br/>
                <ul style="list-style: lower-alpha;">
                    <li>Melalui teller <b><?php echo $data['bankNama']; ?></b> dengan menyebutkan <b><i>"Bayar Uang Wisuda Unand"</i></b> diikuti dengan <b><i>Nomor BP/NIM</i></b> anda, atau</li>
                    <li>
                        Melalui ATM <b><?php echo $data['bankNama']; ?></b> di menu transfer ke rekening <b>[Nomor Virtual Account]</b> anda.<br/>
                        <i>Contoh : <?php echo $data['bankKodeVA'] . ' ' . $data['invoiceNim']; ?></i>
                    </li>
                    <li>
                        Melalui ATM <b>Bersama/Prima</b> di menu transfer ke rekening <b>[Kode Bank][Nomor Virtual Account]</b> anda.<br/>
                        <i>Contoh : <?php echo $data['bankKode'] . ' ' . $data['bankKodeVA'] . ' ' . $data['invoiceNim']; ?></i>
                    </li>
                </ul>
            </li>
            <li>Setelah melakukan pembayaran uang wisuda silahkan login kembali ke <a href="#">http://wisuda.unand.ac.id</a> untuk melakukan konfirmasi biodata anda untuk memastikan kebenaran data anda.</li>
        </ul>
    </div>
</div>
