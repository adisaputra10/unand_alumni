<?php

namespace app\modules\daftar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\daftar\models\Kegiatan;

/**
 * KegiatanSearch represents the model behind the search form of `app\modules\daftar\models\Kegiatan`.
 */
class KegiatanSearch extends Kegiatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkegiatan'], 'integer'],
            [['nama', 'tglmulai', 'tglselesai', 'nosurat', 'ringkasan', 'tglsurat'], 'safe'],
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
        $query = Kegiatan::find();

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
            'idkegiatan' => $this->idkegiatan,
            'tglmulai' => $this->tglmulai,
            'tglselesai' => $this->tglselesai,
            'tglsurat' => $this->tglsurat,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'nosurat', $this->nosurat])
            ->andFilterWhere(['like', 'ringkasan', $this->ringkasan]);

        return $dataProvider;
    }
}
