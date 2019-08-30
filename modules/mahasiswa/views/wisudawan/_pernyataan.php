<?php

use app\assets\AppAssetIjazah;
use app\models\IndonesiaDate;

/* @var $this yii\web\View */
/* @var $model app\modules\mahasiswa\models\WisudaWisudawan */

AppAssetIjazah::register($this);
$inDate = new IndonesiaDate();
?>
<div class="surat-pernyataan">
    <h3>SURAT PERNYATAAN</h3>
    <div class="paragraf">
        Saya yang bertanda tangan dibawah ini menyatakan dengan sesungguhnya bahwa data saya yang akan dicantumkan dalam ijazah yang akan saya terima adalah :<br/>
        <table style="width: 100%">
            <tr>
                <td style="width: 30%">Nama</td><td style="width:10px;">:</td>
                <td><?php echo $data['MHS']['glrDepan'].$data['MHS']['nama'].$data['MHS']['glrBelakang']; ?></td>
            </tr>
            <tr>
                <td>NIM/No.BP</td><td>:</td>
                <td><?php echo $data['MHS']['nim']; ?></td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td><td>:</td>
                <td><?php echo $data['MHS']['tmpLahir'].' / '.$inDate->setDate($data['MHS']['tglLahir']); ?></td>
            </tr>
            <tr>
                <td>Program Studi</td><td>:</td>
                <td><?php echo $data['MHS']['prodiNama']; ?></td>
            </tr>
        </table>
        Demikian pernyataan ini saya buat dengan sesungguhnya, dan jika terdapat kekeliruan data pada ijazah yang sudah diterbitkan, maka saya bersedia menerima surat keterangan dan ijazah tidak diterbitkan ulang.
        <table style="width: 100%;margin-left:0px;margin-top: 40px;">
            <tr>
                <td style="width: 60%">
<!--                    Mengetahui:<br/>
                    <?php //echo ($data['MHS']['anDekan']==1)?'An.Dekan<br/>':'<br/>'; ?>
                    <?php //echo $data['MHS']['mengetahuiJab']; ?>,<br/><br/>
                    <div style="height:70px;width: 100px;padding-top:24px;padding-left: 7px;margin-bottom: 3px;"></div>
                    <b style="text-decoration: underline;"><?php //echo $data['MHS']['mengetahuiNama']; ?></b><br/>
                    <b>NIP.<?php //echo $data['MHS']['mengetahuiNip']; ?></b>-->
                </td>
                <td style="width: 40%">
                    Padang, <?php echo $inDate->setDate($model->wwTglSetuju); ?>
                    <br/>
                    Yang menerangkan,<br/><br/><br/>
                    <div class="materai">Materai 6000</div><br/><br/>
                    <b style="text-decoration: underline;"><?php echo $data['MHS']['nama']; ?></b><br/>
                    <b>NIM.<?php echo $data['MHS']['nim']; ?></b>
                </td>
            </tr>
        </table>
    </div>
</div>

