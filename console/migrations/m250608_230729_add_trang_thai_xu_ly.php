<?php

use yii\db\Migration;

/**
 * Class m250608_230729_add_trang_thai_xu_ly
 */
class m250608_230729_add_trang_thai_xu_ly extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vi_pham_noi_quy}}', 'trang_thai',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250608_230729_add_trang_thai_xu_ly cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250608_230729_add_trang_thai_xu_ly cannot be reverted.\n";

        return false;
    }
    */
}
