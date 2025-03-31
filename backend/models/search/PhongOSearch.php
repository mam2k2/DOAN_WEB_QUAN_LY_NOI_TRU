<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PhongO;

/**
 * PhongOSearch represents the model behind the search form about `common\models\PhongO`.
 */
class PhongOSearch extends PhongO implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'khu_id', 'suc_chua', 'so_luong_hien_tai', 'created_at', 'updated_at'], 'integer'],
            [['ma_phong', 'ten_phong', 'vi_tri', 'ghi_chu'], 'safe'],
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
        $query = PhongO::find();

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
            self::tableName().'.khu_id' => $this->khu_id,
            self::tableName().'.suc_chua' => $this->suc_chua,
            self::tableName().'.so_luong_hien_tai' => $this->so_luong_hien_tai,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.ma_phong', $this->ma_phong])
            ->andFilterWhere(['like', self::tableName().'.ten_phong', $this->ten_phong])
            ->andFilterWhere(['like', self::tableName().'.vi_tri', $this->vi_tri])
            ->andFilterWhere(['like', self::tableName().'.ghi_chu', $this->ghi_chu]);

        return $dataProvider;
    }
}
