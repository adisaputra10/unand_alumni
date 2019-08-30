<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_service".
 *
 * @property string $wsID
 * @property string $wsAddress
 * @property string $wsCreateDate
 */
class AppService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wsID', 'wsAddress'], 'required'],
            [['wsCreateDate'], 'safe'],
            [['wsID'], 'string', 'max' => 25],
            [['wsAddress'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wsID' => 'Ws ID',
            'wsAddress' => 'Ws Address',
            'wsCreateDate' => 'Ws Create Date',
        ];
    }
}
