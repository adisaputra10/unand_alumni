<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_alumni".
 *
 * @property string $waNim
 * @property string $waNoAlumni
 * @property string $waNama
 * @property string $waProdiKode
 * @property int $waWpId
 * @property string $waCreate
 *
 * @property RefProdiNasional $waProdiKode0
 * @property WisudaPeriode $waWp
 */
class WisudaAlumni extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_alumni';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waNim', 'waNoAlumni', 'waNama', 'waProdiKode', 'waWpId', 'waCreate'], 'required'],
            [['waWpId'], 'integer'],
            [['waCreate'], 'safe'],
            [['waNim'], 'string', 'max' => 15],
            [['waNoAlumni'], 'string', 'max' => 50],
            [['waNama'], 'string', 'max' => 200],
            [['waProdiKode'], 'string', 'max' => 10],
            [['waNim'], 'unique'],
            [['waProdiKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefProdiNasional::className(), 'targetAttribute' => ['waProdiKode' => 'prodiKode']],
            [['waWpId'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaPeriode::className(), 'targetAttribute' => ['waWpId' => 'wpId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'waNim' => 'Wa Nim',
            'waNoAlumni' => 'Wa No Alumni',
            'waNama' => 'Wa Nama',
            'waProdiKode' => 'Wa Prodi Kode',
            'waWpId' => 'Wa Wp ID',
            'waCreate' => 'Wa Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaProdiKode0()
    {
        return $this->hasOne(RefProdiNasional::className(), ['prodiKode' => 'waProdiKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaWp()
    {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'waWpId']);
    }
}
