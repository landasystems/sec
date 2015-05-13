<?php

class SiteController extends Controller {

    public $layout = 'main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('error', 'login', 'logout', 'icons', 'forgotPassword', 'sendEmail', 'changePassword', 'savePassword'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'changePassword'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
//        Yii::import("xupload.models.XUploadForm");
//        $model = new XUploadForm;
//        $this -> render('index', array('model' => $model, ));


        $this->layout = 'main';
        $this->render('index');
    }

    public function actionIcons() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
//        Yii::import("xupload.models.XUploadForm");
//        $model = new XUploadForm;
//        $this -> render('index', array('model' => $model, ));
        $this->layout = 'main';
        $this->render('themes/icons');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = 'blank';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        //disable login page if logged
        if (isset(user()->id)) {
            $this->redirect(Yii::app()->user->returnUrl);
        }


        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
//                $siteConfig = SiteConfig::model()->listSiteConfig();
//                $siteSes = $siteConfig->attributes;
//                $siteSes['city_name'] = $siteConfig->City->name;
//                $siteSes['province_name'] = $siteConfig->City->Province->name;
//                Yii::app()->session['site'] = $siteSes;
                //create user log
                $userLog = new UserLog;
                $userLog->save();

                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->layout = 'blankHeader';
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        app()->cache->flush();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->baseUrl . '/site/login.html');
    }

    public function actionForgotPassword() {
        $this->layout = 'blankHeader';
        $this->render('forgotPassword', array());
    }

    public function actionSendEmail() {
        if (empty($_POST['email'])) {
            user()->setFlash('success', '<strong></strong>Masukan alamat email anda.');
            $this->layout = 'blankHeader';
            $this->render('forgotPassword', array());
        } else {
            $user = User::model()->find("email='" . $_POST['email'] . "'");
            if (empty($user)) {
                user()->setFlash('error', '<strong></strong>Email yang anda masukkan tidak terdaftar.');
                $this->layout = 'blankHeader';
                $this->render('forgotPassword', array());
            } else {
                $siteConfig = SiteConfig::model()->listSiteConfig();
                $emailContent = '<a href="' . bu('site/changePassword/?hash=' . md5($user->id), true) . '">Ganti password anda disini.</a>';
                Email::model()->send($siteConfig->email, $_POST['email'], 'Reset Password @' . param('client'), $emailContent, FALSE);
                user()->setFlash('success', 'You will receive an email with instructions on how to reset your password in a few minutes..');
                $this->redirect(url('site/login'));
            }
        }
    }

    public function actionChangePassword() {
        $id = $_GET['hash'];
        $mUser = User::model()->find(array('condition' => 'md5(id)="' . $id . '"'));
        $sId = $mUser->id;
        $this->layout = 'blankHeader';
        $this->render('formChangePassword', array('id' => $sId));
    }

    public function actionSavePassword() {
        if (empty($_POST['password'])) {
            user()->setFlash('success', '<strong>Masukan password baru anda.</strong>');
            $this->layout = 'blankHeader';
            $this->render('formChangePassword', array());
        } else {
            if (isset($_POST['password'])) {
                $mUser = User::model()->find(array('condition' => 'md5(id)="' . $_POST['id'] . '"'));
                $mUser->password = sha1(trim($_POST['password']));
                $mUser->save();
                user()->setFlash('success', 'Login now with new password.');
                $this->redirect(url('site/login'));
            }
        }
//            $this->redirect(url('change-password'), array());
    }

//    public function loadModel($id) {
//        $model = User::model()->findByPk($id);
//        if ($model === null)
//            throw new CHttpException(404, 'The requested page does not exist.');
//        return $model;
//    }
    

}
