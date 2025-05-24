<?php

use yii\db\Migration;

/**
 * Class m250524_122328_add_column_thpt_thcs_he_dao_tao
 */
class m250524_122328_add_column_thpt_thcs_he_dao_tao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%thong_tin_hoc_sinh}}', 'truong_thpt',$this->string(255));
        $this->addColumn('{{%thong_tin_hoc_sinh}}', 'truong_thcs',$this->string(255));
        $this->addColumn('{{%thong_tin_hoc_sinh}}', 'trinh_do_dao_tao',$this->string(255));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250524_122328_add_column_thpt_thcs_he_dao_tao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250524_122328_add_column_thpt_thcs_he_dao_tao cannot be reverted.\n";

        return false;
    }
    */
}
