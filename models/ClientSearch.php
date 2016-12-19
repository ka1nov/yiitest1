<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex'], 'integer'],
            [['name', 'last_name', 'second_name', 'date_birth', 'date_create', 'date_change', 'phones'], 'safe'],
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
        $query = Client::find()->with('phone');
        $query = Client::find()->joinWith('phone');
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
            'id' => $this->id,
            'date_birth' => $this->date_birth,
            'sex' => $this->sex,
            'date_create' => $this->date_create,
            'date_change' => $this->date_change,
        ]);
        
        $phone = Yii::$app->request->get('ClientSearch')['phones'];
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['in', 'phone', $phone]);

        return $dataProvider;
    }
}
