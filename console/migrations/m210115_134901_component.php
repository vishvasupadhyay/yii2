<?php

use yii\db\Migration;
use console\components\check;

/**
 * Class m210115_134901_component
 */
class m210115_134901_component extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if (check::tablename('componew')) {
            $this->createTable(
                'componew',
                [
                    'id' => $this->bigPrimaryKey(),
                    'name' => $this->string(255)->notNull(),
                    'mobile' => $this->bigInteger(10),
                    'email' => $this->string(255)->unique()->notNull(),
                    'DOB' => $this->dateTime(),
                    'image' => $this->text(),
                    'password' => $this->string(100)

                    // (at least 8 characters with 1 block char, 1 special char and 1 number)


                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('componew');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210115_134901_component cannot be reverted.\n";

        return false;
    }
    */
}
