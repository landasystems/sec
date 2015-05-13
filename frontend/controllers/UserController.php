<?php

class UserController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainSingle';

    /**
     * @return array action filters
     */
//    public function filters() {
//        return array(
//            'rights', // perform access control for CRUD operations
//        );
//    }

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
        $this->layout = 'mainSingle';
        $model = User::model()->findByPk($id);
        $this->render('viewSuccess', array(
            'model' => $model,
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCoba(){
        echo 'aaaaa';
    }
    public function actionAnggota() {
        if (isset($_POST['code'])) {
            $cek_user = User::model()->findByAttributes(array('username' => $_POST['code']));
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

    public function actionCreate() {
        $listSiteConfig = SiteConfig::model()->listSiteConfig();

        $model = new User;
        $model->scenario = 'register';
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
//            $model->email = $_POST['User']['email'];
//            $model->phone = $_POST['User']['phone'];
//            $model->type_business = $_POST['User']['type_business'];
//            $model->company_name = $_POST['User']['company_name'];
            $model->city_id = $_POST['city_id'];
            $model->business_id = $_POST['business_id'];
            $realPassword = $model->password;
            $model->password = sha1($model->password);


//            $model->others = json_encode($other);
            $file = CUploadedFile::getInstance($model, 'avatar_img');
            if (is_object($file)) {
                $model->avatar_img = Yii::app()->landa->urlParsing($model->name) . '.' . $file->extensionName;
            } else {
                unset($model->avatar_img);
            }

            $model->roles_id = (isset($listSiteConfig['settings']['register_user_id'])) ? $listSiteConfig['settings']['register_user_id'] : 0;
            $model->enabled = 1;
            if ($model->save()) {

                //create image if any file
                if (is_object($file)) {
                    $file->saveAs(param('pathImg') . 'avatar/' . $model->avatar_img);
                    Yii::app()->landa->createImg('avatar/', $model->avatar_img, $model->id);
                }
                //save to send email
                $siteConfig = SiteConfig::model()->listSiteConfig();

                $emailContent = $siteConfig->mail_register;
                $emailContent = str_replace('{name}', $model->name, $emailContent);
                $emailContent = str_replace('{username}', $model->username, $emailContent);
                $emailContent = str_replace('{email}', $model->email, $emailContent);
                $emailContent = str_replace('{password}', $realPassword, $emailContent);
                $emailContent = str_replace('{confirm}', '<a href="' . bu('confirm-registration/' . md5($model->id), true) . '">Konfirmasi registrasi anda disini.</a>', $emailContent);

                Email::model()->send($siteConfig->email, $model->email, 'Confirm Your Registration Account @' . param('client'), $emailContent, TRUE);
                $this->redirect(array('viewSuccess', 'id' => $model->id));

                $model = new User;
                Yii::app()->user->setFlash('success', "Your account successful created but not confirm yet.<br>
                                    Check your email account to confirm last step of our registration");
            } else {
                $model->password = '';
            }
        }

        $this->render('create', array(
            'model' => $model,
//            'param' => json_decode($_GET['menuParam']),
            'listSiteConfig' => $listSiteConfig,
        ));
    }

    public function actionConfirmRegistration($id) {
        $mUser = User::model()->find(array('condition' => 'md5(id)="' . $id . '"'));
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
        $this->render('forgotPassword', array(
        ));
    }

    public function actionSendEmail() {
        if (empty($_POST['email'])) {
            user()->setFlash('success', '<strong></strong>Masukan alamat email anda.');
            $this->redirect(url('forgot-password'));
        } else {
            $user = User::model()->find("email='" . $_POST['email'] . "'");
            if (empty($user)) {
                user()->setFlash('error', '<strong></strong>Email yang anda masukkan tidak terdaftar.');
                $this->redirect(url('forgot-password'));
            } else {
                $siteConfig = SiteConfig::model()->listSiteConfig();
                $emailContent = '<a href="' . bu('change-password/' . md5($user->id), true) . '">Ganti password anda disini.</a>';
                Email::model()->send($siteConfig->email, $_POST['email'], 'Reset Password @' . param('client'), $emailContent, FALSE);
                user()->setFlash('success', 'You will receive an email with instructions on how to reset your password in a few minutes..');
                $this->redirect(url('site/login'));
            }
        }
    }

    public function actionChangePassword($id) {
        $mUser = User::model()->find(array('condition' => 'md5(id)="' . $id . '"'));
        $sId = $mUser->id;
        $this->render('formChangePassword', array('id' => $sId));
    }

    public function actionSavePassword() {
        if (empty($_POST['password'])) {
            user()->setFlash('success', '<strong>Masukan password baru anda.</strong>');
            $this->redirect(url('change-password/' . $_POST['id']));
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

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $this->layout = 'mainDashboardSingle';
        $listSiteConfig = SiteConfig::model()->listSiteConfig();
//        $model = $this->loadModel($id);
////        $tempRoles = $model->roles;
//        $tempPass = $model->password;
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
//                                        e.preventDefault();
//                                        $(this).tab("show");
//                                    })');
//
//        if (isset($_POST['User'])) {
//            $model->attributes = $_POST['User'];
//            if ($model->password == $tempPass) {
//                
//            } else {
//                $model->password = sha1($model->password);
//            }
//
//            $file = CUploadedFile::getInstance($model, 'avatar_img');
//            if (is_object($file)) {
//                $model->avatar_img = Yii::app()->landa->urlParsing($model->name) . '.' . $file->extensionName;
//                $file->saveAs(param('pathImg') . 'avatar/' . $model->avatar_img);
//                Yii::app()->landa->createImg('avatar/', $model->avatar_img, $model->id);
//            }
//
//            if ($model->save()) {
//                //check if any change in roles, revoke then assign new role
////                if ($tempRoles != $model->roles) {
////                    $model->revokeRoles($tempRoles, $model->id);
////                    $model->assignRoles($model->roles, $model->id);
////                }
//
//                $this->redirect(array('view', 'id' => $model->id));
//            }
//        }
//
//        $this->render('update', array(
//            'model' => $model,
//        ));

        $listRoles = Roles::model()->listRoles();
        $model = $this->loadModel($id);

//        $model->scenario == 'allow';
        if (!empty($_GET['type']))
            $type = $_GET['type'];
        else
            $type = 'user';

//        if ($type != 'user')
//            $model->scenario == 'notAllow';

        $tempRoles = $model->roles_id;
        $tempPass = $model->password;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');

        if (isset($listRoles[$model->roles_id])) {
            if ($listRoles[$model->roles_id]['is_allow_login'] == 0)
                $model->scenario = 'notAllow';
            else
                $model->scenario = 'allow';
        }


        if (isset($_POST['User'])) {

            $model->attributes = $_POST['User'];
            $others = json_decode($model->others, true);
            if (isset($others['mlm_action'])) {
                $other['mlm_action'] = $others['mlm_action'];
            }
            if (isset($others['mlm_silver'])) {
                $other['mlm_silver'] = $others['mlm_silver'];
            } else {
                $other['mlm_silver'] = '';
            }
            if (isset($others['mlm_gold_slot'])) {
                $other['mlm_gold_slot'] = $others['mlm_gold_slot'];
            } else {
                $other['mlm_gold_slot'] = '';
            }
            if (isset($_POST['User']['bank_name'])) {
                $other['bank_name'] = $_POST['User']['bank_name'];
            } else {
                $other['bank_name'] = "";
            }
            if (isset($_POST['User']['bank_account'])) {
                $other['bank_account'] = $_POST['User']['bank_account'];
            } else {
                $other['bank_account'] = "";
            }
            if (isset($_POST['User']['bank_account_name'])) {
                $other['bank_account_name'] = $_POST['User']['bank_account_name'];
            } else {
                $other['bank_account_name'] = "";
            }
            if (isset($others['time_action'])) {
                $other['time_action'] = $others['time_action'];
            } else {
                $other['time_action'] = "";
            }

            $model->others = json_encode($other);
            if (!empty($model->password)) { //not empty, change the password
                $model->password = sha1($model->password);
            } else {
                $model->password = $tempPass;
            }

            $file = CUploadedFile::getInstance($model, 'avatar_img');
            if (is_object($file)) {
                $model->avatar_img = Yii::app()->landa->urlParsing($model->name) . '.' . $file->extensionName;
                $file->saveAs(param('pathImg') . 'avatar/' . $model->avatar_img);
                Yii::app()->landa->createImg('avatar/', $model->avatar_img, $model->id);
            }

            if ($model->save()) {
                //check if any change in roles, revoke then assign new role
//                if ($tempRoles != $model->roles) {
//                    $model->revokeRoles($tempRoles, $model->id);
//                    $model->assignRoles($model->roles, $model->id);
//                }
                unset(Yii::app()->session['listUser']);
                unset(Yii::app()->session['listUserPhone']);
                $this->redirect(array('view', 'id' => $model->id, 'type' => $type));
            }
        }
        unset($model->password);
//        if ($type != 'user')
//            $model->scenario == 'allow';

        $this->render('update', array(
            'model' => $model,
            'type' => $type,
            'listSiteConfig' => $listSiteConfig,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
//    public function actionDelete($id) {
//        if (Yii::app()->request->isPostRequest) {
//            // we only allow deletion via POST request
//            $this->loadModel($id)->delete();
//
//            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//        }
//        else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
//    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
            $roles = (isset($_GET['User']['roles'])) ? $_GET['User']['roles'] : '';




            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');




            if (!empty($model->employeenum))
                $criteria->addCondition('employeenum = "' . $model->employeenum . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');


            if (!empty($model->address))
                $criteria->addCondition('address = "' . $model->address . '"');


            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'student',
            'param' => json_decode($_GET['menuParam']),
            'roles' => 1,
        ));
    }

    /**
     * Manages all models.
     */
//    public function actionAdmin() {
//        $model = new User('search');
//        $model->unsetAttributes();  // clear any default values
//        if (isset($_GET['User']))
//            $model->attributes = $_GET['User'];
//
//        $this->render('admin', array(
//            'model' => $model,
//        ));
//    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'User-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSearchJson() {
        $user = User::model()->findAll(array('condition' => 'name like "%' . $_POST['queryString'] . '%" OR phone like "%' . $_POST['queryString'] . '%"', 'limit' => 7));
        $results = array();
        foreach ($user as $no => $o) {
            $results[$no]['url'] = url('user/' . $o->id);
            $results[$no]['img'] = $o->imgUrl['small'];
            $results[$no]['title'] = $o->name;
            $results[$no]['description'] = $o->Roles->name . '<br/>' . landa()->hp($o->phone) . '<br/>' . $o->address;
        }
        echo json_encode($results);
    }

}
