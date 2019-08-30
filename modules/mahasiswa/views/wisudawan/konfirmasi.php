<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use yii\widgets\MaskedInput;
use dosamigos\ckeditor\CKEditor;
use app\models\IndonesiaDate;
use app\modules\mahasiswa\models\RefPredikat;
use app\modules\mahasiswa\models\RefProdiNasional;
use app\modules\mahasiswa\models\RefKota;
use app\modules\mahasiswa\models\RefJenjang;

$inDate = new IndonesiaDate();

/* @var $this yii\web\View */
/* @var $model app\modules\mahasiswa\models\WisudaWisudawan */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Konfirmasi Biodata';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-file-text"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center" style="padding-bottom: 0px;">
            <?php
            if (empty($model->wwConfirmed)) {
                ?>
                <div class="alert alert-warning">
                    <i class="fa fa-warning"></i>
                    Silahkan periksa dengan teliti kebenaran biodata anda.
                </div>
                <?php
            }
            ?>
            <div class="panel panel-success" style="margin-top: -10px;">
                <div class="panel-heading" style="padding: 7px;padding-left: 10px;">
                    <i class="fa fa-tag"></i> Biodata Diri
                </div>
                <div class="panel-body">
                    <?php
                    //Get KOta
                    $dataKota = RefKota::find()
                            ->select(['kotaKode', 'CONCAT(kotaNamaResmi," - ",propNamaResmi)AS kotaNamaResmi', 'propNamaResmi AS propNama'])
                            ->join('JOIN', 'ref_propinsi', 'propKode=kotaPropKode')
                            ->where("kotaKode=:kode", [
                                ':kode' => $model->wwKabId,
                            ])
                            ->orderBy('propNamaResmi ASC,kotaNamaResmi ASC')
                            ->one();
                    ?>
                    <table class="table table-bordered table-condensed table-striped detail-view" style="margin-bottom: 5px;">
                        <tbody>
                            <tr class="kv-child-table-row">
                                <th colspan="3" style="text-align: center;">
                                    <?php
                                    if ($model->wwFoto == '') {
                                        echo Html::img(Url::to(['/site/image', 'filename' => 'nobody.png']), ['style' => 'height:200px;']);
                                    } else {
                                        echo Html::img(Url::to(['/site/getfoto', 'filename' => $model->wwFoto]), ['style' => 'height:200px;']);
                                    }
                                    ?>
                                </th>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;width: 25%;">NIM</th><td style="width: 5px;">:</td>
                                <th style="text-align: left;"><?php echo $model->wwNim; ?></th>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Nama</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwGlrDepan . $model->wwNama . $model->wwGlrBelakang; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Jenis Kelamin</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo ($model->wwJenkel == 'L') ? 'Laki-Laki' : 'Perempuan'; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Tempat/Tanggal Lahir</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwTmpLahir . '/ ' . $inDate->setDate($model->wwTglLahir) . ' (Sesuai Ijazah : ' . $model->wwTglLahirText . ')'; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Nomor HP</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwHp; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Email</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwEmail; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Kabupaten/Kota</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo empty($dataKota) ? '' : $dataKota->kotaNamaResmi; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Alamat</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwAlamat; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Pendidikan Terakhir</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwPendTerakhir; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Nama Ayah</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwOrtuAyah; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Nama Ibu</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwOrtuIbu; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    if ($model->wwIsSetuju == 0) {
                        ?>
                        <a href="<?php echo Url::to(['konfirmasi', 'act' => 'update-biodata']); ?>" class="btn btn-success btn-flat btn-lg fa fa-pencil"> Perbaiki</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-success" style="margin-top: -15px;">
                <div class="panel-heading" style="padding: 7px;padding-left: 10px;">
                    <i class="fa fa-tag"></i> Akademik
                </div>
                <div class="panel-body">
                    <?php
                    //Get Predikat
                    $dataPredikat = RefPredikat::find()
                            ->where("predikatId=:id", [':id' => $model->wwPredikatId])
                            ->one();
                    //Get Program Studi
                    $dataProdi = RefProdiNasional::find()
                            ->select(['prodiKode', 'CONCAT(prodiNama," - ",fakNama)AS prodiNama', 'fakNama'])
                            ->join('JOIN', 'ref_fakultas', 'fakId=prodiFakId')
                            ->where("prodiKode=:kode", [':kode' => $model->wwProdiKode])
                            ->one();
                    //Get Jenjang
                    $dataJenjang = RefJenjang::find()
                            ->where("jenKode<>'-' AND jenKode=:kode", [':kode' => $model->wwJenKode])
                            ->one();
                    ?>
                    <table class="table table-bordered table-condensed table-striped detail-view" style="margin-bottom: 5px;">
                        <tbody>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;width: 25%;">Nomor Alumni</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwNoAlumni; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Angkatan/ Jenjang</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwAngkatan . ' / ' . $dataJenjang->jenNama; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Program Studi/ Fakultas</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $dataProdi->prodiNama; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Program Kekhususan</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwProgKekhususan; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Apakah Mahasiswa Bidikmisi</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo ($model->wwIsBidikmisi == 1) ? 'Ya' : 'Tidak'; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Pembimbing Akademik</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwDosenPa; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Tanpa Tugas Akhir?</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo ($model->wwIsNoTa == 1) ? 'Ya' : 'Tidak'; ?></td>
                            </tr>
                            <?php
                            if ($model->wwIsNoTa == '0') {
                                ?>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Judul TA/ Skripsi/ Tesis/ Disertasi</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;"><?php echo $model->wwJudulTa; ?></td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Pembimbing TA/ Skripsi/ Tesis/ Disertasi</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <table style="width: 100%">
                                            <?php
                                            foreach ($modelPembimbing as $valPbb) {
                                                ?>
                                                <tr>
                                                    <td style="width:20%"><?php echo $valPbb['pbbKet']; ?></td><td style="width:10px;">:</td><td><?php echo $valPbb['pbbNama']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Tanggal Mulai/ Selesai Bimbingan</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;"><?php echo $inDate->setDate($model->wwTglMulaiBimb) . ' s/d ' . $inDate->setDate($model->wwTglSelesaiBimb); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Lama Studi</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwLamaStudiThn . ' Tahun ' . $model->wwLamaStudiBln . ' Bulan'; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Tanggal Lulus</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $inDate->setDate($model->wwTglLulus); ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">IPK</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $model->wwIPK; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Predikat Lulus</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $dataPredikat->predikatNama; ?></td>
                            </tr>
                            <?php
                            if ($model->wwJenKode == 'D3' || $model->wwJenKode == 'S1') {
                                ?>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Score TOEFL</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;"><?php echo $model->wwScoreToefl; ?></td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Predikat SAPS/ Sertifikat</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <?php
                                        echo $model->wwSapsPredikat;
                                        echo empty($model->wwSapsLamp) ? ' <span class="label label-default">- Lampiran SAPS Tidak Ditemukan -</span>' : Html::a(' Sertifikat SAPS', Url::to(['download', 'act'=>'saps', 'filename' => $model->wwSapsLamp]), ['target' => '_blank', 'class' => 'label label-info fa fa-paperclip', 'style' => 'margin-left:15px;']);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            if ($isVT == 1) {
                                ?>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Persentase Index Kesamaan Pada Turnitin (%)</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <?php
                                        echo $model->wwTurnitinSimilar . ' %';
                                        echo empty($model->wwTurnitinLamp) ? ' <span class="label label-default">- Lampiran Hasil Turnitin Tidak Ditemukan -</span>' : Html::a(' Lampiran Hasil Turnitin', Url::to(['download', 'act' => 'turnitin', 'filename' => $model->wwTurnitinLamp]), ['target' => '_blank', 'class' => 'label label-info fa fa-paperclip', 'style' => 'margin-left:25px;']);
                                        ?>
                                    </td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Link Scholar Unand</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <?php
                                        echo empty($model->wwRepositoryLink) ? '' : Html::a($model->wwRepositoryLink, $model->wwRepositoryLink, ['target' => '_blank']);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }

                            if ($isVJ == 1) {
                                ?>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Judul Artikel</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;"><?php echo $model->wwJurnalNama; ?> </td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Surat Pernyataan Keabsahan Artikel</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <?php
                                        echo empty($model->wwJurnalLampSk) ? ' <span class="label label-default">- Lampiran Surat Pernyataan Keabsahan Artikel Tidak Ditemukan -</span>' : Html::a(' Lampiran Surat Pernyataan Keabsahan Artikel', Url::to(['download', 'act' => 'surat-absah-artikel', 'filename' => $model->wwJurnalLampSk]), ['target' => '_blank', 'class' => 'label label-info fa fa-paperclip', 'style' => 'margin-left:0px;']);
                                        ?>
                                    </td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Link Artikel Pada Jurnal/Proceeding</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <?php
                                        echo empty($model->wwJurnalLink) ? '' : Html::a($model->wwJurnalLink, $model->wwJurnalLink, ['target' => '_blank']);
                                        ?>
                                    </td>
                                </tr>
                                <tr class="kv-child-table-row">
                                    <th style="text-align: right;">Status Verifikasi</th><td style="width: 5px;">:</td>
                                    <td style="text-align: left;">
                                        <?php
                                        if (!empty($model->wwJurnalVerifikasiStatus)) {
                                            if ($model->wwJurnalVerifikasiStatus == 'Diterima') {
                                                ?>
                                                <span class="label label-info">Verified</span>
                                                <?php
                                            } else if ($model->wwJurnalVerifikasiStatus == 'Ditolak') {
                                                ?>
                                                <span class="label label-warning">Unverified</span>
                                                <?php
                                                if (!empty($model->wwJurnalVerifikasiKet)) {
                                                    echo '<br/>Keterangan : ' . $model->wwJurnalVerifikasiKet;
                                                }
                                            }
                                        }else{
                                            ?>
                                                <span class="label label-default">Menunggu Verifikasi...</span>
                                                <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if ($model->wwIsSetuju == 0) {
                        ?>
                        <a href="<?php echo Url::to(['konfirmasi', 'act' => 'update-akademik']); ?>" class="btn btn-success btn-flat btn-lg fa fa-pencil"> Perbaiki</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            if ($tungguVerifikasi['statusVT'] == 1 || $tungguVerifikasi['statusVJ'] == 1) {
                ?>
                <div class="callout callout-warning" style="margin-top: -10px;">
                    <span style="font-weight: bold;font-size: 16px;" class="fa fa-warning"> Peringatan!</span><br/>
                    Proses Konfirmasi Biodata dapat dilanjutkan setelah hal-hal berikut :
                    <ul style="margin-left: -20px;margin-top: 0px;margin-bottom:0px;">
                        <?php
                        if (!empty($tungguVerifikasi['ketVT'])) {
                            ?>
                            <li><?php echo $tungguVerifikasi['ketVT']; ?></li>
                            <?php
                        }
                        if (!empty($tungguVerifikasi['ketVJ'])) {
                            ?>
                            <li><?php echo $tungguVerifikasi['ketVJ']; ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    
                </div>
                <?php
            } else {
                ?>
                <div class="callout callout-important" style="margin-top: -10px;">
                    Sebelum melakukan konfirmasi silahkan periksa kembali biodata anda dan pastikan data yang diisikan BENAR. Apabila ada keraguan/ketidak cocokan data akademik dan anda tidak dapat merubahnya, silahkan melapor ke bagian akademik fakultas masing-masing.<br/>
                    <br/>
                    Status konfirmasi biodata anda adalah : <?php echo empty($model->wwConfirmed) ? '<i class="label label-default" style="font-size:16px;">Belum Dikonfirmasi</i>' : '<i class="label label-success" style="font-size:16px;">Sudah Dikonfirmasi : ' . $inDate->setDateTime($model->wwConfirmed) . '</i>'; ?><br/>
                    <br/>
                    <?php if (empty($model->wwConfirmed)) { ?>
                        Klik tombol <b><i>Konfirmasi</i></b> untuk melakukan konfirmasi biodata anda.
                    <?php } ?>
                </div>
                <?php
                $form = ActiveForm::begin([
                            'id' => 'form-konfirmasi',
                            'type' => ActiveForm::TYPE_HORIZONTAL
                ]);

                echo Form::widget([
                    'model' => $model,
                    'form' => $form,
                    'columns' => 1,
                    'attributes' => [
                        'wwNim' => ['type' => Form::INPUT_HIDDEN, 'options' => ['readonly' => 'readonly']],
                        'actions' => [
                            'type' => Form::INPUT_RAW,
                            'value' => '<div style="text-align: left; margin-top: -10px;margin-bottom:15px;">' .
                            (empty($model->wwConfirmed) ? Html::submitButton(' Konfirmasi', ['id' => 'btn-simpan', 'name' => 'btn-simpan', 'onclick' => '$(this).val(1);', 'type' => 'button', 'class' => 'fa fa-check-square-o btn btn-primary btn-flat btn-lg']) : Html::a(' Preview Draf Ijazah', Url::to(['draf-ijazah']), ['class' => 'btn btn-success btn-flat btn-lg fa fa-search'])) .
                            '</div>'
                        ],
                    ]
                ]);
                ActiveForm::end();
            }
            ?>
        </div>
    </div>
</div>