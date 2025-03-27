<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UnitTransaction;

/**
 * UnitTransactionSearch represents the model behind the search form about `common\models\UnitTransaction`.
 */
class UnitTransactionSearch extends UnitTransaction implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'user_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'shop_id'], 'safe'],
            [['content', 'unit', 'name'], 'safe'],
            [['value'], 'number'],
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
        $query = UnitTransaction::find();
        $query->where($options);

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
            self::tableName().'.value' => $this->value,
            self::tableName().'.type' => $this->type,
            self::tableName().'.user_id' => $this->user_id,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
            self::tableName().'.updated_at' => $this->updated_at,
            self::tableName().'.shop_id' => $this->shop_id,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.content', $this->content])
            ->andFilterWhere(['like', self::tableName().'.unit', $this->unit])
            ->andFilterWhere(['like', self::tableName().'.name', $this->name]);

        return $dataProvider;
    }
}
