<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_jadwal_kelas".
 *
 * @property int $idJdwlKelas
 * @property int $idJenTes
 * @property string $jdwlNama
 * @property string $jdwlTanggal
 * @property string $jdwlMulai
 * @property string $jdwlSelesai
 * @property int $jdwlJmlMax
 * @property string $jdwlIsAktif
 * @property string $jdwlIsPreTest
 *
 * @property TestJadwalFakultas[] $testJadwalFakultas
 * @property RefJenisTest $jenTes
 * @property TestJadwalMember[] $testJadwalMembers
 * @property Member[] $members
 * @property TestPeserta[] $testPesertas
 */
class TestJadwalKelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_jadwal_kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idJenTes', 'jdwlNama', 'jdwlTanggal', 'jdwlMulai', 'jdwlSelesai', 'jdwlJmlMax'], 'required'],
            [['idJenTes', 'jdwlJmlMax'], 'integer'],
            [['jdwlTanggal', 'jdwlMulai', 'jdwlSelesai'], 'safe'],
            [['jdwlIsAktif', 'jdwlIsPreTest'], 'string'],
            [['jdwlNama'], 'string', 'max' => 50],
            [['idJenTes'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenisTest::className(), 'targetAttribute' => ['idJenTes' => 'idJenTes']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idJdwlKelas' => 'Id Jdwl Kelas',
            'idJenTes' => 'Id Jen Tes',
            'jdwlNama' => 'Jdwl Nama',
            'jdwlTanggal' => 'Jdwl Tanggal',
            'jdwlMulai' => 'Jdwl Mulai',
            'jdwlSelesai' => 'Jdwl Selesai',
            'jdwlJmlMax' => 'Jdwl Jml Max',
            'jdwlIsAktif' => 'Jdwl Is Aktif',
            'jdwlIsPreTest' => 'Jdwl Is Pre Test',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestJadwalFakultas()
    {
        return $this->hasMany(TestJadwalFakultas::className(), ['idJdwlKelas' => 'idJdwlKelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenTes()
    {
        return $this->hasOne(RefJenisTest::className(), ['idJenTes' => 'idJenTes']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestJadwalMembers()
    {
        return $this->hasMany(TestJadwalMember::className(), ['idJdwlKelas' => 'idJdwlKelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['memberId' => 'memberId'])->viaTable('test_jadwal_member', ['idJdwlKelas' => 'idJdwlKelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestPesertas()
    {
        return $this->hasMany(TestPeserta::className(), ['idJdwlKelas' => 'idJdwlKelas']);
    }
}
