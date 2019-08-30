<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_bank".
 *
 * @property string $bankId
 * @property string $bankNama
 * @property string $bankInfo
 * @property string $bankCreate
 * @property string $bankUpdate
 *
 * @property InvoiceBank[] $invoiceBanks
 */
class RefBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bankId', 'bankNama', 'bankCreate'], 'required'],
            [['bankInfo'], 'string'],
            [['bankCreate', 'bankUpdate'], 'safe'],
            [['bankId'], 'string', 'max' => 10],
            [['bankNama'], 'string', 'max' => 200],
            [['bankId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bankId' => 'Bank ID',
            'bankNama' => 'Bank Nama',
            'bankInfo' => 'Bank Info',
            'bankCreate' => 'Bank Create',
            'bankUpdate' => 'Bank Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceBanks()
    {
        return $this->hasMany(InvoiceBank::className(), ['invoiceBankId' => 'bankId']);
    }
}
