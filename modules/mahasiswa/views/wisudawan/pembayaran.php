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
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-money"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center">
            <?php
            if ($data['invoiceFlag'] == 1) {
                ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    Terima kasih telah melakukan pembayaran uang wisuda. Silahkan konfirmasi biodata wisuda anda agar tidak terjadi kesalahan cetak ijazah.
                </div>
                <?php
            } else {
                ?>
                <div class="alert alert-warning">
                    <i class="fa fa-warning"></i>
                    Maaf, Anda belum melunasi uang wisuda! Silahkan melakukan pembayaran ke bank.
                </div>
                <?php
            }
            ?>
            <div class="table-responsive kv-detail-view" style="margin-top: -10px;">
                <table class="table table-bordered table-condensed table-striped detail-view" style="margin-bottom: 5px;">
                    <tbody>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;width: 20%;">Nama</th><td style="width: 5px;">:</td>
                            <th style="text-align: left;"><?php echo $data['invoiceNama']; ?></th>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">NIM</th><td style="width: 5px;">:</td>
                            <th style="text-align: left;"><?php echo $data['invoiceNim']; ?></th>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">Periode Wisuda</th><td style="width: 5px;">:</td>
                            <th style="text-align: left;"><?php echo $data['periodeNama']; ?></th>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">Uraian</th><td style="width: 5px;">:</td>
                            <td style="text-align: left;"><?php echo $data['invoiceUraian']; ?></td>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">Bank</th><td style="width: 5px;">:</td>
                            <td style="text-align: left;"><?php echo $data['bankNama']; ?></td>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">Jumlah (Rp)</th><td style="width: 5px;">:</td>
                            <td style="text-align: left;"><?php echo Yii::$app->terbilang->setCurrency($data['invoiceJumlah']); ?></td>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">Status</th><td style="width: 5px;">:</td>
                            <td style="text-align: left;"><?php echo ($data['invoiceFlag'] == 1) ? '<i class="label label-info" style="font-size: 13px;">Sudah Bayar</i>' : '<i class="label label-danger" style="font-size: 13px;">Belum Bayar</i>'; ?></td>
                        </tr>
                        <tr class="kv-child-table-row">
                            <th style="text-align: right;">Nomor Virtual Account</th><td style="width: 5px;">:</td>
                            <th style="text-align: left;"><?php echo $va['BANK_SAMA']; ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="callout callout-important" style="">
                <ul style="list-style: decimal;margin-left: -10px;">
                    <li>
                        Silahkan melakukan pembayaran uang wisuda ke <b><?php echo $data['bankNama']; ?></b> sebelum melakukan konfirmasi biodata wisuda anda. Pembayaran dapat dilakukan :<br/>
                        <ul style="margin-left: -10px;list-style: lower-alpha;">
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
                    <li>Setelah melakukan pembayaran uang wisuda silahkan konfirmasi biodata anda untuk memastikan kebenaran data anda.</li>
                </ul>
            </div>
            <?php
            if ($data['invoiceFlag'] == 1) {
                echo Html::a(' Konfirmasi Biodata', Url::to(['konfirmasi']), ['class' => 'btn btn-success btn-flat btn-lg fa fa-file-text', 'style' => 'margin-right:5px;']);
            }
            echo Html::a(' Cetak', Url::to(['cetak', 'act' => 'pembayaran','ext'=>'pdf']), ['class' => 'btn btn-default btn-flat btn-lg fa fa-print', 'target' => '_blank']);
            ?>
        </div>
    </div>
</div>
