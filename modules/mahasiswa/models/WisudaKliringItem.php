<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_kliring_item".
 *
 * @property string $wkiWkNim
 * @property int $wkiKliringId
 *
 * @property RefKliring $wkiKliring
 * @property WisudaKliring $wkiWkNim0
 */
class WisudaKliringItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_kliring_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wkiWkNim', 'wkiKliringId'], 'required'],
            [['wkiKliringId'], 'integer'],
            [['wkiWkNim'], 'string', 'max' => 15],
            [['wkiWkNim', 'wkiKliringId'], 'unique', 'targetAttribute' => ['wkiWkNim', 'wkiKliringId']],
            [['wkiKliringId'], 'exist', 'skipOnError' => true, 'targetClass' => RefKliring::className(), 'targetAttribute' => ['wkiKliringId' => 'kliringId']],
            [['wkiWkNim'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaKliring::className(), 'targetAttribute' => ['wkiWkNim' => 'wkNim']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wkiWkNim' => 'Wki Wk Nim',
            'wkiKliringId' => 'Wki Kliring ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkiKliring()
    {
        return $this->hasOne(RefKliring::className(), ['kliringId' => 'wkiKliringId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkiWkNim0()
    {
        return $this->hasOne(WisudaKliring::className(), ['wkNim' => 'wkiWkNim']);
    }
}
