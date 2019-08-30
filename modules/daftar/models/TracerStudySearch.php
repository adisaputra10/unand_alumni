<?php

namespace app\modules\daftar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\daftar\models\TracerStudy;

/**
 * TracerStudySearch represents the model behind the search form of `app\modules\daftar\models\TracerStudy`.
 */
class TracerStudySearch extends TracerStudy
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtracer', 'tahunangkatan', 'tahunlulus', 'gajipertama', 'gajiskrg'], 'integer'],
            [['idalumni', 'alamatemail', 'hp', 'masatunggu', 'institusipertama', 'pekerjaanpertama', 'pekerjaanskrg', 'posisiskrg', 'lokasiskrg', 'relevansiilmu', 'saran'], 'safe'],
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
        $query = TracerStudy::find();

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
            'idtracer' => $this->idtracer,
            'tahunangkatan' => $this->tahunangkatan,
            'tahunlulus' => $this->tahunlulus,
            'gajipertama' => $this->gajipertama,
            'gajiskrg' => $this->gajiskrg,
        ]);

        $query->andFilterWhere(['like', 'idalumni', $this->idalumni])
            ->andFilterWhere(['like', 'alamatemail', $this->alamatemail])
            ->andFilterWhere(['like', 'hp', $this->hp])
            ->andFilterWhere(['like', 'masatunggu', $this->masatunggu])
            ->andFilterWhere(['like', 'institusipertama', $this->institusipertama])
            ->andFilterWhere(['like', 'pekerjaanpertama', $this->pekerjaanpertama])
            ->andFilterWhere(['like', 'pekerjaanskrg', $this->pekerjaanskrg])
            ->andFilterWhere(['like', 'posisiskrg', $this->posisiskrg])
            ->andFilterWhere(['like', 'lokasiskrg', $this->lokasiskrg])
            ->andFilterWhere(['like', 'relevansiilmu', $this->relevansiilmu])
            ->andFilterWhere(['like', 'saran', $this->saran]);

        return $dataProvider;
    }
}
