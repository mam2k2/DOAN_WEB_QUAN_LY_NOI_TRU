<?php

use yii\db\Migration;

/**
 * Class m250524_040004_add_table_ticket
 */
class m250524_040004_add_table_ticket extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tickets}}', [
            'id' => $this->primaryKey(),
            'tieu_de' => $this->string(255)->notNull(),
            'noi_dung' => $this->text()->notNull(),
            'danh_muc' =>"ENUM('Sửa chữa', 'Vệ sinh', 'Khác') DEFAULT 'Khác'",
            'trang_thai' => "ENUM('open', 'in_progress', 'closed') DEFAULT 'open'",
            'do_khan_cap' => "ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium'",
            'user_id' => $this->integer()->unsigned(),
            'assigned_to' => $this->integer()->unsigned(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('fk_ticket_user', '{{%tickets}}', 'user_id', \common\models\User::tableName(), 'id', 'SET NULL');
        $this->addForeignKey('fk_ticket_assigned', '{{%tickets}}', 'assigned_to', \common\models\AdminUser::tableName(), 'id', 'SET NULL');
        $this->createTable('{{%attachments}}', [
            'id' => $this->primaryKey(),
            'ticket_id' => $this->integer()->notNull(),
            'file_name' => $this->string(255),
            'file_path' => $this->string(500),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('fk_attachment_ticket', '{{%attachments}}', 'ticket_id', '{{%tickets}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250524_040004_add_table_ticket cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250524_040004_add_table_ticket cannot be reverted.\n";

        return false;
    }
    */
}
