<?php

namespace app\modules\mahasiswa\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\mahasiswa\models\WisudaWisudawan;

/**
 * WisudaWisudawanSearch represents the model behind the search form of `app\modules\mahasiswa\models\WisudaWisudawan`.
 */
class WisudaWisudawanSearch extends WisudaWisudawan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wwNim', 'wwNoAlumni', 'wwIdSkripsi', 'wwNama', 'wwJenkel', 'wwTmpLahir', 'wwTglLahir', 'wwEmail', 'wwHp', 'wwAlamat', 'wwPendTerakhir', 'wwProdiKode', 'wwProgKekhususan', 'wwJalur', 'wwIsBidikmisi', 'wwJudulTa', 'wwTglMulaiBimb', 'wwTglSelesaiBimb', 'wwPemb1', 'wwPemb2', 'wwPemb3', 'wwPemb4', 'wwPemb5', 'wwTglLulus', 'wwOrtuAyah', 'wwOrtuIbu'], 'safe'],
            [['wwKabId', 'wwAngkatan', 'wwLamaStudiThn', 'wwLamaStudiBln', 'wwThnWisuda', 'wwPredikatId', 'wwScoreToefl'], 'integer'],
            [['wwIPK'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
            'wwTglMulaiBimb' => $this->wwTglMulaiBimb,
            'wwTglSelesaiBimb' => $this->wwTglSelesaiBimb,
            'wwLamaStudiThn' => $this->wwLamaStudiThn,
            'wwLamaStudiBln' => $this->wwLamaStudiBln,
            'wwThnWisuda' => $this->wwThnWisuda,
            'wwTglLulus' => $this->wwTglLulus,
            'wwIPK' => $this->wwIPK,
            'wwPredikatId' => $this->wwPredikatId,
            'wwScoreToefl' => $this->wwScoreToefl,
        ]);

        $query->andFilterWhere(['like', 'wwNim', $this->wwNim])
            ->andFilterWhere(['like', 'wwNoAlumni', $this->wwNoAlumni])
            ->andFilterWhere(['like', 'wwIdSkripsi', $this->wwIdSkripsi])
            ->andFilterWhere(['like', 'wwNama', $this->wwNama])
            ->andFilterWhere(['like', 'wwJenkel', $this->wwJenkel])
            ->andFilterWhere(['like', 'wwTmpLahir', $this->wwTmpLahir])
            ->andFilterWhere(['like', 'wwEmail', $this->wwEmail])
            ->andFilterWhere(['like', 'wwHp', $this->wwHp])
            ->andFilterWhere(['like', 'wwAlamat', $this->wwAlamat])
            ->andFilterWhere(['like', 'wwPendTerakhir', $this->wwPendTerakhir])
            ->andFilterWhere(['like', 'wwProdiKode', $this->wwProdiKode])
            ->andFilterWhere(['like', 'wwProgKekhususan', $this->wwProgKekhususan])
            ->andFilterWhere(['like', 'wwJalur', $this->wwJalur])
            ->andFilterWhere(['like', 'wwIsBidikmisi', $this->wwIsBidikmisi])
            ->andFilterWhere(['like', 'wwJudulTa', $this->wwJudulTa])
            ->andFilterWhere(['like', 'wwPemb1', $this->wwPemb1])
            ->andFilterWhere(['like', 'wwPemb2', $this->wwPemb2])
            ->andFilterWhere(['like', 'wwPemb3', $this->wwPemb3])
            ->andFilterWhere(['like', 'wwPemb4', $this->wwPemb4])
            ->andFilterWhere(['like', 'wwPemb5', $this->wwPemb5])
            ->andFilterWhere(['like', 'wwOrtuAyah', $this->wwOrtuAyah])
            ->andFilterWhere(['like', 'wwOrtuIbu', $this->wwOrtuIbu]);

        return $dataProvider;
    }
}
