<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'branch_id', 'type', 'unit', 'status', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name'], 'safe'],
            [['price_import', 'price_export', 'tax_percentage', 'quantity', 'note', 'desc', 'SKU'], 'number'],
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
        $query = Product::find();

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
            self::tableName().'.category_id' => $this->category_id,
            self::tableName().'.branch_id' => $this->branch_id,
            self::tableName().'.price_import' => $this->price_import,
            self::tableName().'.price_export' => $this->price_export,
            self::tableName().'.tax_percentage' => $this->tax_percentage,
            self::tableName().'.quantity' => $this->quantity,
            self::tableName().'.note' => $this->note,
            self::tableName().'.desc' => $this->desc,
            self::tableName().'.type' => $this->type,
            self::tableName().'.SKU' => $this->SKU,
            self::tableName().'.unit' => $this->unit,
            self::tableName().'.status' => $this->status,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
            self::tableName().'.deleted_by' => $this->deleted_by,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
            self::tableName().'.deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.name', $this->name]);

        return $dataProvider;
    }
}
