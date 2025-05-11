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
            'hoc_sinh_id' => $this->integer()->unsigned(),
            'phong_id' => $this->integer()->notNull(),
            'thoi_gian_bat_dau' => $this->decimal(10,2)->notNull(),
            'trang_thai' => $this->smallInteger()->defaultValue(0)->comment('0-Đã rời đi,1-Đang ở'),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%khoa}}', [
            'id' => $this->primaryKey(),
            'ten_khoa' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->createTable('{{%lop}}', [
            'id' => $this->primaryKey(),
            'khoa_id' => $this->integer(),
            'chu_nghiem_id' => $this->integer()->unsigned(),
            'ten_lop' => $this->string(),
            'ngay_bat_dau' => $this->dateTime()->notNull(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey(
            'fk-phong_o_hoc_sinh-user_id',
            '{{%phong_o_hoc_sinh}}',
            'hoc_sinh_id',
            '{{%thong_tin_hoc_sinh}}',
            'id',
        );

        $this->addForeignKey(
            'fk-phong_o_hoc_sinh-phong_id',
            '{{%phong_o_hoc_sinh}}',
            'phong_id',
            '{{%phong_o}}',
            'id',
        );

// Bảng lop
        $this->addForeignKey(
            'fk-lop-khoa_id',
            '{{%lop}}',
            'khoa_id',
            '{{%khoa}}',
            'id',
        );

        $this->addForeignKey(
            'fk-lop-chu_nghiem_id',
            '{{%lop}}',
            'chu_nghiem_id',
            '{{%admin_user}}',
            'id',
        );
        $this->addForeignKey(
            'fk-thong_tin_hoc_sinh-lop_id',
            '{{%thong_tin_hoc_sinh}}',
            'lop_id',
            '{{%lop}}',
            'id',
        );
//        $this->createTable('{{%mon_hoc}}', [
//            'id' => $this->primaryKey(),
//            'ten_mon_hoc' => $this->text()->notNull(),
//            'created_at' => $this->integer(),
//            'updated_at' => $this->integer(),
//        ],$tableOptions);
//        $this->createTable('{{%diem_mon_hoc}}', [
//            'id' => $this->primaryKey(),
//            'mon_hoc_id' => $this->text()->notNull(),
//            'user_id' => $this->integer(),
//            'diem' => $this->decimal(),
//            'created_at' => $this->integer(),
//            'updated_at' => $this->integer(),
//        ],$tableOptions);
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
