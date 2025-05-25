<?php

use yii\db\Migration;

/**
 * Class m250525_104657_add_column_uu_tien
 */
class m250525_104657_add_column_uu_tien extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%thong_tin_hoc_sinh}}', 'uu_tien',$this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250525_104657_add_column_uu_tien cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250525_104657_add_column_uu_tien cannot be reverted.\n";

        return false;
    }
    */
}
