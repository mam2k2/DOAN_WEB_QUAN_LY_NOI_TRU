<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `common\models\Notification`.
 */
class NotificationSearch extends Notification implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'type', 'status', 'created_at', 'updated_at', 'code_notification'], 'integer'],
            [['title', 'body', 'content', 'class', 'function', 'screen', 'object'], 'safe'],
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
        $query = Notification::find();

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
            self::tableName().'.status' => $this->status,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
            self::tableName().'.code_notification' => $this->code_notification,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.title', $this->title])
            ->andFilterWhere(['like', self::tableName().'.body', $this->body])
            ->andFilterWhere(['like', self::tableName().'.content', $this->content])
            ->andFilterWhere(['like', self::tableName().'.class', $this->class])
            ->andFilterWhere(['like', self::tableName().'.function', $this->function])
            ->andFilterWhere(['like', self::tableName().'.screen', $this->screen])
            ->andFilterWhere(['like', self::tableName().'.object', $this->object]);

        return $dataProvider;
    }
}
