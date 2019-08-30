<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_verifikasi_turnitin".
 *
 * @property int $vtWpId
 * @property string $vtJenKode
 * @property string $vtProdiKode
 * @property int $vtIndexKesamaan
 *
 * @property RefJenjang $vtJenKode0
 * @property RefProdiNasional $vtProdiKode0
 * @property WisudaPeriode $vtWp
 */
class RefVerifikasiTurnitin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_verifikasi_turnitin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vtWpId', 'vtJenKode', 'vtProdiKode', 'vtIndexKesamaan'], 'required'],
            [['vtWpId', 'vtIndexKesamaan'], 'integer'],
            [['vtJenKode'], 'string', 'max' => 20],
            [['vtProdiKode'], 'string', 'max' => 10],
            [['vtWpId', 'vtJenKode', 'vtProdiKode'], 'unique', 'targetAttribute' => ['vtWpId', 'vtJenKode', 'vtProdiKode']],
            [['vtJenKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenjang::className(), 'targetAttribute' => ['vtJenKode' => 'jenKode']],
            [['vtProdiKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefProdiNasional::className(), 'targetAttribute' => ['vtProdiKode' => 'prodiKode']],
            [['vtWpId'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaPeriode::className(), 'targetAttribute' => ['vtWpId' => 'wpId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vtWpId' => 'Vt Wp ID',
            'vtJenKode' => 'Vt Jen Kode',
            'vtProdiKode' => 'Vt Prodi Kode',
            'vtIndexKesamaan' => 'Vt Index Kesamaan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtJenKode0()
    {
        return $this->hasOne(RefJenjang::className(), ['jenKode' => 'vtJenKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtProdiKode0()
    {
        return $this->hasOne(RefProdiNasional::className(), ['prodiKode' => 'vtProdiKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVtWp()
    {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'vtWpId']);
    }
}
