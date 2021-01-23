<?php

use yii\db\Migration;
use  console\components\check;

/**
 * Class m210116_064903_primary
 */
class m210116_064903_primary extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // if (check::indexnCheck("componew", 'col')) {
        //     $this->createIndex(
        //         'new',
        //         'componew',
        //         'col',
        //         'true'
        //     );
        // }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // if (!check::indexnCheck("componew", 'col')) {
        //     $this->dropIndex(
        //         'new',
        //         'componew'
        //     );
        // }
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210116_064903_primary cannot be reverted.\n";

        return false;
    }
    */
}
