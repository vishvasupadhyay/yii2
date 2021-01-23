<?php

use yii\db\Migration;
use console\components\check;

/**
 * Class m210116_042150_index
 */
class m210116_042150_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if (check::indexCheck("componew", 'col')) {
            $this->createIndex(
                'test',
                'componew',
                'col',
                'true'
            );
        }
    }




    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        if (!check::indexCheck("componew", 'col')) {
            $this->dropIndex(
                'test',
                'componew'
            );
        }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210116_042150_index cannot be reverted.\n";

        return false;
    }
    */
}
