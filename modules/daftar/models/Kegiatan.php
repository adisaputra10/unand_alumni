<?php

namespace app\modules\daftar\models;

use Yii;

/**
 * This is the model class for table "kegiatan".
 *
 * @property int $idkegiatan
 * @property string $nama
 * @property string $tglmulai
 * @property string $tglselesai
 * @property string $nosurat
 * @property string $ringkasan
 * @property string $tglsurat
 */
class Kegiatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kegiatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tglmulai', 'tglselesai', 'tglsurat'], 'safe'],
            [['ringkasan'], 'string'],
            [['nama'], 'string', 'max' => 50],
            [['nosurat'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
        //    'idkegiatan' => 'Idkegiatan',
            'nama' => 'Nama Kegiatan',
            'tglmulai' => 'Tanggal Mulai Pelaksanaan',
            'tglselesai' => 'Tanggal Selesai Pelaksanaan',
            'nosurat' => 'No Surat Kegiatan',
            'ringkasan' => 'Ringkasan Kegiatan',
            'tglsurat' => 'Tanggal Surat Masuk Kegiatan',
        ];
    }
}
