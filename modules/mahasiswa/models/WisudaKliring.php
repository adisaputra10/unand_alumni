<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_kliring".
 *
 * @property string $wkNim
 * @property string $wkNama
 * @property string $wkTglLahir
 * @property string $wkJenkel
 * @property string $wkAngkatan
 * @property string $wkProdiKode
 * @property string $wkJenKode
 * @property int $wkWpId
 * @property string $wkStatus
 * @property string $wkPetugas
 * @property string $wkTglKliring
 * @property string $wkCreate
 * @property string $wkUpdate
 *
 * @property RefJenjang $wkJenKode0
 * @property RefProdiNasional $wkProdiKode0
 * @property WisudaPeriode $wkWp
 * @property WisudaKliringItem[] $wisudaKliringItems
 * @property RefKliring[] $wkiKlirings
 */
class WisudaKliring extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_kliring';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wkNim', 'wkNama', 'wkTglLahir', 'wkJenkel', 'wkAngkatan', 'wkProdiKode', 'wkJenKode', 'wkCreate'], 'required'],
            [['wkTglLahir', 'wkTglKliring', 'wkCreate', 'wkUpdate'], 'safe'],
            [['wkJenkel', 'wkStatus'], 'string'],
            [['wkWpId'], 'integer'],
            [['wkNim'], 'string', 'max' => 15],
            [['wkNama', 'wkPetugas'], 'string', 'max' => 150],
            [['wkAngkatan'], 'string', 'max' => 4],
            [['wkProdiKode'], 'string', 'max' => 10],
            [['wkJenKode'], 'string', 'max' => 20],
            [['wkNim'], 'unique'],
            [['wkJenKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenjang::className(), 'targetAttribute' => ['wkJenKode' => 'jenKode']],
            [['wkProdiKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefProdiNasional::className(), 'targetAttribute' => ['wkProdiKode' => 'prodiKode']],
            [['wkWpId'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaPeriode::className(), 'targetAttribute' => ['wkWpId' => 'wpId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wkNim' => 'Wk Nim',
            'wkNama' => 'Wk Nama',
            'wkTglLahir' => 'Wk Tgl Lahir',
            'wkJenkel' => 'Wk Jenkel',
            'wkAngkatan' => 'Wk Angkatan',
            'wkProdiKode' => 'Wk Prodi Kode',
            'wkJenKode' => 'Wk Jen Kode',
            'wkWpId' => 'Wk Wp ID',
            'wkStatus' => 'Wk Status',
            'wkPetugas' => 'Wk Petugas',
            'wkTglKliring' => 'Wk Tgl Kliring',
            'wkCreate' => 'Wk Create',
            'wkUpdate' => 'Wk Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkJenKode0()
    {
        return $this->hasOne(RefJenjang::className(), ['jenKode' => 'wkJenKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkProdiKode0()
    {
        return $this->hasOne(RefProdiNasional::className(), ['prodiKode' => 'wkProdiKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkWp()
    {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'wkWpId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaKliringItems()
    {
        return $this->hasMany(WisudaKliringItem::className(), ['wkiWkNim' => 'wkNim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkiKlirings()
    {
        return $this->hasMany(RefKliring::className(), ['kliringId' => 'wkiKliringId'])->viaTable('wisuda_kliring_item', ['wkiWkNim' => 'wkNim']);
    }
}
