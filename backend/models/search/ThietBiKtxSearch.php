<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ThietBiKtx;

/**
 * ThietBiKtxSearch represents the model behind the search form about `common\models\ThietBiKtx`.
 */
class ThietBiKtxSearch extends ThietBiKtx implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phong_o_id', 'created_at', 'updated_at'], 'integer'],
            [['ma_thiet_bi', 'ten_thiet_bi', 'tinh_trang', 'ngay_bao_tri', 'ghi_chu'], 'safe'],
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
        $query = ThietBiKtx::find();

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
            self::tableName().'.phong_o_id' => $this->phong_o_id,
            self::tableName().'.ngay_bao_tri' => $this->ngay_bao_tri,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.ma_thiet_bi', $this->ma_thiet_bi])
            ->andFilterWhere(['like', self::tableName().'.ten_thiet_bi', $this->ten_thiet_bi])
            ->andFilterWhere(['like', self::tableName().'.tinh_trang', $this->tinh_trang])
            ->andFilterWhere(['like', self::tableName().'.ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
