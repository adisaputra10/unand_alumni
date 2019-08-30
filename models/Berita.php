<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "berita".
 *
 * @property int $idBerita
 * @property string $beritaJudul
 * @property string $beritaKey
 * @property string $beritaRingkas
 * @property string $beritaIsi
 * @property string $beritaIsPublic
 * @property string $beritaWktPublic
 * @property string $beritaTglEntri
 * @property int $beritaIdUser
 */
class Berita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'berita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['beritaJudul', 'beritaKey', 'beritaRingkas', 'beritaIsi', 'beritaIdUser'], 'required'],
            [['beritaRingkas', 'beritaIsi', 'beritaIsPublic'], 'string'],
            [['beritaWktPublic', 'beritaTglEntri'], 'safe'],
            [['beritaIdUser'], 'integer'],
            [['beritaJudul', 'beritaKey'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idBerita' => 'Id Berita',
            'beritaJudul' => 'Berita Judul',
            'beritaKey' => 'Berita Key',
            'beritaRingkas' => 'Berita Ringkas',
            'beritaIsi' => 'Berita Isi',
            'beritaIsPublic' => 'Berita Is Public',
            'beritaWktPublic' => 'Berita Wkt Public',
            'beritaTglEntri' => 'Berita Tgl Entri',
            'beritaIdUser' => 'Berita Id User',
        ];
    }
}
