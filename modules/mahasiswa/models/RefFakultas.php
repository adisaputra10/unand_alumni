<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_fakultas".
 *
 * @property int $fakId
 * @property string $fakNama
 * @property string $fakCreate
 * @property string $fakUpdate
 *
 * @property AppUserData[] $appUserDatas
 * @property AppUser[] $users
 * @property RefProdiNasional[] $refProdiNasionals
 */
class RefFakultas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_fakultas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fakId', 'fakNama', 'fakCreate'], 'required'],
            [['fakId'], 'integer'],
            [['fakCreate', 'fakUpdate'], 'safe'],
            [['fakNama'], 'string', 'max' => 200],
            [['fakId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fakId' => 'Fak ID',
            'fakNama' => 'Fak Nama',
            'fakCreate' => 'Fak Create',
            'fakUpdate' => 'Fak Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppUserDatas()
    {
        return $this->hasMany(AppUserData::className(), ['unitId' => 'fakId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(AppUser::className(), ['idUser' => 'idUser'])->viaTable('app_user_data', ['unitId' => 'fakId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProdiNasionals()
    {
        return $this->hasMany(RefProdiNasional::className(), ['prodiFakId' => 'fakId']);
    }
}
