<?php

class UserController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess("User","r") || app()->controller->isValidAccess("CLient","r") ||
                    app()->controller->isValidAccess("CLient","r") || app()->controller->isValidAccess("Guest","r") ||
                    app()->controller->isValidAccess("Supplier","r") || app()->controller->isValidAccess("Employment","r") ||
                    app()->controller->isValidAccess("Contact","r") || app()->controller->isValidAccess("Customer","r")',
//                'expression' => 'app()->controller->isValidAccess("User","c")',
//                'expression' => 'app()->controller->isValidAccess("CLient","c")',
//                'expression' => 'app()->controller->isValidAccess("Guest","c")',
//                'expression' => 'app()->controller->isValidAccess("Supplier","c")',
//                'expression' => 'app()->controller->isValidAccess("Emplyoment","c")',
//                'expression' => 'app()->controller->isValidAccess("Contact","c")',
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("User","r") || app()->controller->isValidAccess("CLient","r") ||
                    app()->controller->isValidAccess("CLient","r") || app()->controller->isValidAccess("Guest","r") ||
                    app()->controller->isValidAccess("Supplier","r") || app()->controller->isValidAccess("Employment","r") ||
                    app()->controller->isValidAccess("Contact","r") || app()->controller->isValidAccess("Customer","r")',
//                'expression' => 'app()->controller->isValidAccess("CLient","r")',
//                'expression' => 'app()->controller->isValidAccess("Guest","r")',
//                'expression' => 'app()->controller->isValidAccess("Supplier","r")',
//                'expression' => 'app()->controller->isValidAccess("Emplyoment","r")',
//                'expression' => 'app()->controller->isValidAccess("Contact","r")',
//                'expression' => 'app()->controller->isValidAccess("Customer","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("User","r") || app()->controller->isValidAccess("CLient","r") ||
                    app()->controller->isValidAccess("CLient","r") || app()->controller->isValidAccess("Guest","r") ||
                    app()->controller->isValidAccess("Supplier","r") || app()->controller->isValidAccess("Employment","r") ||
                    app()->controller->isValidAccess("Contact","r") || app()->controller->isValidAccess("Customer","r")',
//                'expression' => 'app()->controller->isValidAccess("CLient",u")',
//                'expression' => 'app()->controller->isValidAccess("Guest","u")',
//                'expression' => 'app()->controller->isValidAccess("Supplier","u")',
//                'expression' => 'app()->controller->isValidAccess("Emplyoment","u")',
//                'expression' => 'app()->controller->isValidAccess("Contact","u")',
//                'expression' => 'app()->controller->isValidAccess("Customer","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("User","r") || app()->controller->isValidAccess("CLient","r") ||
                    app()->controller->isValidAccess("CLient","r") || app()->controller->isValidAccess("Guest","r") ||
                    app()->controller->isValidAccess("Supplier","r") || app()->controller->isValidAccess("Employment","r") ||
                    app()->controller->isValidAccess("Contact","r") || app()->controller->isValidAccess("Customer","r")'
