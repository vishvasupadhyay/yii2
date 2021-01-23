<?php

namespace frontend\controllers;

use Yii\base\Exception;
use Yii;
use frontend\components\EventComponent;
use yii\web\Controller;
use kartik\export\ExportMenu;
use frontend\models\ImportCsv;
use yii\web\UploadedFile;
use frontend\models\RegistrationForm;

use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class RegisterController extends Controller

{
    const EVENT_HELLO = 'hello';

    public function actionTest()
    {
        $obj = new EventComponent();
        $this->on(EventComponent::EVENT_HELLO, [$obj, 'bar']);
        $this->trigger(self::EVENT_HELLO);
        $this->off(EventComponent::EVENT_HELLO);
    }

    // -----csvImport-----


    public function actionImport()
    {
        $model = new ImportCsv();
        $variable = false;
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/' . $model->file);
            $name = $model->file;
            $model->file = null;
            // echo $name;
            // die;
            $file = fopen('uploads/' . $name, "r");


            while ($filename = fgetcsv($file)) {
                // print_r($filename);
                if (!$variable) {
                    $variable = true;
                } else {


                    $model = new ImportCsv();
                    $model->name = $filename[1];
                    $model->mobile = $filename[2];
                    $model->dob = $filename[3];
                    $model->email = $filename[4];
                    $model->image = $filename[5];
                    $model->password = $filename[6];
                    // print_r($model);
                    $model->save(false);
                }
            }
        } else {

            return $this->render('import', ['model' => $model]);
        }
    }
    // -----csvExport-----


    public function actionExport()
    {
        $query = RegistrationForm::find();

        $provider = new ActiveDataProvider([
            'query' => $query,


        ]);
        $gridColumns = [
            'id',
            'name',
            'mobile',
            'dob',
            'email',
            'image',
            'password',


        ];
        return $this->render('create', ['provider' => $provider, 'gridColumns' => $gridColumns]);
    }








    public function actionIndex()
    {
        // Yii::$app->eventCustom->trigger(EventComponent::EVENT_HELLO);
        $connect = Yii::$app->get('db2');
        $model = new RegistrationForm();
        $model->scenario = RegistrationForm::SCENARIO_REGISTER;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = Yii::$app->request->post('RegistrationForm');
            $model->name = $data['name'];
            $model->mobile = $data['mobile'];
            $model->email = $data['email'];
            $model->dob = $data['dob'];
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->image->saveAs('uploads/' . $model->name . '.' . $model->image->extension);
            $model->image = 'uploads/' . $model->name . '.' . $model->image->extension;
            $model->password = $data['password'];
            $model->save();
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            Yii::$app->mailer->compose()
                ->setFrom('foroffice438@gmail.com')
                ->setTo($model->email)
                ->setSubject('')
                ->setTextBody('')
                ->setHtmlBody('<b>HTML content <i>;Hey Vishvas here....! Thank you for register...! See you Soon...</i></b>')
                ->send();

            //newdb
            $name = $model->name;
            $mobile = $model->mobile;
            $email = $model->email;
            $dob = $model->dob;
            $image = $model->image;
            $password = $model->password;

            $model->save();
            $model->insertdata($name, $mobile, $email, $dob, $image, $password, $connect);

            $model->name = '';
            $model->mobile = '';
            $model->email = '';
            $model->dob = '';
            $model->image = '';
            $model->password = '';
            $this->redirect('register/viewcache');

            return $this->render('registration', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('registration', ['model' => $model]);
        }
    }
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionView($view)
    {
        $model = RegistrationForm::findOne($view);

        return $this->render('view', ['model' => $model]);
    }
    public function actionUser()
    {
        $data = RegistrationForm::find()->all();

        return $this->render('user', ['data' => $data]);

        // print_r('$data');
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionEdit($edit)
    {
        $Ed = $edit;
        $model = new RegistrationForm();
        $model =  RegistrationForm::findOne($Ed);
        $model->scenario = RegistrationForm::SCENARIO_edit;




        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            $this->redirect('user');
            return $this->render('registration', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('registration', ['model' => $model]);
        }
    }

    public function actionDelete($delete)
    {
        $model = new RegistrationForm();
        $model = RegistrationForm::findOne($delete);
        $model->delete();
        return $this->redirect('user');
    }


    public function  actionLogin()
    {
        $model = new RegistrationForm();
        $model->scenario = 'login';
    }


    // scenario is set through configuration
    public function  actionRegister()
    {
        $model = new RegistrationForm(['scenario' => 'register']);
    }


    public function actionWidgete()
    {
        return $this->render('tests');
    }

    public function actionWidget()
    {
        return $this->render('new');
    }


    public function actionViewcache()
    {
        $connect = Yii::$app->get('db2');
        $cache = Yii::$app->cache;
        $key = 'new';
        $data = $cache->get($key);

        if ($data === false) {
            // $data is not found in cache, calculate it from scratch
            $data = $connect->createcommand('SELECT * FROM `registration`')->queryALL();
            $cache->set($key, $data);
            // store $data in cache so that it can be retrieved next time

        }
        return $this->render('user', ['data' => $data]);
    }
    public function actionDeletecache()
    {
        Yii::$app->cache->flush();
        $this->redirect('viewcache');
    }
    public function actionCurl()
    {
        $model = new RegistrationForm();
        //print_r(Yii::$app->request->post());die;
        // RegistrationForm::setDb(RegistrationForm::DB_DATABASE2);
        //print_r(Yii::$app->request->post());
        $data = json_decode(file_get_contents('php://input'), true);
        $model->dob = $data['RegistrationForm']['dob'];
        if ($model->load($data)) {
            // $data = Yii::$app->request->post();
            // $model->name = $data['name'];
            // $model->mobile = $data['mobile'];
            // $model->email = $data['email'];
            // $model->password = $data['password'];
            // $model->dob = $data['dob'];
            // $model->image = $data['image'];
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Done');
                print_r("success");
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                print_r("failed");
            }
        }
    }

    public function actionCurl2()
    {
        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = Yii::$app->request->post();
            // RegistrationForm::setDb(RegistrationForm::DB_DATABASE2);
            $postData = json_encode(Yii::$app->request->post());
            //print_r($postData);
            // $model->name = $data['name'];
            // $model->mobile = $data['mobile'];
            // $model->email = $data['email'];
            // $model->dob = $data['dob'];
            // $model->password = $data['password'];
            // $model->image = UploadedFile::getInstance($model, 'image');
            // $model->image->saveAs('uploads/' . $model->image);
            // $model->image = 'uploads/' . $model->image;
            $handle = curl_init();

            $url = "http://localhost/Training/yii/yii-application/frontend/web/register/curl";

            // $postData = array(
            //     'name' => $model->name,
            //     'email' => $model->email,
            //     'mobile' => $model->mobile,
            //     'dob' => $model->dob,
            //     'image' => $model->image,
            //     'password' => $model->password

            // );

            curl_setopt_array(
                $handle,
                array(
                    CURLOPT_URL => $url,
                    // Enable the post response.
                    CURLOPT_POST => true,
                    // The data to transfer with the response.
                    CURLOPT_POSTFIELDS => $postData,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array('Content-Type:application/json')
                )
            );

            $data = curl_exec($handle);

            curl_close($handle);

            if ($data == "success") {
                return $this->redirect('user');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error.');
            }
        } else {
            return $this->render('registration', [
                'model' => $model,
            ]);
        }
    }
}
