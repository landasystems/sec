<?php

class BbiiMessageController extends Controller {

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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new BbiiMessage;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BbiiMessage'])) {
            $model->attributes = $_POST['BbiiMessage'];
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

        if (isset($_POST['BbiiMessage'])) {
            $model->attributes = $_POST['BbiiMessage'];
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

        $model = new BbiiMessage('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['BbiiMessage'])) {
            $model->attributes = $_GET['BbiiMessage'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->sendfrom))
                $criteria->addCondition('sendfrom = "' . $model->sendfrom . '"');


            if (!empty($model->sendto))
                $criteria->addCondition('sendto = "' . $model->sendto . '"');


            if (!empty($model->subject))
                $criteria->addCondition('subject = "' . $model->subject . '"');


            if (!empty($model->content))
                $criteria->addCondition('content = "' . $model->content . '"');


            if (!empty($model->create_time))
                $criteria->addCondition('create_time = "' . $model->create_time . '"');


            if (!empty($model->read_indicator))
                $criteria->addCondition('read_indicator = "' . $model->read_indicator . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');


            if (!empty($model->inbox))
                $criteria->addCondition('inbox = "' . $model->inbox . '"');


            if (!empty($model->outbox))
                $criteria->addCondition('outbox = "' . $model->outbox . '"');


            if (!empty($model->ip))
                $criteria->addCondition('ip = "' . $model->ip . '"');


            if (!empty($model->post_id))
                $criteria->addCondition('post_id = "' . $model->post_id . '"');
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
    public function actionReport() {

        $model = new BbiiMessage('search');
        $model->unsetAttributes();  // clear any default values
        $model->sendto = 0;

        if (isset($_GET['BbiiMessage'])) {
            $model->attributes = $_GET['BbiiMessage'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->sendfrom))
                $criteria->addCondition('sendfrom = "' . $model->sendfrom . '"');


            if (!empty($model->sendto))
                $criteria->addCondition('sendto = "' . $model->sendto . '"');


            if (!empty($model->subject))
                $criteria->addCondition('subject = "' . $model->subject . '"');


            if (!empty($model->content))
                $criteria->addCondition('content = "' . $model->content . '"');


            if (!empty($model->create_time))
                $criteria->addCondition('create_time = "' . $model->create_time . '"');


            if (!empty($model->read_indicator))
                $criteria->addCondition('read_indicator = "' . $model->read_indicator . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');


            if (!empty($model->inbox))
                $criteria->addCondition('inbox = "' . $model->inbox . '"');


            if (!empty($model->outbox))
                $criteria->addCondition('outbox = "' . $model->outbox . '"');


            if (!empty($model->ip))
                $criteria->addCondition('ip = "' . $model->ip . '"');


            if (!empty($model->post_id))
                $criteria->addCondition('post_id = "' . $model->post_id . '"');
        }

        $this->render('report', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = BbiiMessage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bbii-message-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
