<?php

namespace app\modules\daftar\models;

use Yii;

/**
 * This is the model class for table "wisuda_wisudawan".
 *
 * @property string $wwNim
 * @property string $wwNoAlumni
 * @property string $wwIdSkripsi
 * @property string $wwNik
 * @property string $wwNama
 * @property string $wwGlrDepan
 * @property string $wwGlrBelakang
 * @property string $wwJenkel
 * @property string $wwTmpLahir
 * @property string $wwTglLahir
 * @property string $wwTglLahirText
 * @property string $wwEmail
 * @property string $wwHp
 * @property int $wwKabId
 * @property string $wwAlamat
 * @property string $wwPendTerakhir
 * @property int $wwAngkatan
 * @property string $wwProdiKode
 * @property string $wwProgKekhususan
 * @property string $wwJenKode
 * @property int $wwModelrId
 * @property string $wwJalurId
 * @property string $wwJalurNama
 * @property string $wwIsBidikmisi
 * @property string $wwDosenPa
 * @property string $wwJudulTa
 * @property string $wwIsNoTa
 * @property string $wwTglMulaiBimb
 * @property string $wwTglSelesaiBimb
 * @property int $wwLamaStudiThn
 * @property int $wwLamaStudiBln
 * @property int $wwThnWisuda
 * @property string $wwTglLulus
 * @property double $wwIPK
 * @property int $wwPredikatId
 * @property int $wwScoreToefl
 * @property string $wwSapsPredikat
 * @property string $wwSapsLamp
 * @property double $wwTurnitinSimilar untuk Semua Jenjang
 * @property string $wwTurnitinLamp untuk Semua Jenjang
 * @property string $wwRepositoryLink untuk Semua Jenjang
 * @property string $wwJurnalNama untuk S2/S3/Spesialis
 * @property string $wwJurnalLink untuk S2/S3/Spesialis
 * @property string $wwJurnalLampSk untuk S2/S3/Spesialis
 * @property string $wwJurnalVerifikasiTgl untuk S2/S3/Spesialis
 * @property string $wwJurnalVerifikasiStatus untuk S2/S3/Spesialis
 * @property string $wwJurnalVerifikasiKet untuk S2/S3/Spesialis
 * @property string $wwOrtuAyah
 * @property string $wwOrtuIbu
 * @property string $wwFoto
 * @property int $wwWpId
 * @property string $wwConfirmed
 * @property string $wwIjazahPreviewed
 * @property string $wwIsSetuju
 * @property string $wwTglSetuju
 * @property string $wwMengetahuiNama
 * @property string $wwMengetahuiNip
 * @property string $wwMengetahuiJab
 * @property string $wwAnDekan
 * @property string $wwCreate
 *
 * @property RefProdiNasional $wwProdiKode0
 */
