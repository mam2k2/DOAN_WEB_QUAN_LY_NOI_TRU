<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ThongTinHocSinh;

/**
 * ThongTinHocSinhSearch represents the model behind the search form about `common\models\ThongTinHocSinh`.
 */
class ThongTinHocSinhSearch extends ThongTinHocSinh implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'lop_id', 'phong_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['ngay_sinh', 'que_quan', 'ngay_bat_dau', 'ghi_chu'], 'safe'],
            [['diem_trung_binh'], 'number'],
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
        $query = ThongTinHocSinh::find();

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
            self::tableName().'.lop_id' => $this->lop_id,
            self::tableName().'.phong_id' => $this->phong_id,
            self::tableName().'.ngay_sinh' => $this->ngay_sinh,
            self::tableName().'.trang_thai' => $this->trang_thai,
            self::tableName().'.diem_trung_binh' => $this->diem_trung_binh,
            self::tableName().'.ngay_bat_dau' => $this->ngay_bat_dau,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.que_quan', $this->que_quan])
            ->andFilterWhere(['like', self::tableName().'.ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
