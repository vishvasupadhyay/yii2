<?php

namespace console\components;

use Yii;
use yii\base;



class check
{
    public static function tablename($tablename)
    {
        $tablename = Yii::$app->db->tablePrefix . "$tablename";
        if (Yii::$app->db->getTableSchema($tablename, true) == null) {
            return true;
        } else {
            return false;
        }
    }
    public static function columCheck($table, $name)
    {
        $table = Yii::$app->db->schema->getTableSchema($table);
        if (!isset($table->columns[$name])) {
            return true;
        } else {
            return false;
        }
    }
    public static function indexCheck($table, $name)

    {
        $table = Yii::$app->db->schema->getTableSchema($table, $name);
        if (!isset($table->index[$name])) {
            return true;
        } else {
            return false;
        }
    }
    public static function primaryCheck($table, $name)
    {
        $table = Yii::$app->db->schema->getTableSchema($table, $name);
        if (!isset($table->primary[$name])) {
            return true;
        } else {
            return false;
        }
    }
    public static function indexnCheck($name, $newindex)
    {
        $table = Yii::$app->db->getTableSchema($name);
        $foreign = Yii::$app->db->getTableSchema($name)->foreignKeys;
        $index = Yii::$app->db->Schema->findUniqueIndexes($table);
        //return $foreign;
        if (array_key_exists($newindex, $index) || array_key_exists($newindex, $foreign)) {
            return false;
        } else {
            return true;
        }
    }
}
