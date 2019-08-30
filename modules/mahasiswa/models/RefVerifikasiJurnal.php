<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_verifikasi_jurnal".
 *
 * @property int $vjWpId
 * @property string $vjJenKode
 * @property string $vjProdiKode
 *
 * @property RefJenjang $vjJenKode0
 * @property WisudaPeriode $vjWp
 * @property RefProdiNasional $vjProdiKode0
 */
class RefVerifikasiJurnal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_verifikasi_jurnal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vjWpId', 'vjJenKode', 'vjProdiKode'], 'required'],
            [['vjWpId'], 'integer'],
            [['vjJenKode'], 'string', 'max' => 20],
            [['vjProdiKode'], 'string', 'max' => 10],
            [['vjWpId', 'vjJenKode', 'vjProdiKode'], 'unique', 'targetAttribute' => ['vjWpId', 'vjJenKode', 'vjProdiKode']],
            [['vjJenKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenjang::className(), 'targetAttribute' => ['vjJenKode' => 'jenKode']],
            [['vjWpId'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaPeriode::className(), 'targetAttribute' => ['vjWpId' => 'wpId']],
            [['vjProdiKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefProdiNasional::className(), 'targetAttribute' => ['vjProdiKode' => 'prodiKode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vjWpId' => 'Vj Wp ID',
            'vjJenKode' => 'Vj Jen Kode',
            'vjProdiKode' => 'Vj Prodi Kode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVjJenKode0()
    {
        return $this->hasOne(RefJenjang::className(), ['jenKode' => 'vjJenKode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVjWp()
    {
        return $this->hasOne(WisudaPeriode::className(), ['wpId' => 'vjWpId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVjProdiKode0()
    {
        return $this->hasOne(RefProdiNasional::className(), ['prodiKode' => 'vjProdiKode']);
    }
}
