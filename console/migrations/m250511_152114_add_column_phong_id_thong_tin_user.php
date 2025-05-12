<?php

use yii\db\Migration;

/**
 * Class m250511_152114_add_column_phong_id_thong_tin_user
 */
class m250511_152114_add_column_phong_id_thong_tin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%thong_tin_hoc_sinh}}', 'phong_id',$this->integer());
        $this->addForeignKey(
            'fk_thong_tin_hoc_sinh_phong_id',
            '{{%thong_tin_hoc_sinh}}',
            'phong_id',
            '{{%phong_o}}',
            'id',

        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250511_152114_add_column_phong_id_thong_tin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250511_152114_add_column_phong_id_thong_tin_user cannot be reverted.\n";

        return false;
    }
    */
}
