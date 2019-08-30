<?php

namespace app\modules\daftar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\daftar\models\WisudaWisudawan;

/**
 * WisudaWisudawanSearch represents the model behind the search form of `app\modules\daftar\models\WisudaWisudawan`.
 */
class WisudaWisudawanSearch extends WisudaWisudawan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wwNim', 'wwNoAlumni', 'wwIdSkripsi', 'wwNik', 'wwNama', 'wwGlrDepan', 'wwGlrBelakang', 'wwJenkel', 'wwTmpLahir', 'wwTglLahir', 'wwTglLahirText', 'wwEmail', 'wwHp', 'wwAlamat', 'wwPendTerakhir', 'wwProdiKode', 'wwProgKekhususan', 'wwJenKode', 'wwJalurId', 'wwJalurNama', 'wwIsBidikmisi', 'wwDosenPa', 'wwJudulTa', 'wwIsNoTa', 'wwTglMulaiBimb', 'wwTglSelesaiBimb', 'wwTglLulus', 'wwSapsPredikat', 'wwSapsLamp', 'wwTurnitinLamp', 'wwRepositoryLink', 'wwJurnalNama', 'wwJurnalLink', 'wwJurnalLampSk', 'wwJurnalVerifikasiTgl', 'wwJurnalVerifikasiStatus', 'wwJurnalVerifikasiKet', 'wwOrtuAyah', 'wwOrtuIbu', 'wwFoto', 'wwConfirmed', 'wwIjazahPreviewed', 'wwIsSetuju', 'wwTglSetuju', 'wwMengetahuiNama', 'wwMengetahuiNip', 'wwMengetahuiJab', 'wwAnDekan', 'wwCreate'], 'safe'],
            [['wwKabId', 'wwAngkatan', 'wwModelrId', 'wwLamaStudiThn', 'wwLamaStudiBln', 'wwThnWisuda', 'wwPredikatId', 'wwScoreToefl', 'wwWpId'], 'integer'],
            [['wwIPK', 'wwTurnitinSimilar'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = WisudaWisudawan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'wwTglLahir' => $this->wwTglLahir,
            'wwKabId' => $this->wwKabId,
            'wwAngkatan' => $this->wwAngkatan,
            'wwModelrId' => $this->wwModelrId,
            'wwTglMulaiBimb' => $this->wwTglMulaiBimb,
            'wwTglSelesaiBimb' => $this->wwTglSelesaiBimb,
            'wwLamaStudiThn' => $this->wwLamaStudiThn,
            'wwLamaStudiBln' => $this->wwLamaStudiBln,
            'wwThnWisuda' => $this->wwThnWisuda,
            'wwTglLulus' => $this->wwTglLulus,
            'wwIPK' => $this->wwIPK,
            'wwPredikatId' => $this->wwPredikatId,
            'wwScoreToefl' => $this->wwScoreToefl,
            'wwTurnitinSimilar' => $this->wwTurnitinSimilar,
            'wwJurnalVerifikasiTgl' => $this->wwJurnalVerifikasiTgl,
            'wwWpId' => $this->wwWpId,
            'wwConfirmed' => $this->wwConfirmed,
            'wwIjazahPreviewed' => $this->wwIjazahPreviewed,
            'wwTglSetuju' => $this->wwTglSetuju,
            'wwCreate' => $this->wwCreate,
        ]);

        $query->andFilterWhere(['like', 'wwNim', $this->wwNim])
            ->andFilterWhere(['like', 'wwNoAlumni', $this->wwNoAlumni])
            ->andFilterWhere(['like', 'wwIdSkripsi', $this->wwIdSkripsi])
            ->andFilterWhere(['like', 'wwNik', $this->wwNik])
            ->andFilterWhere(['like', 'wwNama', $this->wwNama])
            ->andFilterWhere(['like', 'wwGlrDepan', $this->wwGlrDepan])
            ->andFilterWhere(['like', 'wwGlrBelakang', $this->wwGlrBelakang])
            ->andFilterWhere(['like', 'wwJenkel', $this->wwJenkel])
            ->andFilterWhere(['like', 'wwTmpLahir', $this->wwTmpLahir])
            ->andFilterWhere(['like', 'wwTglLahirText', $this->wwTglLahirText])
            ->andFilterWhere(['like', 'wwEmail', $this->wwEmail])
            ->andFilterWhere(['like', 'wwHp', $this->wwHp])
            ->andFilterWhere(['like', 'wwAlamat', $this->wwAlamat])
            ->andFilterWhere(['like', 'wwPendTerakhir', $this->wwPendTerakhir])
            ->andFilterWhere(['like', 'wwProdiKode', $this->wwProdiKode])
            ->andFilterWhere(['like', 'wwProgKekhususan', $this->wwProgKekhususan])
            ->andFilterWhere(['like', 'wwJenKode', $this->wwJenKode])
            ->andFilterWhere(['like', 'wwJalurId', $this->wwJalurId])
            ->andFilterWhere(['like', 'wwJalurNama', $this->wwJalurNama])
            ->andFilterWhere(['like', 'wwIsBidikmisi', $this->wwIsBidikmisi])
            ->andFilterWhere(['like', 'wwDosenPa', $this->wwDosenPa])
            ->andFilterWhere(['like', 'wwJudulTa', $this->wwJudulTa])
            ->andFilterWhere(['like', 'wwIsNoTa', $this->wwIsNoTa])
            ->andFilterWhere(['like', 'wwSapsPredikat', $this->wwSapsPredikat])
            ->andFilterWhere(['like', 'wwSapsLamp', $this->wwSapsLamp])
            ->andFilterWhere(['like', 'wwTurnitinLamp', $this->wwTurnitinLamp])
            ->andFilterWhere(['like', 'wwRepositoryLink', $this->wwRepositoryLink])
            ->andFilterWhere(['like', 'wwJurnalNama', $this->wwJurnalNama])
            ->andFilterWhere(['like', 'wwJurnalLink', $this->wwJurnalLink])
            ->andFilterWhere(['like', 'wwJurnalLampSk', $this->wwJurnalLampSk])
            ->andFilterWhere(['like', 'wwJurnalVerifikasiStatus', $this->wwJurnalVerifikasiStatus])
            ->andFilterWhere(['like', 'wwJurnalVerifikasiKet', $this->wwJurnalVerifikasiKet])
            ->andFilterWhere(['like', 'wwOrtuAyah', $this->wwOrtuAyah])
            ->andFilterWhere(['like', 'wwOrtuIbu', $this->wwOrtuIbu])
            ->andFilterWhere(['like', 'wwFoto', $this->wwFoto])
            ->andFilterWhere(['like', 'wwIsSetuju', $this->wwIsSetuju])
            ->andFilterWhere(['like', 'wwMengetahuiNama', $this->wwMengetahuiNama])
            ->andFilterWhere(['like', 'wwMengetahuiNip', $this->wwMengetahuiNip])
            ->andFilterWhere(['like', 'wwMengetahuiJab', $this->wwMengetahuiJab])
            ->andFilterWhere(['like', 'wwAnDekan', $this->wwAnDekan]);

        return $dataProvider;
    }
}
