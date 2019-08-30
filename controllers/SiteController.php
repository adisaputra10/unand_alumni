<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\DAO;
use app\models\IndonesiaDate;
use app\models\Berita;
use app\models\Member;
use app\components\DeEnk;
use app\models\Post;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'getfoto', 'gettemplate', 'download', 'berita', 'registrasi-member', 'jadwal', 'reset-password', 'konfirmasi'],
                'rules' => [
                        [
                        'actions' => ['logout', 'getfoto', 'gettemplate', 'download', 'berita'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                        [
                        'actions' => ['login', 'download','getfoto', 'berita', 'jadwal', 'registrasi-member', 'reset-password', 'konfirmasi'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
                    'berita' => ['GET'],
                    'jadwal' => ['GET'],
                    'login' => ['POST', 'GET'],
                    'registrasi-member' => ['POST', 'GET'],
                    'reset-password' => ['POST', 'GET'],
                    'konfirmasi' => ['GET']
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionBerita($act, $key = '') {
        if ($act == 'more') {
            $berita = Berita::findOne(['beritaKey' => $key]);
            return $this->render('beritaDetail', [
                        'berita' => $berita
            ]);
        } else if ($act == 'list') {
            $berita = Berita::find()
                    ->orderBy('beritaWktPublic DESC')
                    ->each();
            return $this->render('beritaList', [
                        'berita' => $berita
            ]);
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
       
//        if (!Yii::$app->user->isGuest) {
//            $id = \Yii::$app->user->identity->userId;
//            
//            return $this->render('indexDashboard', [
//            ]);
//        } else {
//            $post = Post::find()
//                    ->limit(5)
//                    ->orderBy('create_time DESC')
//                    ->each();
//            return $this->render('index', [
//                        'berita' => $post
//            ]);
//        }
            $post = Post::find()
                    ->limit(5)
                    ->orderBy('create_time DESC')
                    ->each();
            return $this->render('index', [
                        'berita' => $post
            ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $session = \Yii::$app->session;
        $session->remove('message');
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionResetPassword() {
        $inDate = new IndonesiaDate();
        $conn = new DAO();
        $enk = new DeEnk();
        $model = new Member();
        if ($model->load(\Yii::$app->request->post())) {
            $qCek = "SELECT * FROM member WHERE memberEmail=:email";
            $rsCek = $conn->QueryRow($qCek, [':email' => $model->memberEmail]);
            if (empty($rsCek)) {
                $model->addError('memberEmail', 'Maaf, Email anda tidak terdaftar.');
            } else {
                $qAcak = "SELECT SUBSTRING(MD5(CONCAT(CHAR(65+MOD(ROUND(RAND()*1000),26)),ROUND(RAND()*100),CHAR(65+MOD(ROUND(RAND()*100),26)),ROUND(RAND()*10))),1,6) AS acak";
                $rsAcak = $conn->QueryRow($qAcak, []);
                $newPass = $rsAcak['acak'];

                $trx = $conn->beginTransaction();
                try {
                    if ($rsCek['memberIsAktif'] == '1') {
                        $pesan = "Kepada Yth :<br/>Member Pusat Bahasa Universitas Andalas,<br/><br/><br/>"
                                . "Selamat, akun member Pusat Bahasa Unand anda sudah di-reset dengan,"
                                . "<br/>Member ID : " . $rsCek['memberId']
                                . "<br/>Username : " . $model->memberEmail
                                . "<br/>Password : " . $newPass
                                . "<br/>Silahkan gunakan username/member ID dan password anda untuk login.<br/>"
                                . "<br/>Terima Kasih.";
                    } else {
                        $pesan = "Kepada Yth :<br/>Member Pusat Bahasa Universitas Andalas,<br/><br/><br/>"
                                . "Selamat, akun member Pusat Bahasa Unand anda sudah di-reset dengan,"
                                . "<br/>Member ID : " . $rsCek['memberId']
                                . "<br/>Username : " . $model->memberEmail
                                . "<br/>Password : " . $newPass
                                . "<br/>Silahkan gunakan username/member ID dan password anda untuk login.<br/>"
                                . "<br/>Berhubung akun anda belum aktif, silahkan klik link dibawah ini untuk mengaktifkan akun anda terlebih dahulu :<br/>"
                                . '<a href="http://simtb.lc.unand.ac.id' . \yii\helpers\Url::to(['konfirmasi', 'key' => $enk->setEnk25($rsCek['memberId'], 'SIMTB-UPT-BAHASA-2019')]) . '">AKTIFASI AKUN</a>'
                                . "<br/>Terima Kasih.";
                    }

                    $model->memberPassword = md5($newPass);
                    $qUpdate = "UPDATE member SET memberPassword=:pass WHERE memberId=:id";
                    $conn->Execute($qUpdate, [':id' => $rsCek['memberId'], ':pass' => $model->memberPassword]);
                    Yii::$app->mailer->compose(['html' => 'layouts/html'], [
                                'content' => $pesan
                            ])
                            ->setTo($model->memberEmail)
                            ->setFrom(Yii::$app->params['adminEmail'])
                            ->setSubject('Reset Password Akun SIMTB UPT-Pusat Bahasa Universitas Andalas')
                            ->send();
                    Yii::$app->session->setFlash('resetSubmitted');
                    $trx->commit();
                } catch (\yii\db\Exception $e) {
                    $trx->rollBack();
                } catch (\Swift_SwiftException $e1) {
                    $trx->rollBack();
                }
            }
        }
        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionRegistrasiMember() {
        $inDate = new IndonesiaDate();
        $conn = new DAO();
        $enk = new DeEnk();
        $model = new Member();
        $model->memberTglEntri = $inDate->getNow();
        $model->memberIsAktif = '0';
        if ($model->load(\Yii::$app->request->post())) {
            $qCek = "SELECT * FROM member WHERE memberEmail=:email";
            $rsCek = $conn->QueryRow($qCek, [':email' => $model->memberEmail]);
            if (!empty($rsCek)) {
                $model->addError('memberEmail', 'Maaf, Email anda telah terdaftar. Jika anda lupa password silahkan klik reset password pada form login.');
            } else if ($model->memberPassword != $model->verifyPass) {
                $model->addError('verifyPass', 'Maaf, Password anda tidak sesuai.');
            } else {
                $trx = Member::getDb()->beginTransaction();
                try {
                    $model->memberId = $model->createMemberID();
                    $model->memberPassword = md5($model->memberPassword);
                    $model->save();
                    Yii::$app->mailer->compose(['html' => 'layouts/html'], [
                                'content' => '<div>'
                                . '<h3>Klik link dibawah ini untuk mengaktifkan akun SIMTB anda.</h3>'
                                . '<a href="http://simtb.lc.unand.ac.id' . \yii\helpers\Url::to(['konfirmasi', 'key' => $enk->setEnk25($model->memberId, 'SIMTB-UPT-BAHASA-2019')]) . '">AKTIFASI AKUN</a>'
                                . '</div>'
                            ])
                            ->setTo($model->memberEmail)
                            ->setFrom(Yii::$app->params['adminEmail'])
                            ->setSubject('Verifikasi Akun SIMTB UPT-Pusat Bahasa Universitas Andalas')
                            ->send();
                    Yii::$app->session->setFlash('registrasiSubmitted');
                    $trx->commit();
                } catch (\yii\db\Exception $e) {
                    $trx->rollBack();
                } catch (\Swift_SwiftException $e1) {
                    $trx->rollBack();
                }
            }
        }
        return $this->render('registrasiMember', [
                    'model' => $model,
        ]);
    }

    public function actionKonfirmasi($key) {
        $conn = new DAO();
        $enk = new DeEnk();
        $id = $enk->setDek25($key, 'SIMTB-UPT-BAHASA-2019');
        $qCek = "SELECT * FROM member WHERE memberId=:id";
        $rsCek = $conn->QueryRow($qCek, [':id' => $id]);
        if (!empty($rsCek)) {
            if ($rsCek['memberIsAktif'] == '0') {
                $query = "UPDATE member SET memberIsAktif='1' WHERE memberId=:id";
                $conn->Execute($query, [':id' => $id]);
            }
            Yii::$app->session->setFlash('konfirmed');
            return $this->render('konfirmasi');
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionJadwal() {
        $inDate = new IndonesiaDate();
        $conn = new DAO();
        $qJenTes = "
            SELECT a.`idJenTes`,a.`namaJenTes`,b.`jdwlTanggal`,''AS idKategori,''AS namaKategori
            FROM `ref_jenis_test` a 
            JOIN ref_tarif c USING(idJenTes)
            JOIN ref_kategori d USING(idKategori)
            JOIN `test_jadwal_kelas` b USING(idJenTes) 
            WHERE /*DATE(NOW())*/'2018-10-10'<b.`jdwlTanggal` AND a.isAktif='1'
            AND idJdwlKelas NOT IN(SELECT idJdwlKelas FROM test_jadwal_fakultas)
            GROUP BY a.`idJenTes`";
        $rsJenTes = $conn->QueryAll($qJenTes, []);
        $data['JENIS'] = [];
        $data['JADWAL'] = [];
        foreach ($rsJenTes as $valJenTes) {
            $data['JENIS'][] = [
                'id' => $valJenTes['idJenTes'],
                'nama' => $valJenTes['namaJenTes']
            ];
            $qJadwal = "SELECT a.`idJenTes`,a.`namaJenTes`,b.`jdwlNama`,
                b.`jdwlTanggal`,b.`jdwlMulai`,b.`jdwlSelesai`,b.`jdwlJmlMax`,
                (SELECT COUNT(*) FROM test_peserta tp WHERE tp.idJdwlKelas=b.`idJdwlKelas`)AS jml
                FROM `ref_jenis_test` a 
                JOIN `test_jadwal_kelas` b USING(idJenTes) 
                WHERE DATE(NOW())<b.`jdwlTanggal` AND b.jdwlIsAktif='1' AND a.isAktif='1' AND b.idJenTes=:jns 
                AND b.`idJdwlKelas` NOT IN(SELECT idJdwlKelas FROM test_jadwal_fakultas)
                AND (SELECT COUNT(*) FROM `test_peserta` WHERE idJdwlKelas=b.idJdwlKelas)<jdwlJmlMax 
                GROUP BY b.`jdwlTanggal`,b.`idJdwlKelas`";
            $rsJadwal = $conn->QueryAll($qJadwal, [':jns' => $valJenTes['idJenTes']]);
            $data['JADWAL'][$valJenTes['idJenTes']] = [];
            foreach ($rsJadwal as $val) {
                $data['JADWAL'][$valJenTes['idJenTes']][] = [
                    'tanggal' => $val['jdwlTanggal'],
                    'kelas' => $val['jdwlNama'],
                    'jam' => $inDate->setTime($val['jdwlMulai']) . ' s/d ' . $inDate->setTime($val['jdwlSelesai']),
                    'kapasitas' => $val['jdwlJmlMax'],
                    'status' => ($val['jml'] >= $val['jdwlJmlMax']) ? '<i class="label label-danger">Penuh</i>' : '<i class="label label-info">Tersedia</i>'
                ];
            }
        }
        return $this->render('jadwal', [
                    'data' => $data
        ]);
    }

    public function actionImage($filename) {
        $file = \Yii::getAlias('@webroot/images/' . $filename);
        if (file_exists($file)) {
            return \Yii::$app->response->sendFile($file, NULL, ['inline' => true]);
        }
    }

    public function actionGetfoto($filename) {
        $file = \Yii::getAlias('@webroot/../berkas/berkas-foto/' . $filename);
        if (file_exists($file)) {
            return \Yii::$app->response->sendFile($file, NULL, ['inline' => true]);
        } else {
            $file1 = \Yii::getAlias('@webroot/images/nobody.png');
            return \Yii::$app->response->sendFile($file1, NULL, ['inline' => true]);
        }
    }

    public function actionGettemplate($filename) {
        $file = \Yii::getAlias('@webroot/../berkas/berkas-template/' . $filename);
        if (file_exists($file)) {
            return \Yii::$app->response->sendFile($file, NULL, ['inline' => true]);
        } else {
            return false;
        }
    }

    public function actionDownload($filename) {
        $file = \Yii::getAlias('@webroot/../berkas/berkas-download/' . $filename);
        if (file_exists($file)) {
            return \Yii::$app->response->sendFile($file, NULL, ['inline' => true]);
        } else {
            return false;
        }
    }

}
