<?php

namespace backend\modules\products\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\products\models\Banks;

/**
 * BanksSearch represents the model behind the search form about `backend\modules\products\models\Banks`.
 */
class BanksSearch extends Banks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rstat', 'create_by', 'update_by'], 'integer'],
            [['name', 'detail', 'create_date', 'update_date', 'order'], 'safe'],
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
        $query = Banks::find()->where('rstat not in(0,3)');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'rstat' => $this->rstat,
            'create_by' => $this->create_by,
            'create_date' => $this->create_date,
            'update_by' => $this->update_by,
            'update_date' => $this->update_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'order', $this->order]);

        return $dataProvider;
    }
}
