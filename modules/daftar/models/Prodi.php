<?php

namespace app\modules\daftar\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property string $idprodi
 * @property string $idfak
 * @property string $namaprodi
 *
 * @property Fakultas $fak
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idprodi'], 'required'],
            [['idprodi', 'idfak'], 'string', 'max' => 100],
            [['namaprodi'], 'string', 'max' => 200],
            [['idprodi'], 'unique'],
            [['idfak'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['idfak' => 'idfk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idprodi' => 'Idprodi',
            'idfak' => 'Idfak',
            'namaprodi' => 'Namaprodi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFak()
    {
        return $this->hasOne(Fakultas::className(), ['idfk' => 'idfak']);
    }
}
