<?php

namespace backend\models\search;

use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BankAccount;

/**
 * BankAccountSearch represents the model behind the search form about `common\models\BankAccount`.
 */
class BankAccountSearch extends BankAccount implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'active', 'default', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'bank_name', 'bank_number', 'qr_image'], 'safe'],
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
        $query = BankAccount::find();

        $query->where($options);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at'=> SORT_DESC]],
        ]);

        $query->select([self::tableName().'.*','user.name as userName']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->leftJoin(User::tableName().' user', 'user.id = '.self::tableName().'.user_id');

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.user_id' => $this->user_id,
            self::tableName().'.active' => $this->active,
            self::tableName().'.default' => $this->default,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.name', $this->name])
            ->andFilterWhere(['like', self::tableName().'.bank_name', $this->bank_name])
            ->andFilterWhere(['like', self::tableName().'.bank_number', $this->bank_number])
            ->andFilterWhere(['like', self::tableName().'.qr_image', $this->qr_image]);

        return $dataProvider;
    }
}
