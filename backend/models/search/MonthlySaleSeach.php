<?php

namespace backend\models\search;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BalanceVolatility;

/**
 * BalanceVolatilitySearch represents the model behind the search form about `common\models\BalanceVolatility`.
 */
class MonthlySaleSeach extends BalanceVolatility implements \backend\models\search\SearchInterface
{
    public $parent_id;
    public $createdAt;
    public $userId;
    public $amount_deposit;

    public $amount_withdrawal;
    public $amount_ticket;
    public $amount_buy_order;
    public $amount_sell_order_recharge;
    public $amount_sell_order_withdrawal;
    public $amount_ticket_commission_recharge;
    public $amount_ticket_commission_withdrawal;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'parent_id', 'created_at', 'createdAt'], 'safe'],
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
        $query = self::find();
        $newOptions = [];
        foreach ($options as $key => $value){
            if(is_numeric($key)){
                $query->andWhere($value);
            }else
                $newOptions[self::tableName().'.'.$key] = $value;
        }
        $query->where($newOptions);
        $query->alias('balance');
        $query->select([
            'user.id as id',
            'user.id as userId',
            'user.name as user_name',
            'user.parent_id as parent_id',
            'parent.name as parent_name',
            'SUM(case when balance.wallet = 0 and balance.type = 2 then balance.amount else 0 end) as amount_deposit',
            'SUM(case when balance.wallet = 1 and (balance.type = 3 or balance.type = 9) then balance.amount else 0 end) as amount_withdrawal',
            'SUM(case when balance.wallet = 0 and balance.type = 4 then balance.amount else 0 end) as amount_ticket',
            'SUM(case when balance.wallet = 0 and balance.type = 0 then balance.amount else 0 end) as amount_buy_order',
            'SUM(case when balance.wallet = 0 and balance.type = 1 then balance.amount else 0 end) as amount_sell_order_recharge',
            'SUM(case when balance.wallet = 1 and balance.type = 1 then balance.amount else 0 end) as amount_sell_order_withdrawal',
            'SUM(case when balance.wallet = 0 and (balance.type = 6 or balance.type = 7) then balance.amount else 0 end) as amount_ticket_commission_recharge',
            'SUM(case when balance.wallet = 1 and (balance.type = 6 or balance.type = 7) then balance.amount else 0 end) as amount_ticket_commission_withdrawal',
            'SUM(case when balance.wallet = 0 and (balance.type = 8 or balance.type = 11) then balance.amount else 0 end) as amount_nft_commission_recharge',
            'SUM(case when balance.wallet = 1 and (balance.type = 8 or balance.type = 11) then balance.amount else 0 end) as amount_nft_commission_withdrawal',
            'balance.created_at as createdAt'
        ]);

        $query->rightJoin(User::tableName().' as user', 'user.id = balance.user_id');
        $query->leftJoin(User::tableName().' as parent', 'parent.id = user.parent_id');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => array_merge($this->attributes(), [
                'createdAt',
                'userId'
            ]),

            'defaultOrder' => ['userId' => SORT_ASC]
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
                    ['>=', 'balance.created_at', strtotime(trim($dateRanger[0]))],
                    ['<=', 'balance.created_at', strtotime(trim($dateRanger[1]))]
                ]);
            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'user.id' => $this->id,
            'balance.user_id' => $this->user_id,
        ]);

        if(!empty($this->parent_id)){
            $query->andFilterWhere(['REGEXP','user.id_relative', "\.$this->parent_id"]);
        }
        $query->groupBy(['id']);
        $query->asArray();
        return $dataProvider;
    }
}