class WisudaWisudawan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wisuda_wisudawan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wwNim', 'wwNama', 'wwAngkatan', 'wwProdiKode', 'wwJenKode', 'wwModelrId', 'wwThnWisuda', 'wwCreate'], 'required'],
            [['wwJenkel', 'wwAlamat', 'wwIsBidikmisi', 'wwJudulTa', 'wwIsNoTa', 'wwJurnalNama', 'wwJurnalVerifikasiStatus', 'wwJurnalVerifikasiKet', 'wwIsSetuju', 'wwAnDekan'], 'string'],
            [['wwTglLahir', 'wwTglMulaiBimb', 'wwTglSelesaiBimb', 'wwTglLulus', 'wwJurnalVerifikasiTgl', 'wwConfirmed', 'wwIjazahPreviewed', 'wwTglSetuju', 'wwCreate'], 'safe'],
            [['wwKabId', 'wwAngkatan', 'wwModelrId', 'wwLamaStudiThn', 'wwLamaStudiBln', 'wwThnWisuda', 'wwPredikatId', 'wwScoreToefl', 'wwWpId'], 'integer'],
            [['wwIPK', 'wwTurnitinSimilar'], 'number'],
            [['wwNim'], 'string', 'max' => 15],
            [['wwNoAlumni', 'wwIdSkripsi', 'wwGlrDepan', 'wwGlrBelakang'], 'string', 'max' => 50],
            [['wwNik', 'wwTglLahirText', 'wwJalurNama', 'wwSapsPredikat', 'wwSapsLamp'], 'string', 'max' => 100],
            [['wwNama', 'wwProgKekhususan', 'wwDosenPa', 'wwTurnitinLamp', 'wwJurnalLampSk'], 'string', 'max' => 200],
            [['wwTmpLahir', 'wwEmail', 'wwPendTerakhir', 'wwOrtuAyah', 'wwOrtuIbu', 'wwFoto', 'wwMengetahuiNama', 'wwMengetahuiJab'], 'string', 'max' => 150],
            [['wwHp', 'wwMengetahuiNip'], 'string', 'max' => 30],
            [['wwProdiKode'], 'string', 'max' => 10],
            [['wwJenKode', 'wwJalurId'], 'string', 'max' => 20],
            [['wwRepositoryLink', 'wwJurnalLink'], 'string', 'max' => 250],
            [['wwNim'], 'unique'],
           // [['wwProdiKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefProdiNasional::className(), 'targetAttribute' => ['wwProdiKode' => 'prodiKode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wwNim' => 'Ww Nim',
            'wwNoAlumni' => 'Ww No Alumni',
            'wwIdSkripsi' => 'Ww Id Skripsi',
            'wwNik' => 'Ww Nik',
            'wwNama' => 'Ww Nama',
            'wwGlrDepan' => 'Ww Glr Depan',
            'wwGlrBelakang' => 'Ww Glr Belakang',
            'wwJenkel' => 'Ww Jenkel',
            'wwTmpLahir' => 'Ww Tmp Lahir',
            'wwTglLahir' => 'Ww Tgl Lahir',
            'wwTglLahirText' => 'Ww Tgl Lahir Text',
            'wwEmail' => 'Ww Email',
            'wwHp' => 'Ww Hp',
            'wwKabId' => 'Ww Kab ID',
            'wwAlamat' => 'Ww Alamat',
            'wwPendTerakhir' => 'Ww Pend Terakhir',
            'wwAngkatan' => 'Ww Angkatan',
            'wwProdiKode' => 'Ww Prodi Kode',
            'wwProgKekhususan' => 'Ww Prog Kekhususan',
            'wwJenKode' => 'Ww Jen Kode',
            'wwModelrId' => 'Ww Modelr ID',
            'wwJalurId' => 'Ww Jalur ID',
            'wwJalurNama' => 'Ww Jalur Nama',
            'wwIsBidikmisi' => 'Ww Is Bidikmisi',
            'wwDosenPa' => 'Ww Dosen Pa',
            'wwJudulTa' => 'Ww Judul Ta',
            'wwIsNoTa' => 'Ww Is No Ta',
            'wwTglMulaiBimb' => 'Ww Tgl Mulai Bimb',
            'wwTglSelesaiBimb' => 'Ww Tgl Selesai Bimb',
            'wwLamaStudiThn' => 'Ww Lama Studi Thn',
            'wwLamaStudiBln' => 'Ww Lama Studi Bln',
            'wwThnWisuda' => 'Ww Thn Wisuda',
            'wwTglLulus' => 'Ww Tgl Lulus',
            'wwIPK' => 'Ww Ipk',
            'wwPredikatId' => 'Ww Predikat ID',
            'wwScoreToefl' => 'Ww Score Toefl',
            'wwSapsPredikat' => 'Ww Saps Predikat',
            'wwSapsLamp' => 'Ww Saps Lamp',
            'wwTurnitinSimilar' => 'Ww Turnitin Similar',
            'wwTurnitinLamp' => 'Ww Turnitin Lamp',
            'wwRepositoryLink' => 'Ww Repository Link',
            'wwJurnalNama' => 'Ww Jurnal Nama',
            'wwJurnalLink' => 'Ww Jurnal Link',
            'wwJurnalLampSk' => 'Ww Jurnal Lamp Sk',
            'wwJurnalVerifikasiTgl' => 'Ww Jurnal Verifikasi Tgl',
            'wwJurnalVerifikasiStatus' => 'Ww Jurnal Verifikasi Status',
            'wwJurnalVerifikasiKet' => 'Ww Jurnal Verifikasi Ket',
            'wwOrtuAyah' => 'Ww Ortu Ayah',
            'wwOrtuIbu' => 'Ww Ortu Ibu',
            'wwFoto' => 'Ww Foto',
            'wwWpId' => 'Ww Wp ID',
            'wwConfirmed' => 'Ww Confirmed',
            'wwIjazahPreviewed' => 'Ww Ijazah Previewed',
            'wwIsSetuju' => 'Ww Is Setuju',
            'wwTglSetuju' => 'Ww Tgl Setuju',
            'wwMengetahuiNama' => 'Ww Mengetahui Nama',
            'wwMengetahuiNip' => 'Ww Mengetahui Nip',
            'wwMengetahuiJab' => 'Ww Mengetahui Jab',
            'wwAnDekan' => 'Ww An Dekan',
            'wwCreate' => 'Ww Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWwProdiKode0()
    {
        return $this->hasOne(RefProdiNasional::className(), ['prodiKode' => 'wwProdiKode']);
    }
}
