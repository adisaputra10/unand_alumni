<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_periode".
 *
 * @property int $wpId
 * @property string $wpNama
 * @property string $wpTahun 
 * @property string $wpTglBuka
 * @property string $wpTglTutup
 * @property string $wpIsAktif
 * @property string $wpRektor
 * @property string $wpCreate
 * @property string $wpUpdate
 *
 * @property WisudaPeriodePelaksanaan[] $wisudaPeriodePelaksanaans
 */
class WisudaPeriode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_periode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wpNama','wpTahun', 'wpTglBuka', 'wpTglTutup', 'wpRektor', 'wpCreate'], 'required'],
            [['wpTglBuka', 'wpTglTutup', 'wpCreate', 'wpUpdate'], 'safe'],
            [['wpIsAktif'], 'string'],
            [['wpNama'], 'string', 'max' => 100],
            [['wpRektor'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wpId' => 'Wp ID',
            'wpNama' => 'Wp Nama',
            'wpTahun'=>'Wp Tahun',
            'wpTglBuka' => 'Wp Tgl Buka',
            'wpTglTutup' => 'Wp Tgl Tutup',
            'wpIsAktif' => 'Wp Is Aktif',
            'wpRektor' => 'Wp Rektor',
            'wpCreate' => 'Wp Create',
            'wpUpdate' => 'Wp Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaPeriodePelaksanaans()
    {
        return $this->hasMany(WisudaPeriodePelaksanaan::className(), ['wppWpId' => 'wpId']);
    }
}
