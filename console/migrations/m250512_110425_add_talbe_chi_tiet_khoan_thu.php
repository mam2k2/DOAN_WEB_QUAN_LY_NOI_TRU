<?php

use yii\db\Migration;

/**
 * Class m250512_110425_add_talbe_chi_tiet_khoan_thu
 */
class m250512_110425_add_talbe_chi_tiet_khoan_thu extends Migration
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
        $this->createTable('{{%chi_tiet_khoan_thu}}', [
            'id' => $this->primaryKey(),
            'thu_phi_noi_tru_id' => $this->integer()->notNull(),
            'khoan_phi_id' => $this->integer()->notNull(),
            'so_tien' => $this->decimal(10,2)->notNull(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);

        $this->addForeignKey(
            'fk_chi_tiet_thu_phi_noi_tru_id',
            '{{%chi_tiet_khoan_thu}}',
            'thu_phi_noi_tru_id',
            '{{%thu_phi_noi_tru}}',
            'id',
        );

        $this->addForeignKey(
            'fk_chi_tiet_khoan_phi_id',
            '{{%chi_tiet_khoan_thu}}',
            'khoan_phi_id',
            '{{%khoan_phi}}',
            'id',
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250512_110425_add_talbe_chi_tiet_khoan_thu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250512_110425_add_talbe_chi_tiet_khoan_thu cannot be reverted.\n";

        return false;
    }
    */
}
