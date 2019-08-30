<?php

namespace app\modules\daftar\models;

use Yii;

/**
 * This is the model class for table "identitasalumni".
 *
 * @property string $idalumni
 * @property string $username
 * @property string $password
 * @property string $namalengkap
 * @property string $nim
 * @property string $tgllahir
 * @property string $idprodi
 * @property int $angkatan
 * @property int $tahunlulus
 * @property string $tgllulus
 * @property string $tglwisuda
 * @property string $email
 * @property string $nohp
 * @property string $alamatrumah
 * @property string $namaperusahaan
 * @property string $posisipekerjaan
 * @property string $alamatperusahaan
 * @property string $emailperusahaan
 * @property string $bidangperusahaan
 * @property string $riwayatperusahaan
 * @property string $foto
 */
class Identitasalumni extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identitasalumni';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idalumni'], 'required'],
            [['tgllahir', 'tgllulus', 'tglwisuda'], 'safe'],
            [['angkatan', 'tahunlulus'], 'integer'],
            [['alamatrumah', 'alamatperusahaan', 'riwayatperusahaan'], 'string'],
            [['idalumni', 'namalengkap', 'email'], 'string', 'max' => 50],
            [['username', 'password'], 'string'],
            [['nim'], 'string', 'max' => 15],
            [['idprodi', 'namaperusahaan', 'posisipekerjaan', 'emailperusahaan', 'bidangperusahaan', 'foto'], 'string', 'max' => 100],
            [['nohp'], 'string', 'max' => 20],
            [['idalumni'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idalumni' => 'Nomor Alumni',
            'username' => 'Username',
            'password' => 'Password',
            'namalengkap' => 'Nama Lengkap',
            'nim' => 'NO.BP / NIM',
            'tgllahir' => 'Tgl Lahir',
            'idprodi' => ' Prodi',
            'angkatan' => 'Angkatan',
            'tahunlulus' => 'Tahun Lulus',
            'tgllulus' => 'Tgl Lulus',
            'tglwisuda' => 'Tgl Wisuda',
            'email' => 'Email',
            'nohp' => 'Nohp',
            'alamatrumah' => 'Alamat Rumah',
            'namaperusahaan' => 'Nama Perusahaan',
            'posisipekerjaan' => 'Posisi Pekerjaan',
            'alamatperusahaan' => 'Alamat Perusahaan',
            'emailperusahaan' => 'Email Perusahaan',
            'bidangperusahaan' => 'Bidang Perusahaan',
            'riwayatperusahaan' => 'Riwayat Perusahaan',
            'foto' => 'Foto',
        ];
    }
}
