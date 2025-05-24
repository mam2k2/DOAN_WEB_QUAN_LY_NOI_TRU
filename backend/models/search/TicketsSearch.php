<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tickets;

/**
 * TicketsSearch represents the model behind the search form about `common\models\Tickets`.
 */
class TicketsSearch extends Tickets implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'assigned_to'], 'integer'],
            [['tieu_de', 'noi_dung', 'danh_muc', 'trang_thai', 'do_khan_cap', 'created_at', 'updated_at'], 'safe'],
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
        $query = Tickets::find();

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
            self::tableName().'.assigned_to' => $this->assigned_to,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.tieu_de', $this->tieu_de])
            ->andFilterWhere(['like', self::tableName().'.noi_dung', $this->noi_dung])
            ->andFilterWhere(['like', self::tableName().'.danh_muc', $this->danh_muc])
            ->andFilterWhere(['like', self::tableName().'.trang_thai', $this->trang_thai])
            ->andFilterWhere(['like', self::tableName().'.do_khan_cap', $this->do_khan_cap]);

        return $dataProvider;
    }
}
