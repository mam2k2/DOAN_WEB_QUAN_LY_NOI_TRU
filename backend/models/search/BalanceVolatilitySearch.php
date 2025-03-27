<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BalanceVolatility;

/**
 * BalanceVolatilitySearch represents the model behind the search form about `common\models\BalanceVolatility`.
 */
class BalanceVolatilitySearch extends BalanceVolatility implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'object_id', 'type', 'wallet', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['object_class', 'unit', 'description'], 'safe'],
            [['amount', 'total'], 'number'],
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
    public function search(array $params = [], array $options = [])
    {
        $query = BalanceVolatility::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at'=> SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($this->created_at)){
            $dateRanger = explode('~', $this->created_at);
            if(count($dateRanger) > 1){
                $query->andFilterWhere(['AND',
                    ['>=', self::tableName().'.created_at', strtotime(trim($dateRanger[0]))],
                    ['<=', self::tableName().'.created_at', strtotime(trim($dateRanger[1]))]
                ]);
            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.user_id' => $this->user_id,
            self::tableName().'.object_id' => $this->object_id,
            self::tableName().'.amount' => $this->amount,
            self::tableName().'.type' => $this->type,
            self::tableName().'.wallet' => $this->wallet,
            self::tableName().'.total' => $this->total,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.object_class', $this->object_class])
            ->andFilterWhere(['like', self::tableName().'.unit', $this->unit])
            ->andFilterWhere(['like', self::tableName().'.description', $this->description]);

        return $dataProvider;
    }
}
