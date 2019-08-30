<?php

namespace app\modules\daftar\models;

use Yii;

/**
 * This is the model class for table "fakultas".
 *
 * @property string $idfk
 * @property string $namafk
 *
 * @property Prodi[] $prodis
 */
class Fakultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fakultas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfk'], 'required'],
            [['idfk'], 'string', 'max' => 100],
            [['namafk'], 'string', 'max' => 200],
            [['idfk'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfk' => 'Idfk',
            'namafk' => 'Namafk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdis()
    {
        return $this->hasMany(Prodi::className(), ['idfak' => 'idfk']);
    }
}
