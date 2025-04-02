<?php

use yii\db\Migration;

/**
 * Class m250402_071027_create_update_something2
 */
class m250402_071027_create_update_something2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if (\common\helpers\DbDriverHelper::isMySQL()) {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%lich_hoc}}', [
            'id' => $this->primaryKey(),
            'mon_id' => $this->integer(),
            'thu_trong_tuan' => $this->integer()->notNull(),
            'tiet' => $this->integer()->notNull(),
            'thoi_gian_bat_dau' => $this->date(),
            'thoi_gian_ket_thuc' => $this->date(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%y_te}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'ngay_bi_benh' => $this->integer()->notNull(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250402_071027_create_update_something2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250402_071027_create_update_something2 cannot be reverted.\n";

        return false;
    }
    */
}
