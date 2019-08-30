<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_predikat".
 *
 * @property int $predikatId
 * @property string $predikatNama
 * @property string $predikatNamaAsing
 * @property string $predikatCreate
 * @property string $predikatUpdate
 */
class RefPredikat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_predikat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['predikatNama', 'predikatNamaAsing', 'predikatCreate'], 'required'],
            [['predikatCreate', 'predikatUpdate'], 'safe'],
            [['predikatNama', 'predikatNamaAsing'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'predikatId' => 'Predikat ID',
            'predikatNama' => 'Predikat Nama',
            'predikatNamaAsing' => 'Predikat Nama Asing',
            'predikatCreate' => 'Predikat Create',
            'predikatUpdate' => 'Predikat Update',
        ];
    }
}
