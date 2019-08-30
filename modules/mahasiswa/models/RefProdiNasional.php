<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_prodi_nasional".
 *
 * @property string $prodiKode
 * @property string $prodiNama
 * @property string $prodiJenjang
 * @property int $prodiFakId
 * @property string $prodiStatus
 *
 * @property RefFakultas $prodiFak
 * @property RefJenjang $prodiJenjang0
 */
class RefProdiNasional extends \yii\db\ActiveRecord {
    
    public $fakNama;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ref_prodi_nasional';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['prodiKode', 'prodiNama', 'prodiJenjang', 'prodiFakId', 'prodiStatus'], 'required'],
                [['prodiFakId'], 'integer'],
                [['prodiStatus'], 'string'],
                [['prodiKode'], 'string', 'max' => 10],
                [['prodiNama'], 'string', 'max' => 200],
                [['prodiJenjang'], 'string', 'max' => 15],
                [['prodiKode'], 'unique'],
                [['prodiFakId'], 'exist', 'skipOnError' => true, 'targetClass' => RefFakultas::className(), 'targetAttribute' => ['prodiFakId' => 'fakId']],
                [['prodiJenjang'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenjang::className(), 'targetAttribute' => ['prodiJenjang' => 'jenKode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'prodiKode' => 'Prodi Kode',
            'prodiNama' => 'Prodi Nama',
            'prodiJenjang' => 'Prodi Jenjang',
            'prodiFakId' => 'Prodi Fak ID',
            'prodiStatus' => 'Prodi Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdiFak() {
        return $this->hasOne(RefFakultas::className(), ['fakId' => 'prodiFakId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdiJenjang0() {
        return $this->hasOne(RefJenjang::className(), ['jenKode' => 'prodiJenjang']);
    }

}
