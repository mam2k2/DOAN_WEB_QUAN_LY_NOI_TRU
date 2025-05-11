<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HocSinh;

/**
 * HocSinhSearch represents the model behind the search form about `common\models\HocSinh`.
 */
class HocSinhSearch extends HocSinh implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'avatar', 'access_token'], 'safe'],
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
        $query = HocSinh::find();

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
            self::tableName().'.status' => $this->status,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.username', $this->username])
            ->andFilterWhere(['like', self::tableName().'.auth_key', $this->auth_key])
            ->andFilterWhere(['like', self::tableName().'.password_hash', $this->password_hash])
            ->andFilterWhere(['like', self::tableName().'.password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', self::tableName().'.email', $this->email])
            ->andFilterWhere(['like', self::tableName().'.avatar', $this->avatar])
            ->andFilterWhere(['like', self::tableName().'.access_token', $this->access_token]);

        return $dataProvider;
    }
}
