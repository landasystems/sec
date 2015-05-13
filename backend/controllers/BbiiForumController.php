<?php

class BbiiForumController extends Controller {

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
        $model = new BbiiForum;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['BbiiForum']) && isset($_POST['BbiiForum']['type'])) {
            if ($_POST['BbiiForum']['type'] == 1 && $_POST['BbiiForum']['cat_id'] == NULL) {
                user()->setFlash('info', 'Maaf jika type <strong>Sub Category</strong> pilih Kategori induknya.');
                $this->render('create', array(
                    'model' => $model,
                ));
            } else if ($_POST['BbiiForum']['type'] == 0 && $_POST['BbiiForum']['cat_id'] != NULL) {
                user()->setFlash('info', 'Maaf jika type <strong>Category</strong> kosongkan kategori indukny.');
                $this->render('create', array(
                    'model' => $model,
                ));
            } else {
                $model->attributes = $_POST['BbiiForum'];
            }

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

        if (isset($_POST['BbiiForum'])) {
            $model->attributes = $_POST['BbiiForum'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDel($id) {
        $model = $this->loadModel($id);

        $this->loadModel($id)->delete();
        user()->setFlash('warning', '<strong>Yaapp! </strong>Data is deleted.');
        $this->redirect(array('bbiiForum/index'));
    }

    public function actionSort() {

//        logs($_POST['cat']);
//        logs($_POST['frm']);
        if (isset($_POST['cat'])) {
            $number = 1;
            foreach ($_POST['cat'] as $id) {
                $model = BbiiForum::model()->findByPk($id);
                $model->sort = $number++;
                $model->save();
            }
            $json = array('succes' => 'yes');
        } elseif (isset($_POST['frm'])) {
            $number = 1;
            foreach ($_POST['frm'] as $id) {
                $model = BbiiForum::model()->findByPk($id);
                $model->sort = $number++;
                $model->save();
            }
            $json = array('succes' => 'yes');
        } else {
            $json = array('succes' => 'no');
        }
        echo json_encode($json);
        Yii::app()->end();
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
        $forum = array();
        $category = BbiiForum::model()->sorted()->category()->findAll();
        $model = new BbiiForum('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['BbiiForum'])) {
            $model->attributes = $_GET['BbiiForum'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->cat_id))
                $criteria->addCondition('cat_id = "' . $model->cat_id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->subtitle))
                $criteria->addCondition('subtitle = "' . $model->subtitle . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');


            if (!empty($model->public))
                $criteria->addCondition('public = "' . $model->public . '"');


            if (!empty($model->locked))
                $criteria->addCondition('locked = "' . $model->locked . '"');


            if (!empty($model->moderated))
                $criteria->addCondition('moderated = "' . $model->moderated . '"');


            if (!empty($model->sort))
                $criteria->addCondition('sort = "' . $model->sort . '"');


            if (!empty($model->num_posts))
                $criteria->addCondition('num_posts = "' . $model->num_posts . '"');


            if (!empty($model->num_topics))
                $criteria->addCondition('num_topics = "' . $model->num_topics . '"');


            if (!empty($model->last_post_id))
                $criteria->addCondition('last_post_id = "' . $model->last_post_id . '"');


            if (!empty($model->poll))
                $criteria->addCondition('poll = "' . $model->poll . '"');


            if (!empty($model->membergroup_id))
                $criteria->addCondition('membergroup_id = "' . $model->membergroup_id . '"');
        }

        $this->render('index', array(
            'model' => $model,
            'category' => $category,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = BbiiForum::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bbii-forum-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
