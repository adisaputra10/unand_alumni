<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_user_data".
 *
 * @property integer $idUser
 * @property integer $idUnit
 *
 * @property UnitKerja $idUnit0
 * @property AppUser $idUser0
 */
class AppUserData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_user_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'idFak'], 'required'],
            [['idUser', 'idFak'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'idFak' => 'Id Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFak0()
    {
        return $this->hasOne(RefFakultas::className(), ['idFak' => 'idFak']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(AppUser::className(), ['idUser' => 'idUser']);
    }
}
