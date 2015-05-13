<?php

class SlideShowController extends Controller {

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

    public function actionChangeActive($id) {
        $jumlah = '';
        $cekcount = SlideShow::model()->findAll(array('condition' => 'status=1'));
        $jumlah = count($cekcount);
        if ($jumlah < 3) {
            $model = SlideShow::model()->findByPk($id);
            $model->status = 1;
            $model->save();
            user()->setFlash('info', 'Success Publish.');
            $this->redirect(array('slideShow/index'));
        } else {
            user()->setFlash('warning', 'Sorry Maximum 3 sliders.');
            $this->redirect(array('slideShow/index'));
        }
    }

    public function actionChangeOff($id) {
//        $jumlah='';
//        $cekcount = SlideShow::model()->findAll(array('condition'=>'status=1'));
//        $jumlah=  count($cekcount);
//        if($jumlah < 3){
        $model = SlideShow::model()->findByPk($id);
        $model->status = 0;
        $model->save();
        user()->setFlash('info', 'Success Unpublish.');
        $this->redirect(array('slideShow/index'));
//        }else{
//            user()->setFlash('warning', 'Sorry Maximum 3 sliders.');
//                $this->redirect(array('slideShow/index'));
//        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SlideShow;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SlideShow'])) {
            $model->attributes = $_POST['SlideShow'];
//            $file = CUploadedFile::getInstance($model, 'image');
            // avatar upload
            if (isset($_POST['SlideShow']['image'])) {
                $file = CUploadedFile::getInstance($model, 'image', false);
                if (is_object($file)) {
                    $model->image = Yii::app()->landa->urlParsing($model->title) . '.' . $file->extensionName;
                } else {
                    unset($model->image);
                }
            }
            if ($model->save()) {
                if (is_object($file)) {
                    $file->saveAs('images/slider/' . $model->image);
//                    Yii::app()->landa->createImg('slider/', $model->image, $model->id);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
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

        if (isset($_POST['SlideShow'])) {
            $model->attributes = $_POST['SlideShow'];
            $file = CUploadedFile::getInstance($model, 'image');
            if (is_object($file)) {
                $model->image = Yii::app()->landa->urlParsing($model->title) . '.' . $file->extensionName;
                $file->saveAs('images/slider/' . $model->image);
                Yii::app()->landa->createImg('slider/', $model->image, $model->id);
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $model = new SlideShow('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['SlideShow'])) {
            $model->attributes = $_GET['SlideShow'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->article_id))
                $criteria->addCondition('article_id = "' . $model->article_id . '"');


            if (!empty($model->title))
                $criteria->addCondition('title = "' . $model->title . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->image))
                $criteria->addCondition('image = "' . $model->image . '"');


            if (!empty($model->status))
                $criteria->addCondition('status = "' . $model->status . '"');
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
        $model = SlideShow::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'slide-show-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
