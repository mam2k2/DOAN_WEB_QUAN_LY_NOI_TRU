<?php

namespace backend\models\search;

use common\models\Category;
use common\models\Shop;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form about `common\models\Order`.
 */
class OrderSearch extends Order implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'user_id', 'category_id', 'status', 'is_system', 'type', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['price', 'shop_id'], 'number'],
            [['image', 'description', 'content', 'purchase_expiration', 'sales_expiration', 'address', 'name'], 'safe'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at'=> SORT_DESC]],
        ]);

        $this->load($params);

        $query->select([
            self::tableName().'.*',
            'shop.name as shopName',
            'category.name as categoryName',
            'user.name as userName',
        ]);

        $query->leftJoin(Shop::tableName().' shop','shop.id = '.self::tableName().'.shop_id');
        $query->leftJoin(Category::tableName().' category','category.id = '.self::tableName().'.category_id');
        $query->leftJoin(User::tableName().' user','user.id = '.self::tableName().'.user_id');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            self::tableName().'.id' => $this->id,
            self::tableName().'.product_id' => $this->product_id,
            self::tableName().'.user_id' => $this->user_id,
            self::tableName().'.price' => $this->price,
            self::tableName().'.category_id' => $this->category_id,
            self::tableName().'.shop_id' => $this->shop_id,
            self::tableName().'.status' => $this->status,
            self::tableName().'.purchase_expiration' => $this->purchase_expiration,
            self::tableName().'.sales_expiration' => $this->sales_expiration,
            self::tableName().'.is_system' => $this->is_system,
            self::tableName().'.type' => $this->type,
            self::tableName().'.created_by' => $this->created_by,
            self::tableName().'.updated_by' => $this->updated_by,
            self::tableName().'.created_at' => $this->created_at,
            self::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', self::tableName().'.image', $this->image])
            ->andFilterWhere(['like', self::tableName().'.name', $this->name])
            ->andFilterWhere(['like', self::tableName().'.description', $this->description])
            ->andFilterWhere(['like', self::tableName().'.content', $this->content])
            ->andFilterWhere(['like', self::tableName().'.address', $this->address]);

        return $dataProvider;
    }
}
