<?php

namespace backend\modules\products\models;

use appxq\sdii\utils\VarDumper;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\products\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `backend\modules\products\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'detail', 'price', 'create_date', 'update_date', 'image'], 'safe'],
            [['rstat', 'create_by', 'update_by', 'order'], 'integer'],
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
        $data = null;
        $query = Products::find()->where('rstat not in(0,3)');
        if(isset($params['last-sort'])){
            $data = $query->orderBy(['id'=>SORT_DESC]);
        }else{
            $data = $query->orderBy(['order'=>SORT_ASC]);
        }

        if(isset($params['sort-price']) && $params['sort-price'] == 'desc'){
            $data = $query->orderBy(['price'=>SORT_DESC]);
        }else if(isset($params['sort-price']) && $params['sort-price'] == 'asc'){
            $data = $query->orderBy(['price'=>SORT_ASC]);
        }else{
            $data = $query->orderBy(['order'=>SORT_ASC]);
        }
        if(isset($params['term']) && $params['term'] != ''){
            $data = $query->where('name like :name OR detail like :detail AND rstat not in(0,3)',[
                ':name'=>"%{$params['term']}%",
                ':detail'=>"%{$params['term']}%"
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $data,
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
            'rstat' => $this->rstat,
            'create_by' => $this->create_by,
            'create_date' => $this->create_date,
            'update_by' => $this->update_by,
            'update_date' => $this->update_date,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
