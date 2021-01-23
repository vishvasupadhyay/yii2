<?php

namespace frontend\components;

use Yii;
use yii\base\Component;


class EventComponent extends  Component
{
    const EVENT_HELLO = 'hello';

    public function bar()
    {
        echo "<script>alert('Hey...!')</script>";
        
    }
}
