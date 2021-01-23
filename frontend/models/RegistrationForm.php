<?php

namespace frontend\models;

use Yii\base\Event;
use Yii;
use yii\db\ActiveRecord;
// use frontend\models\ActiveDataProvider;


// use yii\helpers\Html;
// use yii\widgets\ActiveForm;

class RegistrationForm extends ActiveRecord
{
    /*  public $name;
        public $mobile;
        public $email;
        public $dob;
        public $image;
        public $password;*/
    const SCENARIO_edit = 'edit';
    const SCENARIO_REGISTER = 'register';



    public function init()
    {
        //parent::init();

        $this->on(self::EVENT_AFTER_INSERT, [$this, 'insertmethod'], "After");
        $this->on(
            self::EVENT_BEFORE_INSERT,
            [$this, 'before'],
            'Before'
        );
    }
    public static function tablename()
    {
        return "registration";
    }


    function insertmethod(Event $event)
    {
        echo $event->data;
    }

    function before(Event $event)
    {
        echo $event->data;
    }
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'dob' => 'Dob',
            'image' => 'Image',
            'password' => 'Password'
        ];
    }


    public function insertdata($name, $mobile, $email, $dob, $image, $password, $connect)
    {
        $connect->createCommand()->insert('registration', [
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'dob' => $dob,
            'image' => $image,
            'password' => $password,
        ])->execute();
    }

    public function rules()
    {
        return [

            [
                [
                    'name',
                    'mobile',
                    'email',
                    'dob',
                    'password'
                ],
                'required',
                'on' => ['register', 'edit']
            ],

            ['email', 'email'],

            ['name', 'match', 'pattern' => '/^[a-zA-Z]+( [a-zA-Z_]+)*$/'],

            ['mobile', 'match', 'pattern' => '/^[0-9]*$/'],

            ['mobile', 'string', 'length' => 10],

            ['password', 'string', 'min' => 8],

            [
                'password',
                'match',
                'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/',
                'message' => 'Password should be alpanumberic i.e(Should contain one Captial letter,Number and special characters)'
            ],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['register'] = ['name', 'mobile', 'email', 'dob', 'password']; //Scenario Values Only Accepted
        $scenarios['edit']
            = ['name', 'email', 'dob', 'password'];
        return $scenarios;
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}
