<?php

use yii\db\Migration;

/**
 * Class m250511_101410_add_column_type_admin_users
 */
class m250511_101410_add_column_type_admin_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%admin_user}}', 'type',$this->integer()->comment("1 admin user, 2 giáo viên")->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250511_101410_add_column_type_admin_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250511_101410_add_column_type_admin_users cannot be reverted.\n";

        return false;
    }
    */
}
