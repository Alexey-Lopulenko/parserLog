<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ParsData;

/**
 * ParsDataSearch represents the model behind the search form of `app\models\ParsData`.
 */
class ParsDataSearch extends ParsData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'file_id', 'created_at', 'updated_at'], 'integer'],
            [['client_ip', 'time_local', 'request', 'status', 'body_bytes_sent', 'http_referer', 'http_user_agent', 'full_row'], 'safe'],
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
        $query = ParsData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'file_id' => $this->file_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'client_ip', $this->client_ip])
            ->andFilterWhere(['like', 'time_local', $this->time_local])
            ->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'body_bytes_sent', $this->body_bytes_sent])
            ->andFilterWhere(['like', 'http_referer', $this->http_referer])
            ->andFilterWhere(['like', 'http_user_agent', $this->http_user_agent])
            ->andFilterWhere(['like', 'full_row', $this->full_row]);

        return $dataProvider;
    }
}
