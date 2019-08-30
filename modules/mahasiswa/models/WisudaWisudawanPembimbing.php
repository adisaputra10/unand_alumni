<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "wisuda_wisudawan_pembimbing".
 *
 * @property int $pbbId
 * @property string $pbbWwNim
 * @property string $pbbNama
 * @property string $pbbKet
 * @property string $pbbCreate
 *
 * @property WisudaWisudawan $pbbWwNim0
 */
class WisudaWisudawanPembimbing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wisuda_wisudawan_pembimbing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pbbWwNim', 'pbbNama', 'pbbKet', 'pbbCreate'], 'required'],
            [['pbbCreate'], 'safe'],
            [['pbbWwNim'], 'string', 'max' => 15],
            [['pbbNama', 'pbbKet'], 'string', 'max' => 150],
            [['pbbWwNim'], 'exist', 'skipOnError' => true, 'targetClass' => WisudaWisudawan::className(), 'targetAttribute' => ['pbbWwNim' => 'wwNim']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pbbId' => 'Pbb ID',
            'pbbWwNim' => 'Pbb Ww Nim',
            'pbbNama' => 'Pbb Nama',
            'pbbKet' => 'Pbb Ket',
            'pbbCreate' => 'Pbb Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPbbWwNim0()
    {
        return $this->hasOne(WisudaWisudawan::className(), ['wwNim' => 'pbbWwNim']);
    }
}
