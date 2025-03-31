<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ViPhamNoiQuy;

/**
 * ViPhamNoiQuySearch represents the model behind the search form about `common\models\ViPhamNoiQuy`.
 */
class ViPhamNoiQuySearch extends ViPhamNoiQuy implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['loai_vi_pham', 'mo_ta', 'ngay_vi_pham', 'hinh_thuc_xu_ly', 'nguoi_xu_ly'], 'safe'],
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
        $query = ViPhamNoiQuy::find();

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
            self::tableName().'.ngay_vi_pham' => $this->ngay_vi_pham,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.loai_vi_pham', $this->loai_vi_pham])
            ->andFilterWhere(['like', self::tableName().'.mo_ta', $this->mo_ta])
            ->andFilterWhere(['like', self::tableName().'.hinh_thuc_xu_ly', $this->hinh_thuc_xu_ly])
            ->andFilterWhere(['like', self::tableName().'.nguoi_xu_ly', $this->nguoi_xu_ly]);

        return $dataProvider;
    }
}
