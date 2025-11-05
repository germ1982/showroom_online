<?php

use yii\db\Migration;

class m250514_122339_add_status_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250514_122339_add_status_to_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250514_122339_add_status_to_user cannot be reverted.\n";

        return false;
    }
    */
}
