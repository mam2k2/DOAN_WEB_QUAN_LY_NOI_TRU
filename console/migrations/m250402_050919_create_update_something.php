<?php

use yii\db\Migration;

/**
 * Class m250402_050919_create_update_something
 */
class m250402_050919_create_update_something extends Migration
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
        $this->createTable('{{%phong_o_hoc_sinh}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'phong_id' => $this->integer()->notNull(),
            'thoi_gian_bat_dau' => $this->decimal(10,2)->notNull(),
            'trang_thai' => $this->smallInteger()->defaultValue(0)->comment('0-Đã rời đi,1-Đang ở'),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%khoa}}', [
            'id' => $this->primaryKey(),
            'ten_khoa' => $this->dateTime()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%lop}}', [
            'id' => $this->primaryKey(),
            'khoa_id' => $this->integer(),
            'chu_nghiem_id' => $this->integer(),
            'ten_lop' => $this->string(),
            'ngay_bat_dau' => $this->dateTime()->notNull(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%thong_tin_hoc_sinh}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'lop_id' => $this->integer(),
            'ngay_sinh' => $this->date()->notNull(),
            'que_quan' => $this->string(),
            'trang_thai' => $this->smallInteger()->defaultValue(0)->comment('0-Đã Tốt nghiệp,1-Đã rời đi'),
            'diem_trung_binh' => $this->decimal(),
            'ngay_bat_dau' => $this->dateTime()->notNull(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%mon_hoc}}', [
            'id' => $this->primaryKey(),
            'ten_mon_hoc' => $this->text()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%diem_mon_hoc}}', [
            'id' => $this->primaryKey(),
            'mon_hoc_id' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'diem' => $this->decimal(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250402_050919_create_update_something cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250402_050919_create_update_something cannot be reverted.\n";

        return false;
    }
    */
}
