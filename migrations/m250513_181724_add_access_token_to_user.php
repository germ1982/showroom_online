<?php

use yii\db\Migration;

class m250513_181724_add_access_token_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
public function safeUp()
{
    $this->addColumn('user', 'status', $this->tinyInteger()->notNull()->defaultValue(1)->comment('0=Inactivo, 1=Activo'));
}

public function safeDown()
{
    $this->dropColumn('user', 'status');
}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250513_181724_add_access_token_to_user cannot be reverted.\n";

        return false;
    }
    */
}
