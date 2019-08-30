<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use app\models\IndonesiaDate;

$inDate = new IndonesiaDate();

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mahasiswa\models\WisudaWisudawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Wisuda';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wisuda-wisudawan-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 style="margin: 0px;"><i class="fa fa-graduation-cap"></i> <?= $this->title; ?></h4>
        </div>
        <div class="panel-body center">
            <?php
            if ($data['MHS_STATUS'] == 'belum-lulus') {
                ?>
                <div class="alert alert-warning" style="margin-bottom: 0px;">
                    <h4><i class="fa fa-warning"></i> Peringatan!</h4>
                    Maaf, Anda belum melakukan kliring.<br/>
                    Agar dapat melakukan pendaftaran wisuda online silahkan melapor ke bagian akademik fakultas masing-masing untuk melakukan kliring.
                </div>
                <?php
            } else if ($data['MHS_STATUS'] == 'lulus') {
                ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    Selamat anda telah lulus...
                </div>
                <div class="table-responsive kv-detail-view" style="margin-top: -10px;">
                    <table class="table table-bordered table-condensed table-striped detail-view" style="margin-bottom: 5px;">
                        <tbody>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;width: 20%;">Nama</th><td style="width: 5px;">:</td>
                                <th style="text-align: left;width: 30%;"><?php echo $data['MHS_BIODATA']['mhsNama']; ?></th>
                                <th style="text-align: right;width: 20%;">Program Studi</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;width: 30%;"><?php echo $data['MHS_BIODATA']['mhsProdiNama']; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">NIM</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $data['MHS_BIODATA']['mhsNim']; ?></td>
                                <th style="text-align: right;">Jenjang</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $data['MHS_BIODATA']['mhsJenjNama']; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Jenis Kelamin</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo ($data['MHS_BIODATA']['mhsJenkel'] == 'L') ? 'Laki-Laki' : 'Perempuan'; ?></td>
                                <th style="text-align: right;">Fakultas</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $data['MHS_BIODATA']['mhsFakNama']; ?></td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <th style="text-align: right;">Tanggal Lahir</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $inDate->setDate($data['MHS_BIODATA']['mhsTglLahir']); ?></td>
                                <th style="text-align: right;">Angkatan</th><td style="width: 5px;">:</td>
                                <td style="text-align: left;"><?php echo $data['MHS_BIODATA']['mhsAngkatan']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProviderItemKliring,
                    'responsive' => true,
                    'hover' => true,
                    'toolbar' => [],
                    'columns' => [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                            'attribute' => 'kliringItem',
                            'hAlign' => 'left',
                            'value' => function ($data) {
                                return $data['kliringItem'];
                            }
                        ],
//                            [
//                            'attribute' => 'kliringPetunjuk',
//                            'hAlign' => 'left',
//                            'value' => function ($data) {
//                                return $data['kliringPetunjuk'];
//                            }
//                        ],
                        [
                            'attribute' => 'Keterangan',
                            'format' => 'raw',
                            'hAlign' => 'center',
                            'width' => '50px',
                            'value' => function ($data) {
                                $items = new \app\modules\mahasiswa\models\RefKliring();
                                $arr = $items->getKliringItem($data['wkNim']);
                                if (in_array($data['kliringId'], $arr)) {
                                    return '<span class="label label-info" style="font-size:15px;margin:0px;"><i class="fa fa-check" style="margin:0px;padding:0px;"></i></span>';
                                } else {
                                    return '<span class="label label-warning" style="font-size:15px;margin:0px;"><i class="fa fa-remove" style="margin:0px;padding:0px;"></i></span>';
                                }
                            }
                        ],
                    ],
                    'panel' => [
                        'type' => 'success',
                        'heading' => false,
                        'footer' => false,
                        'before' => false,
                        'after' => false
                    ],
                ]);
                ?>
                <div>
                    <?php
                    if (!empty($data['PERIODE'])) {
                        if ($data['PERIODE']['terdaftar'] == 0) {
                            ?>
                            <div class="callout callout-important" style="text-align: justify;">
                                Untuk mendaftarakan diri sebagai peserta wisuda pada periode <b><?php echo $data['PERIODE']['nama'] . ' tahun ' . $data['PERIODE']['tahun']; ?></b> yang akan dilaksanakan pada tanggal <b><?php echo $inDate->setDate($data['PERIODE']['tglWisuda']); ?></b> 
                                maka setiap mahasiswa diwajibkan untuk mendaftar secara online sebelum melakukan pembayaran uang wisuda. Untuk dapat melakukan pendaftaran online pastikan anda telah melakukan kliring atau keterangan kliring sudah checklist semua.<br/><br/>
                                Pendaftaran wisuda periode ini berakhir tanggal <b><?php echo $inDate->setDate($data['PERIODE']['tglTutup']); ?></b>.<br/><br/>
                                <i>Silahkan klik tombol <b>DAFTAR</b> dibawah ini untuk mendaftar wisuda.</i>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="callout callout-important" style="text-align: justify;">
                                Anda akan terdaftar pada periode <b><?php echo $data['PERIODE']['nama'] . ' tahun ' . $data['PERIODE']['tahun']; ?></b> yang akan dilaksanakan pada tanggal <b><?php echo $inDate->setDate($data['PERIODE']['tglWisuda']); ?></b>, apabila telah membayar uang wisuda dan melengkapi persyaratan yang telah ditentukan.<br/>
                                Silahkan segera menyelesaikan tahapan pendaftaran wisuda sehingga anda mendapatkan <b>Draf Ijazah & Surat Pernyataan</b>.<br/>
                            </div>
                            <?php
                        }
                        if ($data['TAGIHAN'] == 0) {
                            $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
                            echo Form::widget([
                                'model' => $model,
                                'form' => $form,
                                'columns' => 1,
                                'attributes' => [
                                    'invoicePeriodeId' => ['label' => 'ID', 'type' => Form::INPUT_HIDDEN, 'options' => ['readonly' => 'readonly']],
                                    'actions' => [
                                        'type' => Form::INPUT_RAW,
                                        'value' => '<div style="text-align: left; margin-top: 0px">' .
                                        Html::submitButton(' Daftar', ['onclick' => '$(this).attr("disabled","disabled");$(this).submit();', 'type' => 'button', 'class' => 'fa fa-send btn btn-primary btn-flat btn-lg', 'disabled' => (($data['MHS_KLIRING_STATUS'] == 1) ? false : true)]) .
                                        '</div>'
                                    ],
                                ]
                            ]);
                            ActiveForm::end();
                        } else {
                            echo Html::a(' Lanjutkan Pembayaran', Url::to(['pembayaran']), ['class' => 'btn btn-warning btn-flat btn-lg fa fa-money']);
                        }
                    } else {
                        if (empty($data['PERIODE_TUTUP'])) {
                            ?>
                            <div class="callout callout-important" style="font-weight: bold;">
                                Maaf, belum ada periode wisuda yang aktif! 
                            </div>
                            <?php
                        } else {
                            if ($data['PERIODE_TUTUP']['periodeStatus'] == 'tutup') {
                                ?>
                                <div class="callout callout-important" style="font-weight: bold;">
                                    Maaf, Periode Pendaftaran <?php echo $data['PERIODE_TUTUP']['periodeNama'] . ' telah berakhir pada tanggal ' . $inDate->setDate($data['PERIODE_TUTUP']['periodeTglTutup']); ?>!<br/>
                                    Silahkan daftar di periode wisuda selanjutnya.
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="callout callout-important" style="font-weight: bold;">
                                    Maaf, belum ada periode wisuda yang aktif! 
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
