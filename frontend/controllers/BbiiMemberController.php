<?php

class BbiiMemberController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainSingle';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
//            array('allow', // c
//                'actions' => array('create'),
//                'expression' => 'app()->controller->isValidAccess("Donation","c")'
//            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Donation","r")'
            ),
//            array('allow', // u
//                'actions' => array('update'),
//                'expression' => 'app()->controller->isValidAccess("Donation","u")'
//            ),
//            array('allow', // d
//                'actions' => array('delete'),
//                'expression' => 'app()->controller->isValidAccess("Donation","d")'
//            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        if (isset($_GET['access']) && $_GET['access'] == 'login')
            $this->layout = 'mainDashboardSingle';
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionViewSuccess($id) {
        if (isset($_GET['access']) && $_GET['access'] == 'login')
            $this->layout = 'mainDashboardSingle';
        $this->render('viewsuccess', array(
            'model' => $this->loadModel($id),
        ));
    }

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

    public function actionCoba() {
        echo'dfdfg';
    }

    public function actionChangeModerator() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (isset($_POST['buttonmoderator'])) {
                $model = BbiiMember::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->moderator = 1;
                    $a->save();
                }
//                print_r($_POST['id']);
                user()->setFlash('info', 'User is enabled to moderator now.');
                $this->redirect(array('bbiiMember/index'));
            } else if (isset($_POST['buttondelmoderator'])) {
                $model = BbiiMember::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->moderator = 0;
                    $a->save();
                }
                user()->setFlash('info', 'User is disabled from moderator now.');
                $this->redirect(array('bbiiMember/index'));
            } else {
                BbiiMember::model()->deleteAll('id IN (' . implode(',', $_POST['id']) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>User is deleted.');
                $this->redirect(array('user/index'));
            }
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please chekked user and then choose the button.');
            $this->redirect(array('bbiiMember/index'));
        }
    }

    public function actionAnggota() {
        if (isset($_POST['code'])) {
            $cek_user = BbiiMember::model()->findByAttributes(array('username' => $_POST['code']));
            if (empty($cek_user)) {
                $user = UserSawiran::model()->findByAttributes(array('code' => $_POST['code']));
                if (!empty($user)) {
                    echo $user->name;
                } else {
                    echo 'gagal';
                }
            } else {
                echo 'terdaftar';
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new BbiiMember;
        $model->scenario = 'register';
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BbiiMember']) && isset($_POST['business_id']) && isset($_POST['city_id'])) {
            $model->attributes = $_POST['BbiiMember'];
            $model->password = sha1($model->password);
            $model->business_id = $_POST['business_id'];
            $model->city_id = $_POST['city_id'];
            $model->email = $_POST['BbiiMember']['email'];
            $model->code = $_POST['BbiiMember']['code'];
            $model->phone = $_POST['BbiiMember']['phone'];
            $model->pin = $_POST['BbiiMember']['pin'];
            $model->first_visit = date('Y-m-d H:i:s');
            $model->group_id = 1;
            mkdir(param('pathImg') . $_POST['BbiiMember']['code'], 0777);

            $file = CUploadedFile::getInstance($model, 'avatar');
            if (is_object($file)) {
                $model->avatar = Yii::app()->landa->urlParsing($model->member_name) . '.' . $file->extensionName;
            } else {
                unset($model->avatar);
            }
            if ($model->save())
                if (is_object($file)) {
                    $file->saveAs(param('pathImg') . 'avatar/' . $model->avatar);
                    Yii::app()->landa->createImg('avatar/', $model->avatar, $model->id);
                }
            $this->redirect(array('viewsuccess', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $tempPass = $model->password;
        if (isset($_POST['BbiiMember'])) {
            $model->attributes = $_POST['BbiiMember'];
            if (!empty($model->password)) { //not empty, change the password
                $model->password = sha1($model->password);
            } else {
                $model->password = $tempPass;
            }
            $model->business_id = $_POST['BbiiMember']['business_id'];
            $model->city_id = $_POST['BbiiMember']['city_id'];
            $model->email = $_POST['BbiiMember']['email'];
            $model->code = $_POST['BbiiMember']['code'];
            $model->phone = $_POST['BbiiMember']['phone'];

            $file = CUploadedFile::getInstance($model, 'avatar');
            if (is_object($file)) {
                $model->avatar = Yii::app()->landa->urlParsing($model->member_name) . '.' . $file->extensionName;
                $file->saveAs('images/avatar/' . $model->avatar);
                Yii::app()->landa->createImg('avatar/', $model->avatar, $model->id);
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionConfirmRegistration($id) {
        $mUser = BbiiMember::model()->find(array('condition' => 'md5(id)="' . $id . '"'));
        if (empty($mUser)) {
            user()->setFlash('error', '<strong>Error! </strong>Wrong activation code.');
        } else {
            $mUser->enabled = 1;
            $mUser->save();
            user()->setFlash('success', '<strong>Success : </strong>Your Registration have been accepted, you can login now.');
        }
        $this->render('confirmRegistration', array(
        ));
    }

    public function actionForgotPassword() {
        $this->layout = 'mainForgot';
        $this->render('forgotPassword', array(
        ));
    }

    public function actionKirim() {
        
        Email::model()->sending("yulianto@landa.co.id","SEC CU Sawiran","info@sec.cusawiran.org", 'Reset Password - ' . param('client'), "kakakkaka");
    }

    public function actionSendEmail() {
        if (empty($_POST['email'])) {
            user()->setFlash('success', '<strong></strong>Masukan alamat email anda.');
            $this->redirect(url('forgot-password'));
        } else {
            $user = BbiiMember::model()->find("email='" . $_POST['email'] . "'");
            if (empty($user)) {
                user()->setFlash('error', '<strong></strong>Email yang anda masukkan tidak terdaftar.');
                $this->redirect(url('forgot-password'));
            } else {
                $siteConfig = SiteConfig::model()->listSiteConfig();

                $emailContent = '
                    <table border="1" cellspacing="0" co<table border="0" cellpadding="0" cellspacing="0" style="font-size: 13px" width="650px">
    <tbody>
        <tr>
            <td style="text-align: center">
                <div style="background-color:#e1ecf9;margin: 3px;border:1px solid #bfd7ff;width: 642;padding: 10px 0;">
                    <h2 style="margin: 0px">SEC Cusawiran</h2>
                    <em style="font-size:11px">Jl. L.A. Sucipto 46, kota malang, jawa timur.  (0341) 474768 - Mail : cusawiran@cusawiran.org</em><br />
                    <br />
                    <b>Konfirmasi Reset Password</b></div>

                <table style="font-size: 13px" width="650px">
                    <tbody>
                        <tr>
                            <td style="text-align: left;"><br />
                               Apakah benar identitas diri anda seperti di bawah ?:</td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-left: 50px">
                                <table cellpadding="4" style="font-size: 13px" width="100%">
                                    <tbody>
                                        <tr valign="top">
                                            <td style="text-align: left;" width="20%">Nama</td>
                                            <td style="text-align: left;" width="1%">:</td>
                                            <td style="text-align: left;" width="79%">' . ucwords($user->member_name) . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Email</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $user->email . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">Username</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . $user->username . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">NBA Anggota</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;"> ' . $user->code . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;">No Telp</td>
                                            <td style="text-align: left;">:</td>
                                            <td style="text-align: left;">' . landa()->hp($user->phone) . '</td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="text-align: left;"></td>
                                            <td style="text-align: left;"></td>
                                            <td style="text-align: left;"><a href="' . bu('change-password/' . md5($user->id), true) . '">Ganti password anda disini.</a></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
                Email::model()->send($siteConfig->email, $_POST['email'], 'Reset Password @' . param('client'), $emailContent, FALSE);
                user()->setFlash('success', 'You will receive an email with instructions on how to reset your password in a few minutes..');
                $this->redirect(url('site/login'));
            }
        }
    }

    public function actionChangePassword($id) {
        $this->layout = 'mainForgot';
        $mUser = BbiiMember::model()->find(array('condition' => 'md5(id)="' . $id . '"'));
        $sId = $mUser->id;
        $this->render('formChangePassword', array('id' => $sId));
    }

    public function actionSavePassword() {
        if (empty($_POST['password'])) {
            user()->setFlash('success', '<strong>Masukan password baru anda.</strong>');
            $this->redirect(url('change-password/' . $_POST['id']));
        } else {
            if (isset($_POST['password'])) {
                $mUser = BbiiMember::model()->find(array('condition' => 'md5(id)="' . $_POST['id'] . '"'));
                $mUser->password = sha1(trim($_POST['password']));
                $mUser->save();
                user()->setFlash('success', 'Login now with new password.');
                $this->redirect(url('site/login'));
            }
        }
//            $this->redirect(url('change-password'), array());
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $model = new BbiiMember('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['BbiiMember'])) {
            $model->attributes = $_GET['BbiiMember'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->member_name))
                $criteria->addCondition('member_name = "' . $model->member_name . '"');


            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');


            if (!empty($model->gender))
                $criteria->addCondition('gender = "' . $model->gender . '"');


            if (!empty($model->birthdate))
                $criteria->addCondition('birthdate = "' . $model->birthdate . '"');


            if (!empty($model->location))
                $criteria->addCondition('location = "' . $model->location . '"');


            if (!empty($model->personal_text))
                $criteria->addCondition('personal_text = "' . $model->personal_text . '"');


            if (!empty($model->signature))
                $criteria->addCondition('signature = "' . $model->signature . '"');


            if (!empty($model->avatar))
                $criteria->addCondition('avatar = "' . $model->avatar . '"');


            if (!empty($model->show_online))
                $criteria->addCondition('show_online = "' . $model->show_online . '"');


            if (!empty($model->contact_email))
                $criteria->addCondition('contact_email = "' . $model->contact_email . '"');


            if (!empty($model->contact_pm))
                $criteria->addCondition('contact_pm = "' . $model->contact_pm . '"');


            if (!empty($model->timezone))
                $criteria->addCondition('timezone = "' . $model->timezone . '"');


            if (!empty($model->first_visit))
                $criteria->addCondition('first_visit = "' . $model->first_visit . '"');


            if (!empty($model->last_visit))
                $criteria->addCondition('last_visit = "' . $model->last_visit . '"');


            if (!empty($model->warning))
                $criteria->addCondition('warning = "' . $model->warning . '"');


            if (!empty($model->posts))
                $criteria->addCondition('posts = "' . $model->posts . '"');


            if (!empty($model->group_id))
                $criteria->addCondition('group_id = "' . $model->group_id . '"');


            if (!empty($model->upvoted))
                $criteria->addCondition('upvoted = "' . $model->upvoted . '"');


            if (!empty($model->blogger))
                $criteria->addCondition('blogger = "' . $model->blogger . '"');


            if (!empty($model->facebook))
                $criteria->addCondition('facebook = "' . $model->facebook . '"');


            if (!empty($model->flickr))
                $criteria->addCondition('flickr = "' . $model->flickr . '"');


            if (!empty($model->google))
                $criteria->addCondition('google = "' . $model->google . '"');


            if (!empty($model->linkedin))
                $criteria->addCondition('linkedin = "' . $model->linkedin . '"');


            if (!empty($model->metacafe))
                $criteria->addCondition('metacafe = "' . $model->metacafe . '"');


            if (!empty($model->myspace))
                $criteria->addCondition('myspace = "' . $model->myspace . '"');


            if (!empty($model->orkut))
                $criteria->addCondition('orkut = "' . $model->orkut . '"');


            if (!empty($model->tumblr))
                $criteria->addCondition('tumblr = "' . $model->tumblr . '"');


            if (!empty($model->twitter))
                $criteria->addCondition('twitter = "' . $model->twitter . '"');


            if (!empty($model->website))
                $criteria->addCondition('website = "' . $model->website . '"');


            if (!empty($model->wordpress))
                $criteria->addCondition('wordpress = "' . $model->wordpress . '"');


            if (!empty($model->yahoo))
                $criteria->addCondition('yahoo = "' . $model->yahoo . '"');


            if (!empty($model->youtube))
                $criteria->addCondition('youtube = "' . $model->youtube . '"');


            if (!empty($model->moderator))
                $criteria->addCondition('moderator = "' . $model->moderator . '"');
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = BbiiMember::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bbii-member-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
