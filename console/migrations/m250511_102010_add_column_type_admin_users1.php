<?php

use yii\db\Migration;

/**
 * Class m250511_102010_add_column_type_admin_users1
 */
class m250511_102010_add_column_type_admin_users1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%admin_user}}', 'ho_va_ten',$this->string(64)->comment("Họ và tên"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250511_102010_add_column_type_admin_users1 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250511_102010_add_column_type_admin_users1 cannot be reverted.\n";

        return false;
    }
    */
}
