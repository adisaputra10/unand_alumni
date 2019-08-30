<?php

namespace app\models;

use Yii;
use app\models\DAO;

/**
 * This is the model class for table "member".
 *
 * @property string $memberId
 * @property string $memberNama
 * @property string $memberTmpLahir
 * @property string $memberTglLahir
 * @property string $memberJenkel
 * @property string $memberTelp
 * @property string $memberEmail
 * @property string $memberPassword
 * @property string $memberFoto
 * @property string $memberIsAktif
 * @property string $memberTglEntri
 *
 * @property BiodataMhs[] $biodataMhs
 * @property RekapSertifikat[] $rekapSertifikats
 * @property RekapSurket[] $rekapSurkets
 * @property TestJadwalMember[] $testJadwalMembers
 * @property TestJadwalKelas[] $jdwlKelas
 * @property TestPendaftar[] $testPendaftars
 */
class Member extends \yii\db\ActiveRecord {

    public $verifyCode;
    public $verifyPass;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['memberNama', 'memberTmpLahir', 'memberTglLahir', 'memberJenkel', 'memberTelp', 'memberEmail', 'memberPassword','verifyPass'], 'required'],
                [['memberTglLahir', 'memberTglEntri','memberId'], 'safe'],
                [['memberJenkel', 'memberIsAktif'], 'string'],
                [['memberId'], 'string', 'max' => 20],
                [['memberNama'], 'string', 'max' => 150],
                [['memberTmpLahir', 'memberEmail'], 'string', 'max' => 100],
                [['memberTelp'], 'string', 'max' => 35],
                [['memberPassword'], 'string', 'max' => 32],
                [['memberFoto'], 'string', 'max' => 255],
                [['memberId'], 'unique'],
                ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'memberId' => 'Member ID',
            'memberNama' => 'Member Nama',
            'memberTmpLahir' => 'Member Tmp Lahir',
            'memberTglLahir' => 'Member Tgl Lahir',
            'memberJenkel' => 'Member Jenkel',
            'memberTelp' => 'Member Telp',
            'memberEmail' => 'Member Email',
            'memberPassword' => 'Member Password',
            'memberFoto' => 'Member Foto',
            'memberIsAktif' => 'Member Is Aktif',
            'memberTglEntri' => 'Member Tgl Entri',
            'verifyCode' => 'Verification Code',
            'verifyPass'=>'Ulangi Password'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBiodataMhs() {
        return $this->hasMany(BiodataMhs::className(), ['memberId' => 'memberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekapSertifikats() {
        return $this->hasMany(RekapSertifikat::className(), ['memberId' => 'memberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRekapSurkets() {
        return $this->hasMany(RekapSurket::className(), ['memberId' => 'memberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestJadwalMembers() {
        return $this->hasMany(TestJadwalMember::className(), ['memberId' => 'memberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdwlKelas() {
        return $this->hasMany(TestJadwalKelas::className(), ['idJdwlKelas' => 'idJdwlKelas'])->viaTable('test_jadwal_member', ['memberId' => 'memberId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestPendaftars() {
        return $this->hasMany(TestPendaftar::className(), ['memberId' => 'memberId']);
    }

    public function createMemberID() {
        $conn = new DAO;
        $qThn = "SELECT YEAR(NOW())AS thn, MONTH(NOW())AS bln";
        $rsThn = $conn->QueryRow($qThn, array());
        $q = "SELECT memberId FROM member "
                . "WHERE YEAR(memberTglEntri)=YEAR(NOW()) "
                . "AND SUBSTR(memberId,1,6)=CONCAT('LC',SUBSTR(NOW(),1,4)) "
                . "ORDER BY memberId DESC LIMIT 1";
        $rs = $conn->QueryRow($q, array());
        if (!empty($rs['memberId'])) {
            $oldID = $rs['memberId'];
            $oldUrut = (int) substr($oldID, 6, 6);
            $urut = $oldUrut + 1;
            $newID = 'LC' . $rsThn['thn'] . sprintf("%06s", $urut);
        } else {
            $newID = 'LC' . $rsThn['thn'] . '000001';
        }
        return $newID;
    }

}
