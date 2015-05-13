<?php

class DownloadController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainSingle';

    /**
     * @return array action filters
     */
    //public function filters() {
       // return array(
       //     'rights', // perform access control for CRUD operations
      //  );
  //  }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
 
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionView($id) {
        $model = Download::model()->findAll(array('condition'=>'download_category_id='.$id));
        $this->render('view', array(
            'model' => $model,
        ));
    }

  
    public function actionIndex() {
//        $session = new CHttpSession;
//        $session->open();
        $criteria = new CDbCriteria();

        $criteria->condition = 'download_category_id='.$_GET['download_category_id'].' AND publish=1';
        
        
        $total = Download::model()->count($criteria);
        // results per page
        $pages = new CPagination($total);
        $pages->setPageSize(10);
        $pages->applyLimit($criteria);
        
        $model = Download::model()->findAll($criteria);
//        $model = new Download('search');
//        $model->unsetAttributes();  // clear any default values

       


        $modelCategory = DownloadCategory::model()->findAll(array('condition'=>'parent_id='.$_GET['download_category_id']));
        $this->render('index', array(
            'model' => $model,
            'modelCategory' => $modelCategory,
            'pages'=>$pages,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Download('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Download']))
            $model->attributes = $_GET['Download'];

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
        $model = Download::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'download-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Download_records'])) {
            $model = $session['Download_records'];
        }
        else
            $model = Download::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    
}
