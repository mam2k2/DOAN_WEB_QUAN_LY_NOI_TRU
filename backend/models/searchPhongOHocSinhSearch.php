<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhongOHocSinh;

/**
 * searchPhongOHocSinhSearch represents the model behind the search form about `common\models\PhongOHocSinh`.
 */
class searchPhongOHocSinhSearch extends PhongOHocSinh implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hoc_sinh_id', 'phong_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['thoi_gian_bat_dau'], 'number'],
            [['ghi_chu'], 'safe'],
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
        $query = PhongOHocSinh::find();

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
            self::tableName().'.thoi_gian_bat_dau' => $this->thoi_gian_bat_dau,
            self::tableName().'.trang_thai' => $this->trang_thai,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
