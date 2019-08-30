<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_jenjang".
 *
 * @property string $jenKode
 * @property string $jenNama
 * @property string $jenCreate
 * @property string $jenUpdate
 *
 * @property RefProdiNasional[] $refProdiNasionals
 * @property WisudaPeriodePelaksanaanJenjang[] $wisudaPeriodePelaksanaanJenjangs
 * @property WisudaPeriodePelaksanaan[] $wppjWpps
 */
class RefJenjang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_jenjang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenKode', 'jenNama', 'jenCreate'], 'required'],
            [['jenCreate', 'jenUpdate'], 'safe'],
            [['jenKode'], 'string', 'max' => 20],
            [['jenNama'], 'string', 'max' => 100],
            [['jenKode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jenKode' => 'Jen Kode',
            'jenNama' => 'Jen Nama',
            'jenCreate' => 'Jen Create',
            'jenUpdate' => 'Jen Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProdiNasionals()
    {
        return $this->hasMany(RefProdiNasional::className(), ['prodiJenjang' => 'jenKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaPeriodePelaksanaanJenjangs()
    {
        return $this->hasMany(WisudaPeriodePelaksanaanJenjang::className(), ['wppjJenKode' => 'jenKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWppjWpps()
    {
        return $this->hasMany(WisudaPeriodePelaksanaan::className(), ['wppId' => 'wppjWppId'])->viaTable('wisuda_periode_pelaksanaan_jenjang', ['wppjJenKode' => 'jenKode']);
    }
}
