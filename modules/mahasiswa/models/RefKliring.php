<?php

namespace app\modules\mahasiswa\models;

use Yii;

/**
 * This is the model class for table "ref_kliring".
 *
 * @property int $kliringId
 * @property string $kliringItem
 * @property string $kliringPetunjuk
 * @property string $kliringIsAktif
 * @property string $kliringSrcKey
 * @property string $kliringCreate
 * @property string $kliringUpdate
 *
 * @property RefKliringJenjang[] $refKliringJenjangs
 * @property RefJenjang[] $kliringJenKodes
 * @property WisudaKliringItem[] $wisudaKliringItems
 * @property WisudaKliring[] $wkiWkNims
 */
class RefKliring extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'ref_kliring';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['kliringItem', 'kliringPetunjuk', 'kliringCreate'], 'required'],
                [['kliringPetunjuk', 'kliringIsAktif'], 'string'],
                [['kliringCreate', 'kliringUpdate'], 'safe'],
                [['kliringItem'], 'string', 'max' => 250],
                [['kliringSrcKey'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'kliringId' => 'Kliring ID',
            'kliringItem' => 'Kliring Item',
            'kliringPetunjuk' => 'Kliring Petunjuk',
            'kliringIsAktif' => 'Kliring Is Aktif',
            'kliringSrcKey' => 'Kliring Src Key',
            'kliringCreate' => 'Kliring Create',
            'kliringUpdate' => 'Kliring Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKliringJenjangs() {
        return $this->hasMany(RefKliringJenjang::className(), ['kliringId' => 'kliringId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKliringJenKodes() {
        return $this->hasMany(RefJenjang::className(), ['jenKode' => 'kliringJenKode'])->viaTable('ref_kliring_jenjang', ['kliringId' => 'kliringId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWisudaKliringItems() {
        return $this->hasMany(WisudaKliringItem::className(), ['wkiKliringId' => 'kliringId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkiWkNims() {
        return $this->hasMany(WisudaKliring::className(), ['wkNim' => 'wkiWkNim'])->viaTable('wisuda_kliring_item', ['wkiKliringId' => 'kliringId']);
    }

    public function getKliringItem($id) {
        $query = $this->find();
        $query->join('JOIN', 'wisuda_kliring_item', 'wkiKliringId=kliringId');
        $query->where("wkiWkNim=:nim", [':nim' => $id]);
        $arr = [];
        foreach ($query->each() as $val) {
            $arr[] = $val['kliringId'];
        }
        return $arr;
    }

}
