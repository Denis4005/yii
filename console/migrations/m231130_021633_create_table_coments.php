<?php

use yii\db\Migration;

/**
 * Class m231130_021633_create_table_coments
 */
class m231130_021633_create_table_coments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this -> createTable('comments',[
            'id' => $this -> primaryKey(),
            'authorName'=>$this -> string()-> notNull(),
            'postId'=>$this -> integer()-> notNull(),
            'content'=>$this -> string()-> notNull(),
        ]);
        $this->addForeignKey('fkPostId', 'comments', 'postId', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fkAuthorName', 'comments', 'authorName', 'user', 'username', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
        
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231130_021633_create_table_coments cannot be reverted.\n";

        return false;
    }
    */
}
