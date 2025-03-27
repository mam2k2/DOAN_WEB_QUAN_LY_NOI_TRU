<?php

namespace backend\models\search;

use common\models\AdminUser;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Shop;

/**
 * ShopSearch represents the model behind the search form about `common\models\Shop`.
 */
class ShopSearch extends Shop implements \backend\models\search\SearchInterface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'owner_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone_number', 'address', 'description'], 'safe'],
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
        $query = Shop::find();
        $query->where($options);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => array_merge($this->attributes(), [
                'ownerName',
            ]),
            'defaultOrder' => ['created_at' => SORT_DESC]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->select(implode(',', [
            self::tableName() . '.*',
            'admin.username as ownerName',
        ]));

        $query->leftJoin(AdminUser::tableName().' admin', "admin.id = ".Shop::tableName().".owner_id");

        // grid filtering conditions
        $query->andFilterWhere([
            Shop::tableName().'.id' => $this->id,
            Shop::tableName().'.owner_id' => $this->owner_id,
            Shop::tableName().'.created_by' => $this->created_by,
            Shop::tableName().'.updated_by' => $this->updated_by,
            Shop::tableName().'.created_at' => $this->created_at,
            Shop::tableName().'.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', Shop::tableName().'.name', $this->name])
            ->andFilterWhere(['like', Shop::tableName().'.phone_number', $this->phone_number])
            ->andFilterWhere(['like', Shop::tableName().'.address', $this->address])
            ->andFilterWhere(['like', Shop::tableName().'.description', $this->description]);

        return $dataProvider;
    }
}
