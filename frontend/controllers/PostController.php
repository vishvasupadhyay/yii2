<?php

namespace frontend\controllers;

use Yii\base\Exception;
use Yii;
use frontend\components\EventComponent;
use yii\web\Controller;
use kartik\export\ExportMenu;




use yii\data\ActiveDataProvider;



/**
 * Site controller
 */
class PostController extends Controller

{

    public function actionColumn()

    {
        // $connect = Yii::$app->getDb();
        // //check db connection
        // $schema = $connect->schema->getTableSchemas();
        // echo '<pre>';
        // print_r($schema);
        // die;


        return $this->render('create', [], 'column');
    }
    public function actionLayout()

    {
        // $connect = Yii::$app->getDb();
        // //check db connection
        // $schema = $connect->schema->getTableSchemas();
        // echo '<pre>';
        // print_r($schema);
        // die;


        return $this->render('create', [], 'home');
    }

    public function render($view, $data = [], $layout = null)
    {

        if ($layout == null) {
            $layout = '/layouts/main';
        } else {
            if (file_exists('../views/layouts/' . $layout . '.php'))
                $layout
                    = '/layouts/' . $layout;
            else {
                $layout = '/layouts/main';
            }
        }
        $content = $this->getView()->render($view, $data, $this);
        return $this->getView()->render($layout, ['content' => $content], $this);
    }
    // public function render($view, $data = [])
    // {
    //     $content = $this->getView()->render($view, $data, $this);
    //     return $this->renderContent($content);
    // }

    // public function renderContent($content)
    // {
    //     $layoutFile = $this->findLayoutFile($this->getView());
    //     // print_r($layoutFile);
    //     // die;

    //     if ($layoutFile !== false) {
    //         return $this->getView()->renderFile($layoutFile, ['content' => $content], $this);
    //     }

    //     return $content;
    // }

}
