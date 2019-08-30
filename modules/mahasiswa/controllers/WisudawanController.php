<?php

namespace app\modules\mahasiswa\controllers;

use Yii;
use app\modules\mahasiswa\models\WisudaWisudawan;
use app\modules\mahasiswa\models\WisudaWisudawanSearch;
use app\modules\mahasiswa\models\InvoiceBank;
use app\modules\mahasiswa\models\WisudaWisudawanPembimbing;
use app\modules\mahasiswa\models\RefProdiNasional;
use app\modules\mahasiswa\models\RefFakultas;
use app\modules\mahasiswa\models\WisudaKliring;
use app\modules\mahasiswa\models\WisudaKliringItem;
use app\modules\mahasiswa\models\RefKliring;
use app\modules\mahasiswa\models\WisudaAlumni;
use app\modules\mahasiswa\models\RefVerifikasiJurnal;
use app\modules\mahasiswa\models\RefVerifikasiTurnitin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\DAO;
use app\models\IndonesiaDate;
use app\models\WsConn;
use yii\web\UploadedFile;
use yii\helpers\Json;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;
use yii\data\ArrayDataProvider;
use kartik\mpdf\Pdf;
use Mpdf\Mpdf;
use yii\helpers\Url;

/**
 * WisudawanController implements the CRUD actions for WisudaWisudawan model.
 */
