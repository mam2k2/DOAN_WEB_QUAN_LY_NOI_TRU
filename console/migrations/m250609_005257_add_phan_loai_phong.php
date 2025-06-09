<?php

use yii\db\Migration;

/**
 * Class m250609_005257_add_phan_loai_phong
 */
class m250609_005257_add_phan_loai_phong extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%phong_o}}', 'phan_loai',$this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250609_005257_add_phan_loai_phong cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250609_005257_add_phan_loai_phong cannot be reverted.\n";

        return false;
    }
    */
}
