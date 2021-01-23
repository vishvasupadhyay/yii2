<?php

use yii\db\Migration;
use console\components\check;

/**
 * Class m210115_145721_colum
 */
class m210115_145721_colum extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // $this->createTable(
        //     'componew',
        //     [
        //         'id' => $this->bigPrimaryKey(),
        //         'name' => $this->string(255)->notNull(),
        //         'mobile' => $this->bigInteger(10),
        //         'email' => $this->string(255)->unique()->notNull(),
        //         'DOB' => $this->dateTime(),
        //         'image' => $this->text(),
        //         'password' => $this->string(100)

        //         // (at least 8 characters with 1 block char, 1 special char and 1 number)


        //     ]
        // );
        if (check::columCheck('componew', 'col')) {
            $this->addColumn('componew', 'col', $this->string(255));
        }
        // $this->addColumn('componew', 'col', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210115_145721_colum cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210115_145721_colum cannot be reverted.\n";

        return false;
    }
    */
}
