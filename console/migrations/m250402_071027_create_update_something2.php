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
//        $this->createTable('{{%lich_hoc}}', [
//            'id' => $this->primaryKey(),
//            'mon_id' => $this->integer(),
//            'thu_trong_tuan' => $this->integer()->notNull(),
//            'tiet' => $this->integer()->notNull(),
//            'thoi_gian_bat_dau' => $this->date(),
//            'thoi_gian_ket_thuc' => $this->date(),
//            'ghi_chu' => $this->text(),
//            'created_at' => $this->integer(),
//            'updated_at' => $this->integer(),
//        ],$tableOptions);
        $this->createTable('{{%y_te}}', [
            'id' => $this->primaryKey(),
            'hoc_sinh_id' => $this->integer()->unsigned(),
            'ngay_bi_benh' => $this->integer()->notNull(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

        ],$tableOptions);
        $this->createTable('{{%diem_danh}}', [
            'id' => $this->primaryKey(),
            'hoc_sinh_id' => $this->integer()->unsigned(),
            'phong_id' => $this->integer(),
            'ngay_diem_danh' => $this->date()->notNull(),
            'thoi_gian' => $this->dateTime(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        // y_te → user
        $this->addForeignKey(
            'fk_y_te_user_id',
            '{{%y_te}}',
            'hoc_sinh_id',
            '{{%thong_tin_hoc_sinh}}',
            'id',
        );

// diem_danh → user
        $this->addForeignKey(
            'fk_diem_danh_user_id',
            '{{%diem_danh}}',
            'hoc_sinh_id',
            '{{%thong_tin_hoc_sinh}}',
            'id',

        );

// diem_danh → phong_o
        $this->addForeignKey(
            'fk_diem_danh_phong_id',
            '{{%diem_danh}}',
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
