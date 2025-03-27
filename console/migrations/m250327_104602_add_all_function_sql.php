<?php

use yii\db\Migration;

/**
 * Class m250327_104602_add_all_function_sql
 */
class m250327_104602_add_all_function_sql extends Migration
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
        // Quản lý khu ký túc xá
        $this->createTable('{{%khu_ktx}}', [
            'id' => $this->primaryKey(),
            'ma_khu' => $this->string(50)->unique()->notNull(),
            'ten_khu' => $this->string(100)->notNull(),
            'vi_tri' => $this->string(100),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);

        // 1. Quản lý phân chia, điều chỉnh phòng ở
        $this->createTable('{{%phong_o}}', [
            'id' => $this->primaryKey(),
            'khu_id' => $this->integer(),
            'ma_phong' => $this->string(50)->unique()->notNull(),
            'ten_phong' => $this->string(100)->notNull(),
            'suc_chua' => $this->integer()->defaultValue(0),
            'so_luong_hien_tai' => $this->integer()->defaultValue(0),
            'vi_tri' => $this->string(100),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey('fk_phongo_khu', '{{%phong_o}}', 'khu_id', '{{%khu_ktx}}', 'id', 'SET NULL');

        $this->createTable('{{%khoan_phi}}', [
            'id' => $this->primaryKey(),
            'ten_khoan_phi' => $this->string(100)->notNull(),
            'loai_phi' => $this->smallInteger()->defaultValue(0)->comment('0-Cố định,1-Linh hoạt'),
            'so_tien' => $this->decimal(10,2)->defaultValue(0),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        // 2. Quản lý thu phí nội trú
        $this->createTable('{{%thu_phi_noi_tru}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'khoan_phi_id' => $this->integer()->notNull(),
            'phong_id' => $this->integer()->notNull(),
            'so_tien' => $this->decimal(10,2)->notNull(),
            'ngay_thu' => $this->date()->notNull(),
            'nguoi_thu' => $this->string(100),
            'trang_thai' => $this->smallInteger()->defaultValue(0)->comment('0-Chưa thu,1-Đã thu'),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey(
            'fk_thuphi_user',
            '{{%thu_phi_noi_tru}}',
            'user_id',
            '{{%da_user}}',
            'id',
            'CASCADE'
        );
        // 3. Quản lý vi phạm nội quy
        $this->createTable('{{%vi_pham_noi_quy}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'loai_vi_pham' => $this->string(255)->notNull(),
            'mo_ta' => $this->text(),
            'ngay_vi_pham' => $this->date(),
            'hinh_thuc_xu_ly' => $this->string(255),
            'nguoi_xu_ly' => $this->string(100),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey('fk_vipham_user', '{{%vi_pham_noi_quy}}', 'user_id', '{{%user}}', 'id', 'CASCADE');

        // 4. Quản lý thiết bị ký túc xá
        $this->createTable('{{%thiet_bi_ktx}}', [
            'id' => $this->primaryKey(),
            'ma_thiet_bi' => $this->string(50)->unique()->notNull(),
            'ten_thiet_bi' => $this->string(100)->notNull(),
            'phong_o_id' => $this->integer(),
            'tinh_trang' => $this->string(100)->defaultValue('Hoạt động'),
            'ngay_bao_tri' => $this->date(),
            'ghi_chu' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey('fk_thietbi_phongo', '{{%thiet_bi_ktx}}', 'phong_o_id', '{{%phong_o}}', 'id', 'SET NULL');

        // 5. Gửi thông báo hệ thống
        $this->createTable('{{%thong_bao_he_thong}}', [
            'id' => $this->primaryKey(),
            'tieu_de' => $this->string(255)->notNull(),
            'noi_dung' => $this->text(),
            'nguoi_gui_id' => $this->integer(),
            'ngay_gui' => $this->integer(),
            'doi_tuong_nhan' => $this->string(50),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ],$tableOptions);
        $this->addForeignKey('fk_phongo_khu', '{{%phong_o}}', 'khu_id', '{{%khu_ktx}}', 'id', 'SET NULL');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250327_104602_add_all_function_sql cannot be reverted.\n";
        $this->dropTable('{{%khoan_phi}}');
        $this->dropTable('{{%thong_bao_he_thong}}');
        $this->dropTable('{{%thiet_bi_ktx}}');
        $this->dropTable('{{%vi_pham_noi_quy}}');
        $this->dropTable('{{%thu_phi_noi_tru}}');
        $this->dropTable('{{%phong_o}}');
        $this->dropTable('{{%khu_ktx}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250327_104602_add_all_function_sql cannot be reverted.\n";

        return false;
    }
    */
}