class WisudawanController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['POST', 'GET'],
                    'pembayaran' => ['POST', 'GET'],
                    'konfirmasi' => ['POST', 'GET'],
                    'draf-ijazah' => ['POST', 'GET'],
                    'pernyataan' => ['POST', 'GET'],
                    'cetak' => ['POST', 'GET'],
                    'download' => ['POST', 'GET'],
                    'ganti-mengetahui' => ['POST', 'GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'pembayaran',
                    'konfirmasi',
                    'draf-ijazah',
                    'pernyataan',
                    'cetak',
                    'download',
                    'ganti-mengetahui'
                ],
                'rules' => [
                        [
                        'actions' => [
                            'index',
                            'pembayaran',
                            'konfirmasi',
                            'draf-ijazah',
                            'pernyataan',
                            'cetak',
                            'download',
                            'ganti-mengetahui'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    private function konfirmasiCek($nim) {
        $conn = new DAO();
        $query = "SELECT * ,(SELECT COUNT(*) FROM wisuda_wisudawan_pembimbing WHERE pbbWwNim=a.wwNim)AS jmlPbb "
                . "FROM wisuda_wisudawan a "
                . "WHERE a.wwNim=:nim";
        $result = $conn->QueryRow($query, [':nim' => $nim]);
        //Verifikasi Turnitin
        $vTurnitin = RefVerifikasiTurnitin::findOne([
                    'vtProdiKode' => $result['wwProdiKode'],
                    'vtJenKode' => $result['wwJenKode'],
                    'vtWpId' => $result['wwWpId']
        ]);
        if (!empty($vTurnitin)) {
            $isVT = 1;
        } else {
            $isVT = 0;
        }
        //Verifikasi Jurnal
        $vJurnal = RefVerifikasiJurnal::findOne([
                    'vjProdiKode' => $result['wwProdiKode'],
                    'vjJenKode' => $result['wwJenKode'],
                    'vjWpId' => $result['wwWpId']
        ]);
        if (!empty($vJurnal)) {
            $isVJ = 1;
        } else {
            $isVJ = 0;
        }

        if ($result['wwNama'] == '') {
            $data = ['status' => false, 'message' => 'Nama belum diisi!'];
        } else if ($result['wwTmpLahir'] == '') {
            $data = ['status' => false, 'message' => 'Tempat lahir belum diisi!'];
        } else if ($result['wwTglLahir'] == '') {
            $data = ['status' => false, 'message' => 'Tanggal lahir belum diisi!'];
        } else if ($result['wwHp'] == '') {
            $data = ['status' => false, 'message' => 'HP belum diisi!'];
        } else if ($result['wwEmail'] == '') {
            $data = ['status' => false, 'message' => 'Email belum diisi!'];
        } else if ($result['wwAlamat'] == '') {
            $data = ['status' => false, 'message' => 'Alamat belum diisi!'];
        } else if ($result['wwPendTerakhir'] == '') {
            $data = ['status' => false, 'message' => 'Pendidikan terakhir belum diisi!'];
        } else if ($result['wwOrtuAyah'] == '') {
            $data = ['status' => false, 'message' => 'Nama ayah belum diisi!'];
        } else if ($result['wwOrtuIbu'] == '') {
            $data = ['status' => false, 'message' => 'Nama Ibu belum diisi!'];
        } else if ($result['wwFoto'] == '') {
            $data = ['status' => false, 'message' => 'Foto belum diupload!'];
        } else {
            if ($result['wwIsNoTa'] == '0') {
                //Dengan Tugas Akhir
                if ($result['wwJudulTa'] == '') {
                    $data = ['status' => false, 'message' => 'Judul TA/Skripsi/Tesis/Disertasi belum diisi!'];
                } else if ($result['jmlPbb'] == 0) {
                    $data = ['status' => false, 'message' => 'Pembimbing belum diisi!'];
                } else {
//                    if ($result['wwJenKode'] == 'D3' || $result['wwJenKode'] == 'S1') {
//                        if ($result['wwScoreToefl'] == '' || $result['wwScoreToefl'] == '0') {
//                            $data = ['status' => false, 'message' => 'Score TOEFL belum diisi!'];
//                        } elseif ($result['wwSapsPredikat'] == '' || $result['wwSapsLamp'] == '') {
//                            $data = ['status' => false, 'message' => 'Predikat dan Sertifikat SAPS belum diisi!'];
//                        } else {
//                            $data = ['status' => true, 'message' => ''];
//                        }
//                    } else {
                    if ($isVT == 1 && ($result['wwTurnitinSimilar'] == '' || $result['wwTurnitinLamp'] == '' || $result['wwRepositoryLink'] == '')) {
                        $data = ['status' => false, 'message' => 'Index Kesamaan,Lampiran dan Link Scholar belum diisi!'];
                    } else if ($isVJ == 1 && ($result['wwJurnalNama'] == '' || $result['wwJurnalLampSk'] == '' || $result['wwJurnalLink'] == '')) {
                        $data = ['status' => false, 'message' => 'Nama Jurnal, Lampiran Surat Pernyataan Keabsahan Artikel dan Link Jurnal belum diisi!'];
                    } else {
                        $data = ['status' => true, 'message' => ''];
                    }
//                    }
                }
            } else if ($result['wwIsNoTa'] == '1') {
                //Tanpa Tugas Akhir
//                if ($result['wwJenKode'] == 'D3' || $result['wwJenKode'] == 'S1') {
//                    if ($result['wwScoreToefl'] == '' || $result['wwScoreToefl'] == '0') {
//                        $data = ['status' => false, 'message' => 'Score TOEFL belum diisi!'];
//                    } elseif ($result['wwSapsPredikat'] == '' || $result['wwSapsLamp'] == '') {
//                        $data = ['status' => false, 'message' => 'Predikat dan Sertifikat SAPS belum diisi!'];
//                    } else {
//                        $data = ['status' => true, 'message' => ''];
//                    }
//                } else {
                if ($isVT == 1 && ($result['wwTurnitinSimilar'] == '' || $result['wwTurnitinLamp'] == '' || $result['wwRepositoryLink'] == '')) {
                    $data = ['status' => false, 'message' => 'Index Kesamaan,Lampiran dan Link Scholar belum diisi!'];
                } else if ($isVJ == 1 && ($result['wwJurnalNama'] == '' || $result['wwJurnalLampSk'] == '' || $result['wwJurnalLink'] == '')) {
                    $data = ['status' => false, 'message' => 'Nama Jurnal, Lampiran Surat Pernyataan Keabsahan Artikel dan Link Jurnal belum diisi!'];
                } else {
                    $data = ['status' => true, 'message' => ''];
                }
//                }
            }
        }
        return $data;
    }

    public function actionIndex() {
        $inDate = new IndonesiaDate();
        $conn = new DAO();
        $id = \Yii::$app->user->identity->userId;
        $modelWisuda = WisudaWisudawan::findOne($id);
        $model = new InvoiceBank();
        $data = [];
        $cekInvoice = $model->find()
                //->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim AND wwWpId=invoicePeriodeId')
                ->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim')
                ->join('JOIN', 'wisuda_periode', 'wpId=wwWpId')
                ->where("invoiceNim=:nim", [':nim' => $id])
                ->one();
        if (empty($cekInvoice)) {
            $data['TAGIHAN'] = 0;
        } else {
            $data['TAGIHAN'] = 1;
        }
        $dataProviderItemKliring = [];
        $mhsKliring = WisudaKliring::findOne($id);
        $data['MHS_KLIRING_STATUS'] = empty($mhsKliring->wkStatus) ? 0 : $mhsKliring->wkStatus;
        if (!empty($mhsKliring)) {
            //Cek Periode
            $qCekPeriode = "SELECT * FROM `wisuda_periode` a
                    JOIN `wisuda_periode_pelaksanaan` b ON b.`wppWpId`=a.`wpId`
                    JOIN `wisuda_periode_pelaksanaan_jenjang` c ON c.`wppjWppId`=b.`wppId`
                    WHERE a.`wpIsAktif`='1' AND DATE(NOW())>=a.`wpTglBuka` AND DATE(NOW())<=a.`wpTglTutup`
                    AND c.`wppjJenKode`=:jenj";
            $rsCekPeriode = $conn->QueryRow($qCekPeriode, [
                ':jenj' => $mhsKliring->wkJenKode
            ]);
            //Cek Periode Mahasiswa Terdaftar
            $qCekPeriodeTerdaftar = "SELECT * FROM `wisuda_periode` a
                    JOIN `wisuda_periode_pelaksanaan` b ON b.`wppWpId`=a.`wpId`
                    JOIN `wisuda_periode_pelaksanaan_jenjang` c ON c.`wppjWppId`=b.`wppId`
                    JOIN `wisuda_wisudawan` d ON d.wwWpId=a.wpId
                    WHERE d.wwNim=:nim AND c.`wppjJenKode`=:jenj";
            $rsCekPeriodeTerdaftar = $conn->QueryRow($qCekPeriodeTerdaftar, [
                ':nim' => $id,
                ':jenj' => $mhsKliring->wkJenKode
            ]);

            $data['MHS_STATUS'] = 'lulus';

            $mhs['mhsNama'] = $mhsKliring->wkNama;
            $mhs['mhsNim'] = $mhsKliring->wkNim;
            $mhs['mhsJenkel'] = $mhsKliring->wkJenkel;
            $mhs['mhsTglLahir'] = $mhsKliring->wkTglLahir;
            $mhs['mhsProdiNama'] = $mhsKliring->wkProdiKode0->prodiNama;
            $mhs['mhsJenjNama'] = $mhsKliring->wkJenKode;
            $mhs['mhsFakNama'] = $mhsKliring->wkProdiKode0->prodiFak->fakNama;
            $mhs['mhsAngkatan'] = $mhsKliring->wkAngkatan;

            $data['MHS_BIODATA'] = $mhs;

            if (!empty($rsCekPeriodeTerdaftar)) {
                //Sudah terdaftar pada periode wisuda
                $model->invoicePeriodeId = $rsCekPeriode['wpId'];
                $data['PERIODE'] = [
                    'nama' => $rsCekPeriodeTerdaftar['wpNama'],
                    'tahun' => $rsCekPeriodeTerdaftar['wpTahun'],
                    'tglWisuda' => $rsCekPeriodeTerdaftar['wppTgl'],
                    'tglTutup' => $rsCekPeriodeTerdaftar['wpTglTutup'],
                    'terdaftar' => 1
                ];
            } else {
                //Belum terdaftar pada periode wisuda
                if (!empty($rsCekPeriode)) {
                    $model->invoicePeriodeId = $rsCekPeriode['wpId'];
                    $data['PERIODE'] = [
                        'nama' => $rsCekPeriode['wpNama'],
                        'tahun' => $rsCekPeriode['wpTahun'],
                        'tglWisuda' => $rsCekPeriode['wppTgl'],
                        'tglTutup' => $rsCekPeriode['wpTglTutup'],
                        'terdaftar' => 0
                    ];
                } else {
                    $data['PERIODE'] = [];
                    //Periode Wisuda Tutup
                    $qCekPeriodeTutup = "SELECT a.`wpNama`,a.`wpTahun`,
                        IF(DATE(NOW())<=a.`wpTglTutup`,'buka','tutup')AS infoTutup,
                        a.`wpTglTutup` AS tglTutup
                        FROM `wisuda_periode` a
                        JOIN `wisuda_periode_pelaksanaan` b ON b.`wppWpId`=a.`wpId`
                        JOIN `wisuda_periode_pelaksanaan_jenjang` c ON c.`wppjWppId`=b.`wppId`
                        WHERE a.`wpIsAktif`='1' AND c.`wppjJenKode`=:jenj";
                    $rsCekPeriodeTutup = $conn->QueryRow($qCekPeriodeTutup, [
                        ':jenj' => $mhsKliring->wkJenKode
                    ]);
                    if (!empty($rsCekPeriodeTutup)) {
                        $data['PERIODE_TUTUP'] = [
                            'periodeNama' => $rsCekPeriodeTutup['wpNama'] . ' ' . $rsCekPeriodeTutup['wpTahun'],
                            'periodeStatus' => $rsCekPeriodeTutup['infoTutup'],
                            'periodeTglTutup' => $rsCekPeriodeTutup['tglTutup']
                        ];
                    } else {
                        $data['PERIODE_TUTUP'] = [];
                    }
                }
            }

            //Get Jenis Biaya
            $qJnsBiaya = "SELECT 
                    a.`jnsBiayaId`,
                    CONCAT(a.`jnsBiayaNama`,' (',c.`wpNama`,' ',c.`wpTahun`,')')AS uraian,
                    b.`tarifJumlah` 
                    FROM ref_jenis_biaya a
                    JOIN `ref_tarif` b ON b.`tarifJnsBiayaId`=a.`jnsBiayaId`
                    JOIN `wisuda_periode` c ON c.`wpId`=b.`tarifPeriodeId`
                    JOIN ref_tarif_jenjang d ON d.jenTarifId=b.tarifId
                    WHERE jnsBiayaId='1' AND c.`wpIsAktif`='1' AND d.jenTarifProdiKode=:prodi";
            $rsJnsBiaya = $conn->QueryRow($qJnsBiaya, [':prodi' => $mhsKliring->wkProdiKode]);

            //Komponen Kliring Mahasiswa
            $mhsKliringItem = WisudaKliringItem::find()
                    ->select(['wkiKliringId'])
                    ->join('JOIN', 'wisuda_kliring', 'wkNim=wkiWkNim')
                    ->where("wkiWkNim=:nim AND wkStatus='1' AND wkTglKliring IS NOT NULL AND wkPetugas IS NOT NULL", [':nim' => $id])
                    ->each();
            $mhsHaveClear = [];
            foreach ($mhsKliringItem as $va) {
                $mhsHaveClear[] = $va['wkiKliringId'];
            }
            $queryItem = RefKliring::find();
            $queryItem->select([
                'ref_kliring.kliringId',
                'kliringItem',
                'kliringPetunjuk',
            ]);
            $queryItem->join('JOIN', 'ref_kliring_jenjang', 'ref_kliring_jenjang.kliringId=ref_kliring.kliringId');
            $queryItem->where("kliringJenKode=:jenjang AND kliringIsAktif='1'", [':jenjang' => $mhsKliring->wkJenKode]);
            if (!empty($mhsHaveClear)) {
                $queryItem->andWhere(['IN', 'ref_kliring.kliringId', $mhsHaveClear]);
            }
            $dataProv = [];
            foreach ($queryItem->each() as $val) {
                $dataProv[] = ['kliringId' => $val['kliringId'], 'kliringItem' => $val['kliringItem'], 'kliringPetunjuk' => $val['kliringPetunjuk'], 'wkNim' => $id];
            }
            $dataProviderItemKliring = new ArrayDataProvider([
                'allModels' => $dataProv,
                'pagination' => [
                    'pageSize' => 500
                ]
            ]);

            //Daftar Create Invoice
            if (!empty($rsJnsBiaya)) {
                $model->invoiceNim = $id;
                $model->invoiceNama = ucwords(strtolower($mhsKliring->wkNama));
                $model->invoiceProdiKode = $mhsKliring->wkProdiKode;
                $model->invoiceJnsBiayaId = $rsJnsBiaya['jnsBiayaId'];
                $model->invoiceUraian = $rsJnsBiaya['uraian'];
                $model->invoiceJumlah = $rsJnsBiaya['tarifJumlah'];
                $model->invoiceBankId = 'NAGARI';
                $model->invoiceCreate = $inDate->getNow();
            }
            if ($model->load(\Yii::$app->request->post())) {
                if (!empty($rsJnsBiaya)) {
                    if ($mhsKliring->wkStatus == 1) {
                        $invoiceCek = InvoiceBank::find()
                                ->where("invoiceNim=:nim", [':nim' => $id])
                                ->one();
                        if (empty($invoiceCek)) {
                            //Jika Invoice Masih Kosong
                            if ($model->save()) {
                                $modelWisuda->wwWpId = $model->invoicePeriodeId;
                                $modelWisuda->wwThnWisuda = $model->invoicePeriode->wpTahun;
                                $modelWisuda->wwCreate = $inDate->getNow();
                                if ($modelWisuda->save()) {
                                    $this->refresh();
                                }
                            }
                        } else {
                            //Jika Invoice Sudah Ada dan Sudah Bayar
                            $modelWisuda->wwWpId = $model->invoicePeriodeId;
                            $modelWisuda->wwThnWisuda = $model->invoicePeriode->wpTahun;
                            $modelWisuda->wwCreate = $inDate->getNow();
                            if ($modelWisuda->save()) {
                                $this->refresh();
                            }
                        }
                    }
                } else {
                    \Yii::$app->session->setFlash('warning', 'Maaf, Biaya wisuda belum disetting!');
                    $this->refresh();
                }
            }
        } else {
            $data['MHS_STATUS'] = 'belum-lulus';
            $data['MHS_BIODATA'] = [];
        }

        return $this->render('index', [
                    'model' => $model,
                    'data' => $data,
                    'dataProviderItemKliring' => $dataProviderItemKliring
        ]);
    }

    public function actionPembayaran() {
        $id = \Yii::$app->user->identity->userId;
        $cekInvoice = InvoiceBank::find()
                ->select(['*', 'bankNama', 'bankKode', 'bankKodeVA', '(SELECT CONCAT(wpNama," tahun ",wpTahun) FROM wisuda_periode WHERE wpId=wwWpId)AS periodeNama'])
                ->join('JOIN', 'ref_bank', 'bankId=invoiceBankId')
                ->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim')
                ->join('JOIN', 'wisuda_periode', 'wpId=wwWpId')
                //->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim AND wwWpId=wpId')
                ->where("invoiceNim=:nim", [':nim' => $id])
                ->one();
        if (!empty($cekInvoice)) {
            $va['BANK_SAMA'] = $cekInvoice['bankKodeVA'] . $cekInvoice['invoiceNim'];
            $va['BANK_BEDA'] = $cekInvoice['bankKode'] . $cekInvoice['bankKodeVA'] . $cekInvoice['invoiceNim'];
            return $this->render('pembayaran', [
                        'va' => $va,
                        'data' => $cekInvoice
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionKonfirmasi($act = '') {
        $conn = new DAO();
        $inDate = new IndonesiaDate();
        $id = \Yii::$app->user->identity->userId;
        //$wsConn = new WsConn();
        //$token = $wsConn->getToken();
        $cekInvoice = InvoiceBank::find()
                ->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim')
                ->where("invoiceNim=:nim AND invoiceFlag='1' AND invoiceTglBayar IS NOT NULL AND invoiceBuktiBayar IS NOT NULL AND wwWpId IS NOT NULL", [
                    ':nim' => $id
                ])
                ->one();
        if (!empty($cekInvoice)) {
            $model = WisudaWisudawan::findOne($id);
            //Verifikasi Turnitin
            $vTurnitin = RefVerifikasiTurnitin::findOne([
                        'vtProdiKode' => $model->wwProdiKode,
                        'vtJenKode' => $model->wwJenKode,
                        'vtWpId' => $model->wwWpId
            ]);
            if (!empty($vTurnitin)) {
                $isVT = 1;
            } else {
                $isVT = 0;
            }
            //Verifikasi Jurnal
            $vJurnal = RefVerifikasiJurnal::findOne([
                        'vjProdiKode' => $model->wwProdiKode,
                        'vjJenKode' => $model->wwJenKode,
                        'vjWpId' => $model->wwWpId
            ]);
            if (!empty($vJurnal)) {
                $isVJ = 1;
            } else {
                $isVJ = 0;
            }
            if ($act == 'update-biodata') {
                if ($model->wwIsSetuju == 0) {
                    $oldFoto = $model->wwFoto;
                    if ($model->load(\Yii::$app->request->post())) {
                        if (\Yii::$app->request->post('btn-simpan')) {
                            if (empty($model->wwNama)) {
                                $model->addError('wwNama', 'Nama harus diisi!');
                            } else if (empty($model->wwTmpLahir)) {
                                $model->addError('wwTmpLahir', 'Tempat lahir harus diisi!');
                            } else if (empty($model->wwTglLahir)) {
                                $model->addError('wwTglLahir', 'Tanggal lahir harus diisi!');
                            } else if (empty($model->wwTglLahirText)) {
                                $model->addError('wwTglLahirText', 'Tanggal lahir harus diisi!');
                            } else if (empty($model->wwKabId)) {
                                $model->addError('wwKabId', 'Kabupaten/Kota harus diisi!');
                            } else if (empty($model->wwHp)) {
                                $model->addError('wwHp', 'HP harus diisi!');
                            } else if (empty($model->wwEmail)) {
                                $model->addError('wwEmail', 'Email harus diisi!');
                            } else if (empty($model->wwAlamat)) {
                                $model->addError('wwAlamat', 'Alamat harus diisi!');
                            } else if (empty($model->wwPendTerakhir)) {
                                $model->addError('wwPendTerakhir', 'Pendidikan terakhir harus diisi!');
                            } else if (empty($model->wwOrtuAyah)) {
                                $model->addError('wwOrtuAyah', 'Nama ayah harus diisi!');
                            } else if (empty($model->wwOrtuIbu)) {
                                $model->addError('wwOrtuIbu', 'Nama Ibu harus diisi!');
                            } else {
                                $fileFoto = 'foto-' . $model->wwNim;
                                $model->wwFoto = UploadedFile::getInstance($model, 'wwFoto');
                                if ($model->wwFoto != null) {
                                    $model->wwFoto->saveAs(Yii::getAlias('@webroot/../berkas/berkas-foto/') . $fileFoto . '.' . $model->wwFoto->extension);
                                }
                                if ($oldFoto == '' && $model->wwFoto == null) {
                                    $model->addError('wwFoto', 'Foto harus diisi!');
                                } else {
                                    if ($model->wwFoto != null) {
                                        $model->wwFoto = $fileFoto . '.' . $model->wwFoto->extension;
                                    } else {
                                        $model->wwFoto = $oldFoto;
                                    }
                                    $model->wwConfirmed = null;
                                    if ($model->save(0)) {
                                        return $this->redirect(['konfirmasi']);
                                    }
                                }
                            }
                        }
                    }
                    return $this->render('konfirmasiUpdateBiodata', [
                                'model' => $model
                    ]);
                } else {
                    return $this->redirect(['konfirmasi']);
                }
            } else if ($act == 'update-akademik') {
                if ($model->wwIsSetuju == 0) {
                    //Alumni
                    $modelAlumni = WisudaAlumni::findOne($id);
                    $model->wwNoAlumni = empty($modelAlumni) ? null : $modelAlumni->waNoAlumni;
                    //Pembimbing
                    $modelPembimbing = WisudaWisudawanPembimbing::find()
                            ->where("pbbWwNim=:nim", [':nim' => $id])
                            ->orderBy('pbbKet ASC')
                            ->all();
                    $model->pembimbing = $modelPembimbing;
                    $oldSaps = $model->wwSapsLamp;
                    $oldTurnitin = $model->wwTurnitinLamp;
                    $oldSuratArtikel = $model->wwJurnalLampSk;
                    $jenjKode = $model->wwJenKode;
                    if ($model->load(\Yii::$app->request->post())) {
                        if (\Yii::$app->request->post('btn-simpan')) {
                            if (empty($model->wwDosenPa)) {
                                $model->addError('wwDosenPa', 'Pembimbing Akademik cannot be blank.');
                            } else {
                                if ($model->wwIsNoTa == '0') {
                                    //Dengan Tugas Akhir
                                    if (empty($model->wwJudulTa)) {
                                        $model->addError('wwJudulTa', 'Judul TA/Skripsi/Tesis/Disertasi harus diisi!');
                                    } else {
                                        if (empty($model->pembimbing[0]['pbbNama']) || empty($model->pembimbing[0]['pbbKet'])) {
                                            $model->addError('pembimbing', 'Pembimbing harus diisi!');
                                        } else {
                                            $fileSaps = 'saps-' . $model->wwNim;
                                            $model->wwSapsLamp = UploadedFile::getInstance($model, 'wwSapsLamp');
                                            if ($model->wwSapsLamp != null) {
                                                $model->wwSapsLamp->saveAs(Yii::getAlias('@webroot/../berkas/berkas-saps/') . $fileSaps . '.' . $model->wwSapsLamp->extension);
                                                $model->wwSapsLamp = $fileSaps . '.' . $model->wwSapsLamp->extension;
                                            } else {
                                                $model->wwSapsLamp = $oldSaps;
                                            }

                                            $fileTurnitin = 'turnitin-' . $model->wwNim;
                                            $model->wwTurnitinLamp = UploadedFile::getInstance($model, 'wwTurnitinLamp');
                                            if ($model->wwTurnitinLamp != null) {
                                                $model->wwTurnitinLamp->saveAs(Yii::getAlias('@webroot/../berkas/berkas-turnitin/') . $fileTurnitin . '.' . $model->wwTurnitinLamp->extension);
                                                $model->wwTurnitinLamp = $fileTurnitin . '.' . $model->wwTurnitinLamp->extension;
                                            } else {
                                                $model->wwTurnitinLamp = $oldTurnitin;
                                            }

                                            $fileSuratArtikel = 'surat-keabsahan-artikel-' . $model->wwNim;
                                            $model->wwJurnalLampSk = UploadedFile::getInstance($model, 'wwJurnalLampSk');
                                            if ($model->wwJurnalLampSk != null) {
                                                $model->wwJurnalLampSk->saveAs(Yii::getAlias('@webroot/../berkas/berkas-surat-keabsahan-artikel/') . $fileSuratArtikel . '.' . $model->wwJurnalLampSk->extension);
                                                $model->wwJurnalLampSk = $fileSuratArtikel . '.' . $model->wwJurnalLampSk->extension;
                                            } else {
                                                $model->wwJurnalLampSk = $oldSuratArtikel;
                                            }
                                            //Akademik Profesi, Spesialis, S2 dan S3
                                            $model->wwConfirmed = null;
                                            if ($model->wwJurnalVerifikasiStatus == 'Ditolak') {
                                                $model->wwJurnalVerifikasiKet = null;
                                                $model->wwJurnalVerifikasiStatus = null;
                                            }
                                            if ($model->save(0)) {
                                                //Pembimbing
                                                $qDelPtg = "DELETE FROM wisuda_wisudawan_pembimbing WHERE pbbWwNim=:nim";
                                                $conn->Execute($qDelPtg, [':nim' => $model->primaryKey]);
                                                $paramsPtg = [];
                                                foreach ($model->pembimbing as $valPbb) {
                                                    $paramsPtg[] = [$model->primaryKey, $valPbb['pbbNama'], $valPbb['pbbKet'], $inDate->getNow()];
                                                }
                                                $conn->BatchInsert('wisuda_wisudawan_pembimbing', ['pbbWwNim', 'pbbNama', 'pbbKet', 'pbbCreate'], $paramsPtg);
                                                return $this->redirect(['konfirmasi']);
                                            }
                                            //Akademik Profesi, Spesialis, S2 dan S3
//                                            $model->wwConfirmed = null;
//                                            if ($model->save(0)) {
//                                                //Pembimbing
//                                                $qDelPtg = "DELETE FROM wisuda_wisudawan_pembimbing WHERE pbbWwNim=:nim";
//                                                $conn->Execute($qDelPtg, [':nim' => $model->primaryKey]);
//                                                $paramsPtg = [];
//                                                foreach ($model->pembimbing as $valPbb) {
//                                                    $paramsPtg[] = [$model->primaryKey, $valPbb['pbbNama'], $valPbb['pbbKet'], $inDate->getNow()];
//                                                }
//                                                $conn->BatchInsert('wisuda_wisudawan_pembimbing', ['pbbWwNim', 'pbbNama', 'pbbKet', 'pbbCreate'], $paramsPtg);
//                                                return $this->redirect(['konfirmasi']);
//                                            }
                                        }
                                    }
                                } else if ($model->wwIsNoTa == '1') {
                                    //Tanpa Tugas Akhir
                                    $fileSaps = 'saps-' . $model->wwNim;
                                    $model->wwSapsLamp = UploadedFile::getInstance($model, 'wwSapsLamp');
                                    if ($model->wwSapsLamp != null) {
                                        $model->wwSapsLamp->saveAs(Yii::getAlias('@webroot/../berkas/berkas-saps/') . $fileSaps . '.' . $model->wwSapsLamp->extension);
                                        $model->wwSapsLamp = $fileSaps . '.' . $model->wwSapsLamp->extension;
                                    } else {
                                        $model->wwSapsLamp = $oldSaps;
                                    }

                                    $fileTurnitin = 'turnitin-' . $model->wwNim;
                                    $model->wwTurnitinLamp = UploadedFile::getInstance($model, 'wwTurnitinLamp');
                                    if ($model->wwTurnitinLamp != null) {
                                        $model->wwTurnitinLamp->saveAs(Yii::getAlias('@webroot/../berkas/berkas-turnitin/') . $fileTurnitin . '.' . $model->wwTurnitinLamp->extension);
                                        $model->wwTurnitinLamp = $fileTurnitin . '.' . $model->wwTurnitinLamp->extension;
                                    } else {
                                        $model->wwTurnitinLamp = $oldTurnitin;
                                    }

                                    $fileSuratArtikel = 'surat-keabsahan-artikel-' . $model->wwNim;
                                    $model->wwJurnalLampSk = UploadedFile::getInstance($model, 'wwJurnalLampSk');
                                    if ($model->wwJurnalLampSk != null) {
                                        $model->wwJurnalLampSk->saveAs(Yii::getAlias('@webroot/../berkas/berkas-surat-keabsahan-artikel/') . $fileSuratArtikel . '.' . $model->wwJurnalLampSk->extension);
                                        $model->wwJurnalLampSk = $fileSuratArtikel . '.' . $model->wwJurnalLampSk->extension;
                                    } else {
                                        $model->wwJurnalLampSk = $oldSuratArtikel;
                                    }
                                    //Akademik Profesi, Spesialis, S2 dan S3
                                    $model->wwConfirmed = null;
                                    if ($model->wwJurnalVerifikasiStatus == 'Ditolak') {
                                        $model->wwJurnalVerifikasiKet = null;
                                        $model->wwJurnalVerifikasiStatus = null;
                                    }
                                    if ($model->save(0)) {
                                        //Pembimbing
                                        $qDelPtg = "DELETE FROM wisuda_wisudawan_pembimbing WHERE pbbWwNim=:nim";
                                        $conn->Execute($qDelPtg, [':nim' => $model->primaryKey]);
                                        $paramsPtg = [];
                                        foreach ($model->pembimbing as $valPbb) {
                                            $paramsPtg[] = [$model->primaryKey, $valPbb['pbbNama'], $valPbb['pbbKet'], $inDate->getNow()];
                                        }
                                        $conn->BatchInsert('wisuda_wisudawan_pembimbing', ['pbbWwNim', 'pbbNama', 'pbbKet', 'pbbCreate'], $paramsPtg);
                                        return $this->redirect(['konfirmasi']);
                                    }
                                }
                            }
                        }
                    }
                    return $this->render('konfirmasiUpdateAkademik', [
                                'model' => $model,
                                'isVT' => $isVT,
                                'isVJ' => $isVJ
                    ]);
                } else {
                    return $this->redirect(['konfirmasi']);
                }
            } else {
                $modelPembimbing = WisudaWisudawanPembimbing::find()
                        ->where("pbbWwNim=:nim", [':nim' => $id])
                        ->orderBy('pbbKet ASC')
                        ->each();
                if ($model->load(\Yii::$app->request->post())) {
                    $model->wwConfirmed = $inDate->getNow();
                    $model->wwIjazahPreviewed = null;
                    if (\Yii::$app->request->post('btn-simpan')) {
                        $cekKonfirm = $this->konfirmasiCek($id);
                        if ($cekKonfirm['status'] == false) {
                            \Yii::$app->session->setFlash('danger', $cekKonfirm['message']);
                            return $this->refresh();
                        } else {
                            if ($model->save(0)) {
                                \Yii::$app->session->setFlash('success', 'Terima kasih telah mengkonfirmasi biodata anda. Silahkan preview Draf Ijazah anda.');
                                return $this->redirect(['konfirmasi']);
                            }
                        }
                    }
                }

                if ($isVJ == 1 || $isVT == 1) {
                    if ($isVJ == 1) {
                        if ($model->wwJurnalNama == NULL || $model->wwJurnalLink == NULL) {
                            $sVJ = 2;
                            $kVJ = '';
                        } else {
                            if ($model->wwJurnalVerifikasiStatus == 'Diterima') {
                                $sVJ = 0;
                                $kVJ = '';
                            } else if ($model->wwJurnalVerifikasiStatus == 'Ditolak') {
                                $sVJ = 1;
                                $kVJ = 'Jurnal anda TIDAK memenuhi syarat. Silahkan perbaiki dan upload ulang.';
                            } else {
                                $sVJ = 1;
                                $kVJ = 'Menunggu verifikasi jurnal/proceeding oleh Bidang Akademik Universitas Andalas.';
                            }
                        }
                    } else {
                        $sVJ = 0;
                        $kVJ = '';
                    }

                    if ($isVT == 1) {
                        if ($model->wwTurnitinSimilar == null) {
                            $sVT = 2;
                            $kVT = '';
                        } else {
                            if ($model->wwTurnitinSimilar <= $vTurnitin->vtIndexKesamaan) {
                                $sVT = 0;
                                $kVT = '';
                            } else {
                                $sVT = 1;
                                $kVT = 'Persentase Index Kesamaan pada Turnitin melebihi syarat yang ditentukan, yaitu ' . $vTurnitin->vtIndexKesamaan . ' %. Silahkan lakukan perbaikan.';
                            }
                        }
                    } else {
                        $sVT = 0;
                        $kVT = '';
                    }
                    $tungguVerifikasi = [
                        'statusVT' => $sVT,
                        'ketVT' => $kVT,
                        'statusVJ' => $sVJ,
                        'ketVJ' => $kVJ
                    ];
                } else {
                    $tungguVerifikasi = [
                        'statusVT' => 0,
                        'ketVT' => '',
                        'statusVJ' => 0,
                        'ketVJ' => ''
                    ];
                }
                return $this->render('konfirmasi', [
                            'model' => $model,
                            'modelPembimbing' => $modelPembimbing,
                            'isVT' => $isVT,
                            'isVJ' => $isVJ,
                            'tungguVerifikasi' => $tungguVerifikasi,
                ]);
            }
        } else {
            return $this->redirect(['pembayaran']);
        }
    }

    public function actionDrafIjazah() {
        $conn = new DAO();
        $inDate = new IndonesiaDate();
        $id = \Yii::$app->user->identity->userId;
        $cekInvoice = InvoiceBank::find()
                ->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim')
                ->where("invoiceNim=:nim AND invoiceFlag='1' AND invoiceTglBayar IS NOT NULL "
                        . "AND invoiceBuktiBayar IS NOT NULL AND wwConfirmed IS NOT NULL", [
                    ':nim' => $id
                ])
                ->one();
        if (!empty($cekInvoice)) {
            $model = WisudaWisudawan::findOne($id);
            if ($model->load(\Yii::$app->request->post())) {
                $model->wwIjazahPreviewed = $inDate->getNow();
                $dataFak = RefFakultas::find()
                        ->join('JOIN', 'ref_prodi_nasional', 'prodiFakId=fakId')
                        ->where("prodiKode=:kode", [':kode' => $model->wwProdiKode])
                        ->one();
                $model->wwMengetahuiNama = $dataFak->fakDekanNama;
                $model->wwMengetahuiNip = $dataFak->fakDekanNip;
                $model->wwMengetahuiJab = 'Dekan';
                if (\Yii::$app->request->post('btn-simpan')) {
                    if ($model->save(0)) {
                        \Yii::$app->session->setFlash('success', 'Terima kasih telah melakukan preview Draf Ijazah. Silahkan buat surat pernyataan.');
                        return $this->refresh();
                    }
                }
            }
            $query = "SELECT * FROM `wisuda_wisudawan` a
                    JOIN `wisuda_periode` b ON b.`wpId`=a.`wwWpId`
                    JOIN `wisuda_periode_pelaksanaan` c ON c.`wppWpId`=b.`wpId`
                    JOIN `wisuda_periode_pelaksanaan_jenjang` d ON d.`wppjWppId`=c.`wppId` AND d.`wppjJenKode`=a.`wwJenKode`
                    JOIN `invoice_bank` e ON e.`invoiceNim`=a.`wwNim`
                    JOIN `ref_prodi_nasional` f ON f.`prodiKode`=a.`wwProdiKode`
                    JOIN `ref_fakultas` g ON g.`fakId`=f.`prodiFakId`
                    JOIN `satker` h ON h.`satkerKode`=g.`fakSatkerKode`
                    JOIN `ref_predikat` i ON i.`predikatId`=a.`wwPredikatId` 
                    WHERE a.`wwNim`=:nim AND e.invoiceFlag='1' AND e.invoiceTglBayar IS NOT NULL 
                    AND e.invoiceBuktiBayar IS NOT NULL AND wwConfirmed IS NOT NULL";
            $result = $conn->QueryRow($query, [':nim' => $id]);
            return $this->render('drafIjazah', [
                        'model' => $model,
                        'result' => $result
            ]);
        } else {
            return $this->redirect(['konfirmasi']);
        }
    }

    public function actionPernyataan() {
        $inDate = new IndonesiaDate();
        $id = \Yii::$app->user->identity->userId;
        $cekInvoice = InvoiceBank::find()
                ->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim')
                ->where("invoiceNim=:nim AND invoiceFlag='1' AND invoiceTglBayar IS NOT NULL "
                        . "AND invoiceBuktiBayar IS NOT NULL AND wwConfirmed IS NOT NULL AND wwIjazahPreviewed IS NOT NULL", [
                    ':nim' => $id
                ])
                ->one();
        if (!empty($cekInvoice)) {
            $model = WisudaWisudawan::findOne($id);
            $data['MHS'] = [
                'nama' => $model->wwNama,
                'glrDepan' => $model->wwGlrDepan,
                'glrBelakang' => $model->wwGlrBelakang,
                'nim' => $model->wwNim,
                'tmpLahir' => $model->wwTmpLahir,
                'tglLahir' => $model->wwTglLahir,
                'prodiNama' => RefProdiNasional::findOne($model->wwProdiKode)->prodiNama,
                'mengetahuiNama' => $model->wwMengetahuiNama,
                'mengetahuiNip' => $model->wwMengetahuiNip,
                'mengetahuiJab' => $model->wwMengetahuiJab,
                'anDekan' => $model->wwAnDekan,
            ];
            $model->wwTglSetuju = $inDate->getNow();
            if ($model->load(\Yii::$app->request->post())) {
                $model->wwIsSetuju = '1';
                if (\Yii::$app->request->post('btn-simpan')) {
                    if ($model->save(0)) {
                        \Yii::$app->session->setFlash('success', 'Terima kasih telah menyetujui pernyataan ini.');
                        return $this->refresh();
                    }
                }
            }
            return $this->render('pernyataan', [
                        'model' => $model,
                        'data' => $data
            ]);
        } else {
            return $this->redirect(['draf-ijazah']);
        }
    }

    public function actionGantiMengetahui() {
        if (\Yii::$app->request->isAjax) {
            $id = \Yii::$app->user->identity->userId;
            $model = WisudaWisudawan::findOne($id);
            if ($model->load(\Yii::$app->request->post())) {
                if (empty($model->wwMengetahuiNama)) {
                    $result = [
                        'status' => 'warning',
                        'attribute' => 'wwmengetahuinama',
                        'message' => 'Nama harus diisi.'
                    ];
                } else if (empty($model->wwMengetahuiNip)) {
                    $result = [
                        'status' => 'warning',
                        'attribute' => 'wwmengetahuinip',
                        'message' => 'NIP harus diisi.'
                    ];
                } else if (empty($model->wwMengetahuiJab)) {
                    $result = [
                        'status' => 'warning',
                        'attribute' => 'wwmengetahuijab',
                        'message' => 'Jabatan harus diisi.'
                    ];
                } else {

                    if ($model->save()) {
                        $result = [
                            'status' => 'success',
                            'attribute' => '',
                            'message' => ''
                        ];
                    } else {
                        $result = [
                            'status' => 'warning',
                            'attribute' => '',
                            'message' => $model->getErrors()
                        ];
                    }
                }
                return Json::encode($result);
            }
            return $this->renderAjax('gantiMengetahui', [
                        'model' => $model
            ]);
        } else {
            return $this->redirect(['pernyataan']);
        }
    }

    public function actionCetak($act, $ext = '') {
        $this->layout = '//mainPrint';
        $id = \Yii::$app->user->identity->userId;
        $inDate = new IndonesiaDate();
        $conn = new DAO();
        if ($act == 'pembayaran') {
            $cekInvoice = InvoiceBank::find()
                    ->select(['*', 'bankNama', 'bankKode', 'bankKodeVA', '(SELECT CONCAT(wpNama," tahun ",wpTahun) FROM wisuda_periode WHERE wpId=wwWpId)AS periodeNama'])
                    ->join('JOIN', 'ref_bank', 'bankId=invoiceBankId')
                    ->join('JOIN', 'wisuda_periode', 'wpId=invoicePeriodeId')
                    ->join('JOIN', 'wisuda_wisudawan', 'wwNim=invoiceNim')
                    ->where("invoiceNim=:nim", [':nim' => $id])
                    ->one();
            $va['BANK_SAMA'] = $cekInvoice['bankKodeVA'] . $cekInvoice['invoiceNim'];
            $va['BANK_BEDA'] = $cekInvoice['bankKode'] . $cekInvoice['bankKodeVA'] . $cekInvoice['invoiceNim'];
            if ($ext == 'pdf') {
                $mpdf = new Mpdf();
                $mpdf->tMargin = 15;
                $mpdf->rMargin = 15;
                $mpdf->lMargin = 15;
                $mpdf->title = 'Tagihan Biaya Wisuda';
                $mpdf->AddPage('P', 'A4');
                $mpdf->WriteHTML($this->renderPartial('pembayaranCetakPdf', [
                            'va' => $va,
                            'data' => $cekInvoice
                ]));
                return $mpdf->Output('Tagihan-Biaya-Wisuda-' . $id, 'I');
            } else {
                return $this->render('pembayaranCetak', [
                            'va' => $va,
                            'data' => $cekInvoice
                ]);
            }
        } else if ($act == 'pernyataan') {
            $model = WisudaWisudawan::findOne($id);
            $data['MHS'] = [
                'nama' => $model->wwNama,
                'glrDepan' => $model->wwGlrDepan,
                'glrBelakang' => $model->wwGlrBelakang,
                'nim' => $model->wwNim,
                'tmpLahir' => $model->wwTmpLahir,
                'tglLahir' => $model->wwTglLahir,
                'prodiNama' => RefProdiNasional::findOne($model->wwProdiKode)->prodiNama,
                'mengetahuiNama' => $model->wwMengetahuiNama,
                'mengetahuiNip' => $model->wwMengetahuiNip,
                'mengetahuiJab' => $model->wwMengetahuiJab,
                'anDekan' => $model->wwAnDekan,
                'tglSetuju' => $model->wwTglSetuju
            ];
            if ($ext == 'ms-word') {
                $pathTmplt = \Yii::getAlias('@webroot/../berkas/berkas-template/');
                $tmplProc = new TemplateProcessor($pathTmplt . 'template_surat_pernyataan.docx');
                $tmplProc->setValue('mhsNim', $model->wwNim);
                $tmplProc->setValue('mhsNama', $model->wwGlrDepan . $model->wwNama . $model->wwGlrBelakang);
                $tmplProc->setValue('mhsTmpLahir', $model->wwTmpLahir);
                $tmplProc->setValue('mhsTglLahir', $inDate->setDate($model->wwTglLahir));
                $tmplProc->setValue('mhsProdi', RefProdiNasional::findOne($model->wwProdiKode)->prodiNama);
                $tmplProc->setValue('mengetahuiNama', $model->wwMengetahuiNama);
                $tmplProc->setValue('mengetahuiNip', $model->wwMengetahuiNip);
                $tmplProc->setValue('mengetahuiJab', $model->wwMengetahuiJab);
                $tmplProc->setValue('mhsTglSetuju', $inDate->setDate($model->wwTglSetuju));
                if ($model->wwAnDekan == 1) {
                    $tmplProc->setValue('anDekan', 'An.Dekan,');
                } else {
                    $tmplProc->setValue('anDekan', '');
                }
                $path = \Yii::getAlias('@webroot/../berkas/berkas-pernyataan/');
                $fileName = 'Surat-Pernyataan-' . $model->wwNim . '.docx';
                $tmplProc->saveAs($path . $fileName);
                return \Yii::$app->response->sendFile($path . $fileName, NULL, ['inline' => true]);
            } else if ($ext == 'pdf') {
                $mpdf = new Mpdf();
                $mpdf->tMargin = 15;
                $mpdf->rMargin = 15;
                $mpdf->lMargin = 15;
                $mpdf->title = 'Surat Pernyataan';
                $mpdf->AddPage('P', 'A4');
                $mpdf->WriteHTML($this->renderPartial('pernyataanCetak', [
                            'model' => $model,
                            'data' => $data
                ]));
                return $mpdf->Output('Surat-Pernyataan-' . $id, 'I');
            } else {
                return $this->render('pernyataanCetak', [
                            'data' => $data
                ]);
            }
        } else if ($act == 'draf-ijazah') {
            $model = WisudaWisudawan::findOne($id);
            $query = "SELECT * FROM `wisuda_wisudawan` a
                    JOIN `wisuda_periode` b ON b.`wpId`=a.`wwWpId`
                    JOIN `wisuda_periode_pelaksanaan` c ON c.`wppWpId`=b.`wpId`
                    JOIN `wisuda_periode_pelaksanaan_jenjang` d ON d.`wppjWppId`=c.`wppId` AND d.`wppjJenKode`=a.`wwJenKode`
                    JOIN `invoice_bank` e ON e.`invoiceNim`=a.`wwNim`
                    JOIN `ref_prodi_nasional` f ON f.`prodiKode`=a.`wwProdiKode`
                    JOIN `ref_fakultas` g ON g.`fakId`=f.`prodiFakId`
                    JOIN `satker` h ON h.`satkerKode`=g.`fakSatkerKode`
                    JOIN `ref_predikat` i ON i.`predikatId`=a.`wwPredikatId` 
                    WHERE a.`wwNim`=:nim AND e.invoiceFlag='1' AND e.invoiceTglBayar IS NOT NULL 
                    AND e.invoiceBuktiBayar IS NOT NULL AND wwConfirmed IS NOT NULL";
            $result = $conn->QueryRow($query, [':nim' => $id]);
            if ($ext == 'pdf') {
                $mpdf = new Mpdf();
                $mpdf->tMargin = 10;
                $mpdf->rMargin = 15;
                $mpdf->lMargin = 15;
                $mpdf->SetWatermarkText('DRAF IJAZAH');
                $mpdf->showWatermarkText = true;
                $mpdf->SetWatermarkImage(Yii::getAlias('@webroot/images/logo-header.png'));
                $mpdf->showWatermarkImage = true;
                $mpdf->title = 'Draf Ijazah';
                $mpdf->AddPage('L', 'A4');
                $mpdf->WriteHTML($this->renderPartial('drafIjazahCetak', [
                            'model' => $model,
                            'result' => $result
                ]));
                return $mpdf->Output('Draf-Ijazah-' . $id, 'I');
            }
        }
    }

    public function actionDownload($act, $filename) {
        if ($act == 'saps') {
            $file = \Yii::getAlias('@webroot/../berkas/berkas-saps/' . $filename);
        } else if ($act == 'turnitin') {
            $file = \Yii::getAlias('@webroot/../berkas/berkas-turnitin/' . $filename);
        } else if ($act == 'surat-absah-artikel') {
            $file = \Yii::getAlias('@webroot/../berkas/berkas-surat-keabsahan-artikel/' . $filename);
        }
        return \Yii::$app->response->sendFile($file, NULL, ['inline' => true]);
    }

}
