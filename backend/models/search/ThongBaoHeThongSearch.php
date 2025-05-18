<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ThongBaoHeThong;

/**
 * ThongBaoHeThongSearch represents the model behind the search form about `common\models\ThongBaoHeThong`.
 */
class ThongBaoHeThongSearch extends ThongBaoHeThong implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nguoi_gui_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['tieu_de', 'noi_dung', 'ngay_gui'], 'safe'],
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
        $query = ThongBaoHeThong::find();

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
            self::tableName().'.nguoi_gui_id' => $this->nguoi_gui_id,
            self::tableName().'.ngay_gui' => $this->ngay_gui,
            self::tableName().'.user_id' => $this->user_id,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.tieu_de', $this->tieu_de])
            ->andFilterWhere(['like', self::tableName().'.noi_dung', $this->noi_dung]);

        return $dataProvider;
    }
}
