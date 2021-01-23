<?php

use yii\db\Migration;

/**
 * Class m210120_040001_newdb
 */
class m210120_040001_newdb extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'registration',
            [
                'id' => $this->bigPrimaryKey(),
                'name' => $this->string(255)->notNull(),
                'mobile' => $this->bigInteger(10),
                'email' => $this->string(255)->unique()->notNull(),
                'dob' => $this->dateTime(),
                'image' => $this->text(),
                'password' => $this->string(100)

                // (at least 8 characters with 1 block char, 1 special char and 1 number)


            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210120_040001_newdb cannot be reverted.\n";

        return false;
    }
    */
}
