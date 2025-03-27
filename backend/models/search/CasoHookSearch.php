<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CasoHook;

/**
 * CasoHookSearch represents the model behind the search form about `common\models\CasoHook`.
 */
class CasoHookSearch extends CasoHook implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'when', 'description', 'tid', 'subAccid', 'bank_sub_acc_id', 'virtualAccount', 'virtualAccountName', 'corresponsiveName', 'corresponsiveAccount', 'corresponsiveBankId', 'corresponsiveBankName'], 'safe'],
            [['amount', 'cusum_balance'], 'number'],
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
        $query = CasoHook::find();

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

        if(!empty($this->when)){
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
            self::tableName().'.amount' => trim($this->amount),
            self::tableName().'.cusum_balance' => trim($this->cusum_balance),
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.name', trim($this->name)])
            ->andFilterWhere(['like', self::tableName().'.description', trim($this->description)])
            ->andFilterWhere(['like', self::tableName().'.tid', trim($this->tid)])
            ->andFilterWhere(['like', self::tableName().'.subAccid', $this->subAccid])
            ->andFilterWhere(['like', self::tableName().'.bank_sub_acc_id', $this->bank_sub_acc_id])
            ->andFilterWhere(['like', self::tableName().'.virtualAccount', $this->virtualAccount])
            ->andFilterWhere(['like', self::tableName().'.virtualAccountName', $this->virtualAccountName])
            ->andFilterWhere(['like', self::tableName().'.corresponsiveName', $this->corresponsiveName])
            ->andFilterWhere(['like', self::tableName().'.corresponsiveAccount', $this->corresponsiveAccount])
            ->andFilterWhere(['like', self::tableName().'.corresponsiveBankId', $this->corresponsiveBankId])
            ->andFilterWhere(['like', self::tableName().'.corresponsiveBankName', $this->corresponsiveBankName]);

        return $dataProvider;
    }
}
