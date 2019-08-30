<?php

namespace app\modules\daftar\models;

use Yii;

/**
 * This is the model class for table "tracerstudy".
 *
 * @property int $idtracer
 * @property string $idalumni
 * @property string $alamatemail
 * @property string $hp
 * @property int $tahunangkatan
 * @property int $tahunlulus
 * @property string $masatunggu
 * @property string $institusipertama
 * @property string $pekerjaanpertama
 * @property int $gajipertama
 * @property string $pekerjaanskrg
 * @property string $posisiskrg
 * @property int $gajiskrg
 * @property string $lokasiskrg
 * @property string $relevansiilmu
 * @property string $saran
 */
class Tracerstudy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tracerstudy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahunangkatan', 'tahunlulus', 'gajipertama', 'gajiskrg'], 'integer'],
            [['saran'], 'string'],
            [['idalumni', 'hp', 'masatunggu'], 'string', 'max' => 30],
            [['alamatemail'], 'string', 'max' => 50],
            [['institusipertama', 'pekerjaanpertama', 'pekerjaanskrg', 'posisiskrg', 'lokasiskrg', 'relevansiilmu'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtracer' => 'ID Tracer',
            'idalumni' => 'No. Alumni',
            'alamatemail' => 'Email',
            'hp' => 'No. HP',
            'tahunangkatan' => 'Tahun Angkatan Masuk',
            'tahunlulus' => 'Tahun Lulus',
            'masatunggu' => 'Lama Masa Tunggu Kerja Setelah Wisuda (Tahun dan Bulan)',
            'institusipertama' => 'Institusi Pekerjaan Pertama Setelah Lulus',
            'pekerjaanpertama' => 'Posisi Pekerjaan Pertama',
            'gajipertama' => 'Jumlah Gaji Pertama',
            'pekerjaanskrg' => 'Pekerjaan Sekarang',
            'posisiskrg' => 'Posisi Pekerjaan Sekarang',
            'gajiskrg' => 'Jumlah Gaji Sekarang ',
            'lokasiskrg' => 'Lokasi Pekerjaan sekarang',
            'relevansiilmu' => 'Relevansi Ilmu Pekerjaan',
            'saran' => 'Saran Terhadap Kampus',
        ];
    }
}
