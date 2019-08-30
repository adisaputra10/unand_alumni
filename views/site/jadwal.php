<?php

use yii\helpers\Html;
use app\models\IndonesiaDate;
use app\components\AppVersion;
use yii\helpers\Url;
use app\models\AppGroup;
use app\components\DeEnk;

$version = new AppVersion();
$inDate = new IndonesiaDate();
$enk = new DeEnk();


/* @var $this yii\web\View */

$this->title = 'Informasi Jadwal';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Informasi Jadwal
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-borderless">
                        <thead>
                            <tr>
                                <th style="width: 30px;text-align: center;">No</th>
                                <th style="text-align: left;">Jenis Tes</th>
                                <th style="text-align: center;">Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            for ($a = 0; $a < count($data['JENIS']); $a++) {
                                $jentesId = $data['JENIS'][$a]['id'];
                                $jentesNama = $data['JENIS'][$a]['nama'];
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $no; ?></td>
                                    <td>
                                        <?php echo $jentesNama; ?><br/>
                                        <?php
                                        if (!empty($data['JADWAL'][$jentesId])) {
                                            ?>
                                            <a href="<?php echo Url::to(['pendaftaran/pendaftar/daftar', 'jns' => $enk->setEnk25($jentesId)]); ?>" class="btn btn-primary btn-flat fa fa-edit"> Daftar</a>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <table class="table table-condensed" style="margin-bottom: 0px;">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Kelas/Sesi</th>
                                                    <th style="text-align: center;">Jam</th>
                                                    <th style="text-align: center;">Kapasitas</th>
                                                    <th style="text-align: center;">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($data['JADWAL'][$jentesId])) {
                                                    for ($b = 0; $b < count($data['JADWAL'][$jentesId]); $b++) {
                                                        $jdwlTgl = $data['JADWAL'][$jentesId][$b]['tanggal'];
                                                        $jdwlKelas = $data['JADWAL'][$jentesId][$b]['kelas'];
                                                        $jdwlJam = $data['JADWAL'][$jentesId][$b]['jam'];
                                                        $jdwlKapasitas = $data['JADWAL'][$jentesId][$b]['kapasitas'];
                                                        $jdwlStatus = $data['JADWAL'][$jentesId][$b]['status'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $inDate->setDate($jdwlTgl); ?></td>
                                                            <td><?php echo $jdwlKelas; ?></td>
                                                            <td style="text-align: center;"><?php echo $jdwlJam; ?></td>
                                                            <td style="text-align: center;"><?php echo $jdwlKapasitas . ' Orang'; ?></td>
                                                            <td style="text-align: center;"><?php echo $jdwlStatus; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="5"><i>Tidak ada jadwal/kelas </i></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>