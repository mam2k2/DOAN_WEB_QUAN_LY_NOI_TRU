<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserTransaction;

/**
 * UserTransactionSearch represents the model behind the search form about `common\models\UserTransaction`.
 */
class UserTransactionSearch extends UserTransaction implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type', 'bank_account_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['code', 'note', 'created_at', 'updated_at'], 'safe'],
            [['amount', 'bv', 'rate'], 'number'],
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
        $query = UserTransaction::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.user_id' => $this->user_id,
            self::tableName().'.type' => $this->type,
            self::tableName().'.bank_account_id' => $this->bank_account_id,
            self::tableName().'.amount' => $this->amount,
            self::tableName().'.bv' => $this->bv,
            self::tableName().'.rate' => $this->rate,
            self::tableName().'.status' => $this->status,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.code', $this->code])
            ->andFilterWhere(['like', self::tableName().'.note', $this->note]);

        if(!empty($this->created_at)){
            $dateRanger = explode('~', $this->created_at);
            if(count($dateRanger) > 1){
                $query->andFilterWhere(['AND',
                    ['>=', self::tableName().'.created_at', strtotime(trim($dateRanger[0]))],
                    ['<=', self::tableName().'.created_at', strtotime(trim($dateRanger[1]))]
                ]);
            }
        }

        return $dataProvider;
    }
}
