<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_wisudawan".
 *
 * @property string $wwNim
 * @property string $wwNoAlumni
 * @property string $wwIdSkripsi
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
 * @property int $wwTurnitinSimilar
 * @property string $wwTurnitinLamp
 * @property string $wwRepositoryLink
 * @property string $wwJurnalNama
 * @property string $wwJurnalLink
 * @property string $wwJurnalLampSk
 * @property string $wwJurnalVerifikasiTgl
 * @property string $wwJurnalVerifikasiStatus
 * @property string $wwJurnalVerifikasiKet
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
 * @property WisudaUser $wwNim0
 * @property WisudaWisudawanPembimbing[] $wisudaWisudawanPembimbings
 */
class WisudaWisudawan extends \yii\db\ActiveRecord {

    public $pembimbing;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wisuda_wisudawan';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['wwNim', 'wwNama', 'wwJenkel', 'wwTglLahir', 'wwTglLahirText', 'wwEmail', 'wwHp', 'wwKabId', 'wwAlamat', 'wwAngkatan', 'wwProdiKode', 'wwJenKode', 'wwModelrId','wwDosenPa', 'wwJudulTa', 'wwTglMulaiBimb', 'wwTglSelesaiBimb', 'wwLamaStudiThn', 'wwLamaStudiBln', 'wwThnWisuda', 'wwTglLulus', 'wwIPK', 'wwPredikatId', 'wwScoreToefl', 'wwSapsPredikat', 'wwSapsLamp', 'wwOrtuAyah', 'wwOrtuIbu', 'wwWpId', 'wwCreate'], 'safe'],
                [['wwJenkel', 'wwAlamat', 'wwIsBidikmisi', 'wwJudulTa', 'wwIsSetuju'], 'string'],
                [['wwIsNoTa', 'wwTglLahir', 'wwTglMulaiBimb', 'wwTglSelesaiBimb', 'wwTglLulus', 'wwConfirmed', 'wwIjazahPreviewed', 'wwTglSetuju', 'wwCreate', 'pembimbing', 'wwGlrDepan', 'wwGlrBelakang', 'wwMengetahuiNama', 'wwMengetahuiNip', 'wwMengetahuiJab', 'wwAnDekan'], 'safe'],
                [['wwKabId', 'wwAngkatan', 'wwModelrId', 'wwLamaStudiThn', 'wwLamaStudiBln', 'wwThnWisuda', 'wwPredikatId', 'wwScoreToefl', 'wwWpId'], 'integer'],
                [['wwIPK'], 'number'],
                [['wwTurnitinSimilar','wwTurnitinLamp','wwRepositoryLink','wwJurnalNama','wwJurnalLink','wwJurnalLampSk','wwJurnalVerifikasiTgl','wwJurnalVerifikasiStatus','wwJurnalVerifikasiKet'],'safe'],
                [['wwNim'], 'string', 'max' => 15],
                [['wwNoAlumni', 'wwIdSkripsi'], 'string', 'max' => 50],
                [['wwNama', 'wwProgKekhususan'], 'string', 'max' => 200],
                [['wwTmpLahir', 'wwEmail', 'wwPendTerakhir', 'wwOrtuAyah', 'wwOrtuIbu'], 'string', 'max' => 150],
                [['wwHp'], 'string', 'max' => 30],
                [['wwProdiKode'], 'string', 'max' => 10],
                [['wwJenKode', 'wwJalurId'], 'string', 'max' => 20],
                [['wwJalurNama', 'wwSapsPredikat'], 'string', 'max' => 100],
                [['wwNim'], 'unique'],
                [['wwSapsLamp','wwJurnalLampSk','wwTurnitinLamp'], 'file', 'extensions' => 'pdf', 'maxSize' => 202400],
                [['wwFoto'], 'file', 'extensions' => 'jpg,jpeg,png', 'maxSize' => 202400],
                [['wwNim'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaUser::className(), 'targetAttribute' => ['wwNim' => 'wuNim']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'wwNim' => 'Ww Nim',
            'wwNoAlumni' => 'Ww No Alumni',
            'wwIdSkripsi' => 'Ww Id Skripsi',
            'wwNama' => 'Ww Nama',
            'wwGlrDepan' => 'Gelar Depan',
            'wwGlrBelakang' => 'Gelar Belakang',
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
            'wwDosenPa'=>'Dosen Pembimbing Akademik',
            'wwJudulTa' => 'Ww Judul Ta',
            'wwIsNoTa' => 'Tanpa Tugas Akhir?',
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
            'wwTurnitinSimilar'=>'Index Kesamaan (%)',
            'wwTurnitinLamp'=>'Lampiran Hasil Turnitin',
            'wwRepositoryLink'=>'Link Repository Unand',
            'wwJurnalNama'=>'Nama Jurnal',
            'wwJurnalLink'=>'Link Jurnal',
            'wwJurnalLampSk'=>'Lampiran Surat Pernyataan Keabsahan Artikel',
            'wwJurnalVerifikasiTgl'=>'Tanggal Verifikasi',
            'wwJurnalVerifikasiStatus'=>'Status Verifikasi',
            'wwJurnalVerifikasiKet'=>'Keterangan',
            'wwOrtuAyah' => 'Ww Ortu Ayah',
            'wwOrtuIbu' => 'Ww Ortu Ibu',
            'wwFoto' => 'Ww Foto',
            'wwWpId' => 'Ww Wp ID',
            'wwConfirmed' => 'Ww Confirmed',
            'wwIjazahPreviewed' => 'Ww Ijazah Previewed',
            'wwIsSetuju' => 'Ww Is Setuju',
            'wwTglSetuju' => 'Ww Tgl Setuju',
            'wwMengetahuiNama' => 'Nama Yang Mengetahui',
            'wwMengetahuiNip' => 'NIP Yang Mengetahui',
            'wwMengetahuiJab' => 'Jabatan Yang Mengetahui',
            'wwAnDekan' => 'An.Dekan?',
            'wwCreate' => 'Ww Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWwNim0() {
        return $this->hasOne(WisudaUser::className(), ['wuNim' => 'wwNim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWwWp() {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'wwWpId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaWisudawanPembimbings() {
        return $this->hasMany(WisudaWisudawanPembimbing::className(), ['pbbWwNim' => 'wwNim']);
    }

}