//                'expression' => 'app()->controller->isValidAccess("CLient","d")',
//                'expression' => 'app()->controller->isValidAccess("Guest","d")',
//                'expression' => 'app()->controller->isValidAccess("Supplier","d")',
//                'expression' => 'app()->controller->isValidAccess("Emplyoment","d")',
//                'expression' => 'app()->controller->isValidAccess("Contact","d")',
//                'expression' => 'app()->controller->isValidAccess("Customer","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $type = 'user';
        if (!empty($_GET['type']))
            $type = $_GET['type'];
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'type' => $type,
        ));
    }

    public function actionModerator() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (isset($_POST['buttonmoderator'])) {
                $model = User::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->moderator = 1;
                    $a->save();
                }
                user()->setFlash('info', 'User is enabled to moderator now.');
                $this->redirect(array('user/index'));
            }else if(isset($_POST['buttondelmoderator'])){
                $model = User::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->moderator = 0;
                    $a->save();
                }
                user()->setFlash('info', 'User is disabled from moderator now.');
                $this->redirect(array('user/index'));
            }else{
                User::model()->deleteAll('id IN (' . implode(',', $_POST['id']) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>User is deleted.');
                $this->redirect(array('user/index'));
            }
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please chekked user and then choose the button.');
            $this->redirect(array('user/index'));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionAllowLogin() {
//        logs($_POST);
        if (!empty($_POST['User']['roles_id'])) {
            $listRoles = Roles::model()->listRoles();
            if (isset($listRoles[$_POST['User']['roles_id']]))
                echo $listRoles[$_POST['User']['roles_id']]['is_allow_login'];
            elseif ($_POST['User']['roles_id'] == -1)
                echo '-1';
            else
                echo '0';
        }
    }

    public function actionRemovephoto($id) {
        User::model()->updateByPk($id, array('avatar_img' => NULL));
    }

    public function actionCreate() {
        $model = new User;
        $listRoles = Roles::model()->listRoles();
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');

        $type = 'user';
        $model->scenario = 'allow';
        if (!empty($_GET['type']))
            $type = $_GET['type'];
        if ($type != 'user')
            $model->scenario = 'notAllow';

        if (isset($_POST['User'])) {

            if (!empty($_POST['User']['roles'])) {
                $model->scenario = 'allow';
                if (isset($listRoles[$_POST['User']['roles']])) {
                    if ($listRoles[$_POST['User']['roles']]['is_allow_login'] == '0')
                        $model->scenario = 'notAllow';
                }
            }

            $model->attributes = $_POST['User'];
            $model->password = sha1($model->password);
            $others = json_decode($model->others, true);
            if (isset($others['mlm_action'])) {
                $other['mlm_action'] = "active";
            } else {
                $other['mlm_action'] = "active";
            }
            if (isset($others['mlm_silver'])) {
                $other['mlm_silver'] = "";
            } else {
                $other['mlm_silver'] = "";
            }
            if (isset($others['mlm_gold_slot'])) {
                $other['mlm_gold_slot'] = "";
            } else {
                $other['mlm_gold_slot'] = "";
            }
            if (isset($others['bank_name'])) {
                $other['bank_name'] = "";
            } else {
                $other['bank_name'] = $_POST['User']['bank_name'];
            }
            if (isset($others['bank_account'])) {
                $other['bank_account'] = "";
            } else {
                $other['bank_account'] = $_POST['User']['bank_account'];
            }
            if (isset($others['bank_account_name'])) {
                $other['bank_account_name'] = "";
            } else {
                $other['bank_account_name'] = $_POST['User']['bank_account_name'];
            }
            $model->others = json_encode($other);
            $file = CUploadedFile::getInstance($model, 'avatar_img');
            if (is_object($file)) {
                $model->avatar_img = Yii::app()->landa->urlParsing($model->name) . '.' . $file->extensionName;
            } else {
                unset($model->avatar_img);
            }

            if ($model->save()) {

                //create image if any file
                if (is_object($file)) {
                    $file->saveAs('images/avatar/' . $model->avatar_img);
                    Yii::app()->landa->createImg('avatar/', $model->avatar_img, $model->id);
                }

                //assign a roles
//                $model->assignRoles($model->roles_id, $model->id);
                unset(Yii::app()->session['listUser']);
                unset(Yii::app()->session['listUserPhone']);

                $this->redirect(array('view', 'id' => $model->id, 'type' => $type));
            }
        }


        $this->render('create', array(
            'model' => $model,
            'type' => $type,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
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
//            if (!empty($_POST['User']['roles'])) {
//                $model->scenario = 'allow';
//                if (isset($listRoles[$_POST['User']['roles']])) {
//                    if ($listRoles[$_POST['User']['roles']]['is_allow_login'] == '0')
//                        $model->scenario = 'notAllow';
//                }
//            }

            $model->attributes = $_POST['User'];

            if (!empty($model->password)) { //not empty, change the password
                $model->password = sha1($model->password);
            } else {
                $model->password = $tempPass;
            }

            $file = CUploadedFile::getInstance($model, 'avatar_img');
            if (is_object($file)) {
                $model->avatar_img = Yii::app()->landa->urlParsing($model->name) . '.' . $file->extensionName;
                $file->saveAs('images/avatar/' . $model->avatar_img);
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
        ));
    }

    public function actionUpdateProfile() {
        $_GET['id'] = user()->id;
        $id = user()->id;

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
//            if (!empty($_POST['User']['roles'])) {
//                $model->scenario = 'allow';
//                if (isset($listRoles[$_POST['User']['roles']])) {
//                    if ($listRoles[$_POST['User']['roles']]['is_allow_login'] == '0')
//                        $model->scenario = 'notAllow';
//                }
//            }

            $model->attributes = $_POST['User'];

            if (!empty($model->password)) { //not empty, change the password
                $model->password = sha1($model->password);
            } else {
                $model->password = $tempPass;
            }

            $file = CUploadedFile::getInstance($model, 'avatar_img');
            if (is_object($file)) {
                $model->avatar_img = Yii::app()->landa->urlParsing($model->name) . '.' . $file->extensionName;
                $file->saveAs('images/avatar/' . $model->avatar_img);
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionGetDetail() {
        $id = $_POST['id'];
        $user = User::model()->findByPk($id);
        $return['group'] = $user->roles;
        $return['name'] = $user->name;
        $return['email'] = $user->email;
        $return['city'] = $user->City->id;
        $return['province'] = $user->City->Province->id;
        $return['address'] = $user->address;
        $return['phone'] = $user->phone;
        echo json_encode($return);
    }

    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        $roles = "";
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
            $roles = (isset($_GET['User']['roles'])) ? $_GET['User']['roles'] : '';


            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');


            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');


            if (!empty($model->address))
                $criteria->addCondition('address = "' . $model->address . '"');


            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');


            if (!empty($model->roles))
                $criteria->addCondition('roles = "' . $model->roles . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'user',
            'roles' => $roles,
        ));
    }

    public function actionUser() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values   

        $roles = "";
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
            $roles = (isset($_GET['User']['roles'])) ? $_GET['User']['roles'] : '';


            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');


            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');


            if (!empty($model->address))
                $criteria->addCondition('address = "' . $model->address . '"');


            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');



            if (!empty($model->roles))
                $criteria->addCondition('roles = "' . $model->roles . '"');
        }

        $this->render('index', array(
            'model' => $model,
            'type' => 'user',
            'roles' => $roles,
        ));
    }

    public function actionGuest() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        $roles = "";
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




            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');



            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'guest',
            'roles' => $roles,
        ));
    }

    public function actionClient() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        $roles = "";
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




            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');



            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'client',
            'roles' => $roles,
        ));
    }

    public function actionContact() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');

        $model->unsetAttributes();  // clear any default values

        $roles = "";
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
            $roles = (isset($_GET['User']['roles'])) ? $_GET['User']['roles'] : '';



            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');




            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');

            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);

        $model->scenario == 'notAllow';
        $this->render('index', array(
            'model' => $model,
            'type' => 'contact',
            'roles' => $roles,
        ));
    }

    public function actionCustomer() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');

        $model->unsetAttributes();  // clear any default values

        $roles = "";
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




            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


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

        $model->scenario == 'notAllow';
        $this->render('index', array(
            'model' => $model,
            'type' => 'customer',
            'roles' => $roles,
        ));
    }

    public function actionTeacher() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');

        $model->unsetAttributes();  // clear any default values

        $roles = "";
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
            $roles = (isset($_GET['User']['roles'])) ? $_GET['User']['roles'] : '';



            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');




            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');

            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);

        $model->scenario == 'notAllow';
        $this->render('index', array(
            'model' => $model,
            'type' => 'teacher',
            'roles' => $roles,
        ));
    }

    public function actionStudent() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new User('search');

        $model->unsetAttributes();  // clear any default values

        $roles = "";
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
            $roles = (isset($_GET['User']['roles'])) ? $_GET['User']['roles'] : '';



            if (!empty($model->username))
                $criteria->addCondition('username = "' . $model->username . '"');


            if (!empty($model->email))
                $criteria->addCondition('email = "' . $model->email . '"');


            if (!empty($model->password))
                $criteria->addCondition('password = "' . $model->password . '"');




            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->city_id))
                $criteria->addCondition('city_id = "' . $model->city_id . '"');

            if (!empty($model->phone))
                $criteria->addCondition('phone = "' . $model->phone . '"');
        }
        $session['User_records'] = User::model()->findAll($criteria);

        $model->scenario == 'notAllow';
        $this->render('index', array(
            'model' => $model,
            'type' => 'student',
            'roles' => $roles,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

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

    public function actionGenerateExcel() {
        $model = User::model()->findAll(array());
        Yii::app()->request->sendFile('List user.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGeneratePdf() {

        $session = new CHttpSession;
        $session->open();
        Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/tcpdf.php');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/config/lang/eng.php');

        if (isset($session['User_records'])) {
            $model = $session['User_records'];
        }
        else
            $model = User::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan User');
        $pdf->SetSubject('Laporan User Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" User, "");
        $pdf->SetHeaderData("", "", "Laporan User", "");
        $pdf->setHeaderFont(Array('helvetica', '', 8));
        $pdf->setFooterFont(Array('helvetica', '', 6));
        $pdf->SetMargins(15, 18, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('dejavusans', '', 7);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->LastPage();
        $pdf->Output("User_002.pdf", "I");
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

    public function actionAuditUser() {
        $this->layout = 'main';

        $this->render('auditUser', array(
//            'oUserLogs' => $oUserLogs,
//            'listUser' => $listUser,
        ));
    }

}
