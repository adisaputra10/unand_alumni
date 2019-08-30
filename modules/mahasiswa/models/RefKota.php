<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_kota".
 *
 * @property int $kotaKode
 * @property string $kotaNamaResmi
 * @property int $kotaPropKode
 *
 * @property RefPropinsi $kotaPropKode0
 */
class RefKota extends \yii\db\ActiveRecord {

    public $propNama;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ref_kota';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['kotaKode'], 'required'],
                [['kotaKode', 'kotaPropKode'], 'integer'],
                [['kotaNamaResmi'], 'string', 'max' => 255],
                [['kotaKode'], 'unique'],
                [['kotaPropKode'], 'exist', 'skipOnError' => true, 'targetClass' => RefPropinsi::className(), 'targetAttribute' => ['kotaPropKode' => 'propKode']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'kotaKode' => 'Kota Kode',
            'kotaNamaResmi' => 'Kota Nama Resmi',
            'kotaPropKode' => 'Kota Prop Kode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKotaPropKode0() {
        return $this->hasOne(RefPropinsi::className(), ['propKode' => 'kotaPropKode']);
    }

}
