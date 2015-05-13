<?php

class BbiiMemberController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('index', 'create'),
                'expression' => 'app()->controller->isValidAccess(1,"c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess(1,"r")'
            ),
            array('allow', // u
                'actions' => array('index', 'update'),
                'expression' => 'app()->controller->isValidAccess(1,"u")'
            ),
            array('allow', // d
                'actions' => array('index', 'delete'),
                'expression' => 'app()->controller->isValidAccess(1,"d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        cs()->registerScript('read', '
                    $("form input, form textarea, form select").each(function(){
                    $(this).prop("disabled", true);
                });');
        $_GET['v'] = true;
        $this->actionUpdate($id);
    }

    public function actionChangeModerator() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (isset($_POST['buttonmoderator'])) {
                BbiiMember::model()->updateAll(array('moderator' => 1), 'id IN (' . implode(',', $id) . ')');
//                
//                print_r($_POST['id']);
                user()->setFlash('info', 'User is enabled to moderator now.');
                $this->redirect(array('bbiiMember/index'));
            } else if (isset($_POST['buttondelmoderator'])) {
                BbiiMember::model()->updateAll(array('moderator' => 0), 'id IN (' . implode(',', $id) . ')');
                user()->setFlash('info', 'User is disabled from moderator now.');
                $this->redirect(array('bbiiMember/index'));
            } else {
                BbiiMember::model()->deleteAll('id IN (' . implode(',', $id) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>User is deleted.');
                $this->redirect(array('bbiiMember/index'));
            }
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please chekked user and then choose the button.');
            $this->redirect(array('bbiiMember/index'));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new BbiiMember;
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BbiiMember'])) {
            $model->attributes = $_POST['BbiiMember'];
            $model->password = sha1($model->password);
            $model->business_id = $_POST['BbiiMember']['business_id'];
            $model->city_id = $_POST['BbiiMember']['city_id'];
            $model->email = $_POST['BbiiMember']['email'];
            $model->code = $_POST['BbiiMember']['code'];
            $model->phone = $_POST['BbiiMember']['phone'];

            $file = CUploadedFile::getInstance($model, 'avatar');
            if (is_object($file)) {
                $model->avatar = Yii::app()->landa->urlParsing($model->member_name) . '.' . $file->extensionName;
            } else {
                unset($model->avatar);
            }
            if ($model->save())
                if (is_object($file)) {
                    $file->saveAs('images/avatar/' . $model->avatar);
                    Yii::app()->landa->createImg('avatar/', $model->avatar, $model->id);
                }
            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionRemovephoto($id) {
        BbiiMember::model()->updateByPk($id, array('avatar' => NULL));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $tempPass = $model->password;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');



        if (isset($_POST['BbiiMember'])) {

            $model->attributes = $_POST['BbiiMember'];

            if (!empty($model->password)) { //not empty, change the password
                $model->password = sha1($model->password);
            } else {
                $model->password = $tempPass;
            }

            $file = CUploadedFile::getInstance($model, 'avatar');
            if (is_object($file)) {
                $model->avatar = Yii::app()->landa->urlParsing($model->member_name) . '.' . $file->extensionName;
                $file->saveAs('images/avatar/' . $model->avatar);
                Yii::app()->landa->createImg('avatar/', $model->avatar, $model->id);
            }

            if ($model->save()) {
                //check if any change in roles, revoke then assign new role
//                if ($tempRoles != $model->roles) {
//                    $model->revokeRoles($tempRoles, $model->id);
//                    $model->assignRoles($model->roles, $model->id);
//                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        unset($model->password);
//        if ($type != 'user')
//            $model->scenario == 'allow';

        $this->render('update', array(
            'model' => $model,
//            'type' => $type,
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
            //cari id topic untuk delet di table post
            $model = $this->loadModel($id);
            $sTopic = array();
            $topic = BbiiTopic::model()->findAll(array('condition' =>'user_id=' . $id));
            foreach ($topic as $data) {
                $sTopic[] = $data->id;
            }

            // delet di table post
            cmd('DELETE FROM bbii_post WHERE topic_id IN (' . implode(',', $sTopic) . ')')->execute();
            cmd('DELETE FROM bbii_topic WHERE user_id='.$id)->execute();
            cmd('DELETE FROM bbii_poll WHERE user_id='.$id)->execute();

            $model->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
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
