<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LichHoc;

/**
 * LichHocSearch represents the model behind the search form about `common\models\LichHoc`.
 */
class LichHocSearch extends LichHoc implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'mon_id', 'thu_trong_tuan', 'tiet', 'created_at', 'updated_at'], 'integer'],
            [['thoi_gian_bat_dau', 'thoi_gian_ket_thuc', 'ghi_chu'], 'safe'],
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
        $query = LichHoc::find();

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
            self::tableName().'.mon_id' => $this->mon_id,
            self::tableName().'.thu_trong_tuan' => $this->thu_trong_tuan,
            self::tableName().'.tiet' => $this->tiet,
            self::tableName().'.thoi_gian_bat_dau' => $this->thoi_gian_bat_dau,
            self::tableName().'.thoi_gian_ket_thuc' => $this->thoi_gian_ket_thuc,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
