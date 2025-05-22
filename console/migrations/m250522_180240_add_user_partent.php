<?php

use yii\db\Migration;

/**
 * Class m250522_180240_add_user_partent
 */
class m250522_180240_add_user_partent extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%thong_tin_hoc_sinh}}', 'phu_huynh_user_id',$this->integer()->unsigned()->comment("Tài khoản phụ huynh"));
        $this->addForeignKey(
            'fk_thong_tin_hoc_sinh_phu_huynh_user_id',
            '{{%thong_tin_hoc_sinh}}',
            'phu_huynh_user_id',
            '{{%user}}',
            'id',

        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250522_180240_add_user_partent cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250522_180240_add_user_partent cannot be reverted.\n";

        return false;
    }
    */
}
