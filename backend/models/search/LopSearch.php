<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Lop;

/**
 * LopSearch represents the model behind the search form about `common\models\Lop`.
 */
class LopSearch extends Lop implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'khoa_id', 'chu_nghiem_id', 'created_at', 'updated_at'], 'integer'],
            [['ten_lop', 'ngay_bat_dau', 'ghi_chu'], 'safe'],
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
        $query = Lop::find();

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
            self::tableName().'.khoa_id' => $this->khoa_id,
            self::tableName().'.chu_nghiem_id' => $this->chu_nghiem_id,
            self::tableName().'.ngay_bat_dau' => $this->ngay_bat_dau,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.ten_lop', $this->ten_lop])
            ->andFilterWhere(['like', self::tableName().'.ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
