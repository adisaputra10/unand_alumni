<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "agenda1".
 *
 * @property string $id
 * @property string $nama
 * @property string $foto
 * @property string $keterangan
 */
class Agenda1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan'], 'string'],
            [['id', 'nama', 'foto'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'foto' => 'Foto',
            'keterangan' => 'Keterangan',
        ];
    }
}
