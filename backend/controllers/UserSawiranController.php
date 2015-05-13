<?php

class UserSawiranController extends Controller {

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
        $model = new UserSawiran;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserSawiran'])) {
            $model = new UserSawiran;
            $model->code = $_POST['UserSawiran']['code'];
            $model->name = $_POST['UserSawiran']['name'];
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

        if (isset($_POST['UserSawiran'])) {
            $model->attributes = $_POST['UserSawiran'];
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

        $model = new UserSawiran('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['UserSawiran'])) {
            $model->attributes = $_GET['UserSawiran'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->code))
                $criteria->addCondition('code = "' . $model->code . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionDeleteAll() {
        UserSawiran::model()->deleteAll(array(), array());
        user()->setFlash('warning', '<strong>Yaapp! </strong>Data is deleted.');
        $this->redirect(array('userSawiran/index'));
    }

    public function actionImportExcel() {
        $berhasil = false;
        $model = new UserSawiran;
        if (isset($_POST['UserSawiran'])) {
            $file = CUploadedFile::getInstance($model, 'filee',0777);
            if (is_object($file)) { //jika filenya valid
//                trace('aaa');
                $file->saveAs('images/file/' . $file->name,0777);
                $data = new Spreadsheet_Excel_Reader('images/file/coba.xls');

//                trace($data);
                $id = array();
                $nama = array();
                $code = array();
                for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++) {
//                    $id[$j] = (isset($data->sheets[0]['cells'][$j][1])) ? $data->sheets[0]['cells'][$j][1] : '';
                    $code[$j] = (isset($data->sheets[0]['cells'][$j][1])) ? $data->sheets[0]['cells'][$j][1] : '';
                    $name[$j] = (isset($data->sheets[0]['cells'][$j][2])) ? $data->sheets[0]['cells'][$j][2] : '';
                    (isset($data->sheets[0]['cells'][$j][9])) ? $data->sheets[0]['cells'][$j][9] : '';

                    //script simpan
//                    $_POST['UserSawiran']['id'] = (int) $id[$j];
                    $model = new UserSawiran;
                    $model->code = $code[$j];
                    $model->name = $name[$j];
                    $model->save();

//                     $import=mysqli_query("INSERT into acca_user_sawiran (code,name) values('$code[$j]','$name[$j]')");
//                    $this->actionCreate();
                    $berhasil = true;
                }
            }
        }
        $this->render('importExcel', array('model' => $model, 'berhasil' => $berhasil));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = UserSawiran::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-sawiran-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
