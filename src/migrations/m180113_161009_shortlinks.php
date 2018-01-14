<?php

use yii\db\Migration;

/**
 * Class m180113_161009_shortlinks
 */
class m180113_161009_shortlinks extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%short_links}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(500)->notNull(),
            'short_url' => $this->string(45)->notNull(),
            'date_expire' => $this->date(),
        ], $tableOptions);

        $this->createTable('{{%short_links_info}}', [
            'id' => $this->primaryKey(),
            'info' => 'JSON NOT NULL',
            'link_id' => $this->integer(11)->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'fk_link_id',
            '{{%short_links_info}}',
            'link_id',
            '{{%short_links}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%short_links_info}}');
        $this->dropTable('{{%short_links}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180113_161009_shortlinks cannot be reverted.\n";

        return false;
    }
    */
}
