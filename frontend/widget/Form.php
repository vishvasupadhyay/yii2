<?php

namespace frontend\widget;

use Yii;


use yii\base\Widget;
use frontend\assets\AppAsset1;
use yii\web\view;
// AppAsset1::register($this);
use frontend\models\RegistrationForm;

class Form extends Widget
{
  public $view;

  public $form;

  public function run()
  {


    $this->view->registerJs(
      "$('#myButton').on('click', function() { alert('clicked!'); });",
      View::POS_READY,
      'my-button-handler'
    );
    $data = RegistrationForm::find()->all();
    AppAsset1::register($this->view);
    return $this->render('user', ['model1' => $data]);
  }
}
