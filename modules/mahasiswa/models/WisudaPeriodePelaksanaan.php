<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_periode_pelaksanaan".
 *
 * @property int $wppId
 * @property int $wppWpId
 * @property string $wppTgl
 * @property string $wppTglTerbilang
 * @property string $wppCreate
 * @property string $wppUpdate
 *
 * @property WisudaPeriode $wppWp
 * @property WisudaPeriodePelaksanaanJenjang[] $wisudaPeriodePelaksanaanJenjangs
 * @property RefJenjang[] $wppjJenKodes
 */
class WisudaPeriodePelaksanaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_periode_pelaksanaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wppWpId', 'wppTgl', 'wppTglTerbilang', 'wppCreate'], 'required'],
            [['wppWpId'], 'integer'],
            [['wppTgl', 'wppCreate', 'wppUpdate'], 'safe'],
            [['wppTglTerbilang'], 'string', 'max' => 200],
            [['wppWpId'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaPeriode::className(), 'targetAttribute' => ['wppWpId' => 'wpId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wppId' => 'Wpp ID',
            'wppWpId' => 'Wpp Wp ID',
            'wppTgl' => 'Wpp Tgl',
            'wppTglTerbilang' => 'Wpp Tgl Terbilang',
            'wppCreate' => 'Wpp Create',
            'wppUpdate' => 'Wpp Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWppWp()
    {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'wppWpId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaPeriodePelaksanaanJenjangs()
    {
        return $this->hasMany(WisudaPeriodePelaksanaanJenjang::className(), ['wppjWppId' => 'wppId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWppjJenKodes()
    {
        return $this->hasMany(RefJenjang::className(), ['jenKode' => 'wppjJenKode'])->viaTable('wisuda_periode_pelaksanaan_jenjang', ['wppjWppId' => 'wppId']);
    }
}
