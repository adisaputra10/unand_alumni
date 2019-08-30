<?php

use app\assets\AppAssetIjazah;
use app\models\IndonesiaDate;

/* @var $this yii\web\View */
/* @var $model app\modules\mahasiswa\models\WisudaWisudawan */

AppAssetIjazah::register($this);
$inDate = new IndonesiaDate();
?>
<div class="draf-watermark">
    <div class="draf-ijazah">
        <div class="nomor-ijazah">
            <div class="nomor-ijazah-nasional">

            </div>
            <div class="nomor-ijazah-universitas">
                Nomor Ijazah Universitas : . . . . . . . . . 
            </div>
            <div class="ijazah-clear"></div>
        </div>
        <div class="ijazah-header">
            <h2>KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</h2>
            <h3>UNIVERSITAS ANDALAS</h3>
        </div>
        <div class="ijazah-content">
            <br/><br/>
            <h4>Dengan ini menyatakan bahwa :</h4>
            <br/>
            <h3>
                <span style="background-color: yellow"><?php echo $result['wwGlrDepan'] . $result['wwNama'] . $result['wwGlrBelakang']; ?></span><br/>
                <i><span style="background-color: yellow">NIM : <?php echo $result['wwNim']; ?></span></i>
            </h3>
            <br/>
            <div class="paragraf">
                lahir di <span style="background-color: yellow"><?php echo $result['wwTmpLahir']; ?></span> tanggal <span style="background-color: yellow"><?php echo (empty($result['wwTglLahirText'])?$inDate->setDate($result['wwTglLahir']):$result['wwTglLahirText']); ?></span> telah menyelesaikan dengan baik dan memenuhi segala syarat pendidikan 
                Spesialisasi I pada Program Studi <span style="background-color: yellow"><?php echo strtoupper($result['prodiNama']); ?></span> lulus pada tanggal <span style="background-color: yellow"><?php echo $inDate->setDate($result['wwTglLulus']); ?></span>, oleh sebab itu kepadanya diberikan sebutan<br/>
                <h3><span style="background-color: yellow"><?php echo $result['prodiGelarLulusan']; ?></span></h3>
                <br/>
                beserta segala hak dan kewajiban yang melekat pada sebutan tersebut.<br/><br/><br/>
                Diberikan di Padang pada tanggal <span style="background-color: yellow"><?php echo $result['wppTglTerbilang']; ?></span>.
            </div>
            <br/><br/>
            <div class="ttd">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%">
                            <b>Dekan</b><br/>
                            <?php echo $result['fakNama']; ?>
                        </td>
                        <td style="width: 50%">
                            <b>Rektor</b><br/>
                            <?php echo $result['satkerNama']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0px;height: 80px;vertical-align: bottom;">
                            <?php echo $result['fakDekanNama']; ?>
                        </td>
                        <td style="padding-top: 0px;vertical-align: bottom;">
                            <?php echo $result['satkerRektorNama']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 0px;">
                            NIP : <?php echo $result['fakDekanNip']; ?>
                        </td>
                        <td style="padding-top: 0px;">
                            NIP : <?php echo $result['satkerRektorNip']; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <br/><br/>
        </div>
    </div>
</div>