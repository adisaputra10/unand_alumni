<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\AppAssetIjazah;
use app\models\IndonesiaDate;

AppAssetIjazah::register($this);
$inDate = new IndonesiaDate();

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mahasiswa\models\WisudaWisudawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Pernyataan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="print-clear"></div>
<div class="print-content">
    <div class="surat-pernyataan" style="padding-left: 0px;padding-right: 0px;">
        <h3>SURAT PERNYATAAN</h3>
        <div class="paragraf">
            Saya yang bertanda tangan dibawah ini menyatakan dengan sesungguhnya bahwa data saya yang akan dicantumkan dalam ijazah yang akan saya terima adalah :<br/>
            <table style="width: 100%">
                <tr>
                    <td style="width: 20%">Nama</td><td style="width:10px;">:</td>
                    <td><?php echo $data['MHS']['glrDepan'] . $data['MHS']['nama'] . $data['MHS']['glrBelakang']; ?></td>
                </tr>
                <tr>
                    <td>Nomor Buku Pokok (No.BP)</td><td>:</td>
                    <td><?php echo $data['MHS']['nim']; ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td><td>:</td>
                    <td><?php echo $data['MHS']['tmpLahir'] . ' / ' . $inDate->setDate($data['MHS']['tglLahir']); ?></td>
                </tr>
                <tr>
                    <td>Program Studi</td><td>:</td>
                    <td><?php echo $data['MHS']['prodiNama']; ?></td>
                </tr>
            </table>
            Demikian pernyataan ini saya buat dengan sesungguhnya, dan atas kekeliruan dari pernyataan ini adalah tanggungjawab saya sendiri.
            <table style="width: 100%;margin-left:0px;margin-top: 40px;">
                <tr>
                    <td style="width: 50%">
                        Mengetahui:<br/>
                        <?php echo ($data['MHS']['anDekan'] == 1) ? 'An.Dekan<br/>' : '<br/>'; ?>
                        <?php echo $data['MHS']['mengetahuiJab']; ?>,<br/><br/>
                        <div style="height:70px;width: 100px;padding-top:24px;padding-left: 7px;margin-bottom: 3px;"></div>
                        <b style="text-decoration: underline;"><?php echo $data['MHS']['mengetahuiNama']; ?></b><br/>
                        <b>NIP.<?php echo $data['MHS']['mengetahuiNip']; ?></b>
                    </td>
                    <td style="width: 50%">
                        Padang, <?php echo $inDate->setDate($data['MHS']['tglSetuju']); ?><br/>
                        <br/>
                        Yang menerangkan,<br/><br/>
                        <div style="border: solid 1px #cccccc;height:70px;width: 100px;padding-top:24px;padding-left: 7px;margin-left: -30px;margin-bottom: 3px;">Materai 6000</div>
                        <b style="text-decoration: underline;"><?php echo $data['MHS']['nama']; ?></b><br/>
                        <b>NIM.<?php echo $data['MHS']['nim']; ?></b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
