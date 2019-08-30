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
<div class="print-clear"></div>
<div class="print-content">
    <h3>TAGIHAN BIAYA WISUDA</h3>
    <table>
        <tbody>
            <tr class="kv-child-table-row">
                <th style="width: 20%;">Nama</th><td style="width: 5px;">:</td>
                <th style="font-weight: bold;"><?php echo $data['invoiceNama']; ?></th>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">NIM</th><td style="width: 5px;">:</td>
                <th style="font-weight: bold;"><?php echo $data['invoiceNim']; ?></th>
            </tr>
            <tr class="kv-child-table-row">
                <th style="">Periode</th><td style="width: 5px;">:</td>
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
