<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserIdentity;

/**
 * UserIdentitySearch represents the model behind the search form about `common\models\UserIdentity`.
 */
class UserIdentitySearch extends UserIdentity implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['name', 'issued_by', 'license_date', 'address', 'frontend_image', 'backend_image', 'avatar'], 'safe'],
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
        $query = UserIdentity::find();

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
            self::tableName().'.status' => $this->status,
//            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.name', $this->name])
            ->andFilterWhere(['like', self::tableName().'.issued_by', $this->issued_by])
            ->andFilterWhere(['like', self::tableName().'.license_date', $this->license_date])
            ->andFilterWhere(['like', self::tableName().'.address', $this->address])
            ->andFilterWhere(['like', self::tableName().'.frontend_image', $this->frontend_image])
            ->andFilterWhere(['like', self::tableName().'.backend_image', $this->backend_image])
            ->andFilterWhere(['like', self::tableName().'.avatar', $this->avatar]);

        return $dataProvider;
    }
}
