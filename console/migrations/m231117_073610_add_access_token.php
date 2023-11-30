<?php

use yii\db\Migration;

/**
 * Class m231117_073610_add_access_token
 */
class m231117_073610_add_access_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("user","access_token",$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("user","access_token");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231117_073610_add_access_token cannot be reverted.\n";

        return false;
    }
    */
}
