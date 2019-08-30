<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_user".
 *
 * @property string $wuNim
 * @property string $wuPassword
 * @property string $wuNama
 * @property int $wuFakId
 * @property string $wuProdiKode
 * @property string $wuIsAkunPortal
 * @property string $wuCreate
 * @property string $wuUpdate
 *
 * @property InvoiceBank[] $invoiceBanks
 * @property WisudaWisudawan $wisudaWisudawan
 */
class WisudaUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wuNim', 'wuPassword', 'wuNama', 'wuProdiKode', 'wuCreate'], 'required'],
            [['wuFakId'], 'integer'],
            [['wuIsAkunPortal'], 'string'],
            [['wuCreate', 'wuUpdate'], 'safe'],
            [['wuNim'], 'string', 'max' => 15],
            [['wuPassword'], 'string', 'max' => 32],
            [['wuNama'], 'string', 'max' => 200],
            [['wuProdiKode'], 'string', 'max' => 10],
            [['wuNim'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wuNim' => 'Wu Nim',
            'wuPassword' => 'Wu Password',
            'wuNama' => 'Wu Nama',
            'wuFakId' => 'Wu Fak ID',
            'wuProdiKode' => 'Wu Prodi Kode',
            'wuIsAkunPortal' => 'Wu Is Akun Portal',
            'wuCreate' => 'Wu Create',
            'wuUpdate' => 'Wu Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceBanks()
    {
        return $this->hasMany(InvoiceBank::className(), ['invoiceNim' => 'wuNim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaWisudawan()
    {
        return $this->hasOne(WisudaWisudawan::className(), ['wwNim' => 'wuNim']);
    }
}
