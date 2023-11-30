<?php

use yii\db\Migration;

/**
 * Class m231108_185918_test
 */
class m231108_185918_test extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this -> createTable('posts',[
            'id' => $this -> primaryKey(),
            'namePost'=>$this -> string()-> notNull(),
            'content'=>$this -> string()-> notNull(),
            'data' => $this -> date()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('posts');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231108_185918_test cannot be reverted.\n";

        return false;
    }
    */
}
