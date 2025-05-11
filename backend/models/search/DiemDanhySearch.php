<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DiemDanh;

/**
 * DiemDanhySearch represents the model behind the search form about `common\models\DiemDanh`.
 */
class DiemDanhySearch extends DiemDanh implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hoc_sinh_id', 'phong_id', 'created_at', 'updated_at'], 'integer'],
            [['ngay_diem_danh', 'thoi_gian'], 'safe'],
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
        $query = DiemDanh::find();

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
            self::tableName().'.hoc_sinh_id' => $this->hoc_sinh_id,
            self::tableName().'.phong_id' => $this->phong_id,
            self::tableName().'.ngay_diem_danh' => $this->ngay_diem_danh,
            self::tableName().'.thoi_gian' => $this->thoi_gian,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
