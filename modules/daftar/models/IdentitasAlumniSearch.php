<?php

namespace app\modules\daftar\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\daftar\models\IdentitasAlumni;

/**
 * IdentitasAlumniSearch represents the model behind the search form of `app\modules\daftar\models\IdentitasAlumni`.
 */
class IdentitasAlumniSearch extends IdentitasAlumni
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idalumni', 'username', 'password', 'namalengkap', 'nim', 'tgllahir', 'idprodi', 'tgllulus', 'tglwisuda', 'email', 'nohp', 'alamatrumah', 'namaperusahaan', 'posisipekerjaan', 'alamatperusahaan', 'emailperusahaan', 'bidangperusahaan', 'riwayatperusahaan', 'foto'], 'safe'],
            [['angkatan', 'tahunlulus'], 'integer'],
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
        $query = IdentitasAlumni::find();

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
            'tgllahir' => $this->tgllahir,
            'angkatan' => $this->angkatan,
            'tahunlulus' => $this->tahunlulus,
            'tgllulus' => $this->tgllulus,
            'tglwisuda' => $this->tglwisuda,
        ]);

        $query->andFilterWhere(['like', 'idalumni', $this->idalumni])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'namalengkap', $this->namalengkap])
            ->andFilterWhere(['like', 'nim', $this->nim])
            ->andFilterWhere(['like', 'idprodi', $this->idprodi])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nohp', $this->nohp])
            ->andFilterWhere(['like', 'alamatrumah', $this->alamatrumah])
            ->andFilterWhere(['like', 'namaperusahaan', $this->namaperusahaan])
            ->andFilterWhere(['like', 'posisipekerjaan', $this->posisipekerjaan])
            ->andFilterWhere(['like', 'alamatperusahaan', $this->alamatperusahaan])
            ->andFilterWhere(['like', 'emailperusahaan', $this->emailperusahaan])
            ->andFilterWhere(['like', 'bidangperusahaan', $this->bidangperusahaan])
            ->andFilterWhere(['like', 'riwayatperusahaan', $this->riwayatperusahaan])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
