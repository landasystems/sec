<?php

class SiteController extends Controller {

    public $layout = 'main';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
//        $this->render('index/forum');
        $this->redirect(url('forum'));
    }

    public function actionDashboard() {
        //if not logged, can not access dashboard
        if (isset(user()->id)) {
            $this->layout = 'mainDashboard';
            $this->render('index');
        } else {
            $this->redirect(Yii::app()->user->returnUrl);
        }
    }

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
     * Displays the contact page
     */
    public function actionContact() {
        $this->layout = 'mainSingle';
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }

        $site_config = SiteConfig::model()->listSiteConfig();
        $this->render('contact', array('model' => $model, 'site_config' => $site_config));
    }

   
    public function actionLogin() {
        
        cs()->registerCss('login', '.loginContainer {
    position: relative;
    border:1px solid #c4c4c4;
    width:90%;
    height: auto;
    border-radius: 2px;
    -moz-border-radius:2px;
    -webkit-border-radius:2px;
    -webkit-box-shadow:  0px 0px 1px 1px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, 0.1);
    box-shadow:  0px 0px 1px 1px rgba(0, 0, 0, 0.1);
    background: #fefefe;
    padding:0px 20px 0 20px;
}

.loginContainer:after,.loginContainer:before,.errorContainer:after,.errorContainer:before {
    background: #f9f9f9;
    background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f8f8f8", endColorstr="#f9f9f9",GradientType=0 );
    border: 1px solid #c4c6ca;
    content: "";
    display: block;
    height: 100%;
    left: -1px;
    position: absolute;
    width: 100%;
}
.loginContainer:after, .errorContainer:after {
    -webkit-transform: rotate(2deg);
    -moz-transform: rotate(2deg);
    -ms-transform: rotate(2deg);
    -o-transform: rotate(2deg);
    transform: rotate(2deg);
    top: 0;
    z-index: -1;
}
.loginContainer:before, .errorContainer:before {
    -webkit-transform: rotate(-3deg);
    -moz-transform: rotate(-3deg);
    -ms-transform: rotate(-3deg);
    -o-transform: rotate(-3deg);
    transform: rotate(-3deg);
    top: 0;
    z-index: -2;
}

.loginPage .navbar .brand {float: none; text-align: center; margin:0;}
.loginContainer .forgot {float: right;margin-right: -20px; font-size: 11px;}
.loginContainer .form-horizontal {margin-bottom: 0px;}
.loginContainer .form-actions {
    margin: 0 -20px 0 -20px;
    padding-left:20px !important;
    padding-right: 12px;
}
.loginContainer .form-row .form-label {
    text-align: left;
    padding-right: 27px;
    padding-top: 6px;
    position: relative;
}
#login-form label .icon16 {
    position: absolute;
    right: 0;
    bottom: -28px;
}');
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
            if ($model->validate() && $model->loginMember()) {

                //create user log
                $userLog = new UserLog;
                $userLog->save();

                unset(app()->session['listMenu']); //clear session listmenu
                $this->redirect(url('/forum'));
            }
        }
        // display the login form
//        $this->layout = 'mainSingle';
          $this->layout = 'mainForgot';
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        app()->cache->flush();
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->baseUrl . '/forum');
    }

    public function actionCacheFlush() {
        Yii::app()->cache->flush();
    }

}
