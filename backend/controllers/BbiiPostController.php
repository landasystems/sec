<?php

class BbiiPostController extends Controller {

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

    public function actionApproveAll() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (isset($_POST['buttonapprove'])) {
                BbiiPost::model()->updateAll(array('approved' => 1), 'id IN (' . implode(',', $id) . ')');
                user()->setFlash('info', 'Post is approved now.');
                $this->redirect(array('bbiiPost/approval'));
            } else {
                BbiiPost::model()->deleteAll('id IN (' . implode(',', $id) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>Post is deleted.');
                $this->redirect(array('bbiiPost/approval'));
            }
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please chekked post and then choose the button.');
            $this->redirect(array('bbiiPost/approval'));
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new BbiiPost;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BbiiPost'])) {
            $model->attributes = $_POST['BbiiPost'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BbiiPost'])) {
            $model->attributes = $_POST['BbiiPost'];
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
$criteria = new CDbCriteria();
        $model = new BbiiPost('search');
        $model->unsetAttributes();  // clear any default values
        $model->approved = 1;

        if (isset($_GET['BbiiPost'])) {
            $model->attributes = $_GET['BbiiPost'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->subject))
                $criteria->addCondition('subject = "' . $model->subject . '"');


            if (!empty($model->content))
                $criteria->addCondition('content = "' . $model->content . '"');


            if (!empty($model->user_id))
                $criteria->addCondition('user_id = "' . $model->user_id . '"');


            if (!empty($model->topic_id))
                $criteria->addCondition('topic_id = "' . $model->topic_id . '"');


            if (!empty($model->forum_id))
                $criteria->addCondition('forum_id = "' . $model->forum_id . '"');


            if (!empty($model->ip))
                $criteria->addCondition('ip = "' . $model->ip . '"');


            if (!empty($model->create_time))
                $criteria->addCondition('create_time = "' . $model->create_time . '"');


            if (!empty($model->approved))
                $criteria->addCondition('approved = "' . $model->approved . '"');


            if (!empty($model->change_id))
                $criteria->addCondition('change_id = "' . $model->change_id . '"');


            if (!empty($model->change_time))
                $criteria->addCondition('change_time = "' . $model->change_time . '"');


            if (!empty($model->change_reason))
                $criteria->addCondition('change_reason = "' . $model->change_reason . '"');


            if (!empty($model->upvoted))
                $criteria->addCondition('upvoted = "' . $model->upvoted . '"');
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionApproval() {

        $model = new BbiiPost('search');
        $model->unsetAttributes();  // clear any default values
        $model->approved = 0;

        if (isset($_GET['BbiiPost'])) {
            $model->attributes = $_GET['BbiiPost'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->subject))
                $criteria->addCondition('subject = "' . $model->subject . '"');


            if (!empty($model->content))
                $criteria->addCondition('content = "' . $model->content . '"');


            if (!empty($model->user_id))
                $criteria->addCondition('user_id = "' . $model->user_id . '"');


            if (!empty($model->topic_id))
                $criteria->addCondition('topic_id = "' . $model->topic_id . '"');


            if (!empty($model->forum_id))
                $criteria->addCondition('forum_id = "' . $model->forum_id . '"');


            if (!empty($model->ip))
                $criteria->addCondition('ip = "' . $model->ip . '"');


            if (!empty($model->create_time))
                $criteria->addCondition('create_time = "' . $model->create_time . '"');


            if (!empty($model->approved))
                $criteria->addCondition('approved = "' . $model->approved . '"');


            if (!empty($model->change_id))
                $criteria->addCondition('change_id = "' . $model->change_id . '"');


            if (!empty($model->change_time))
                $criteria->addCondition('change_time = "' . $model->change_time . '"');


            if (!empty($model->change_reason))
                $criteria->addCondition('change_reason = "' . $model->change_reason . '"');


            if (!empty($model->upvoted))
                $criteria->addCondition('upvoted = "' . $model->upvoted . '"');
        }

        $this->render('approval', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = BbiiPost::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bbii-post-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
