<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class PostController extends Controller

{
    public function actionIndex()
    {
        $connect = Yii::$app->getDb();
        //check db connection
        $schema = $connect->schema->getTableSchemas();
        echo '<pre>';
        print_r($schema);
        die;
        $this->layout = 'home';
        return $this->render('create');
    }
}
