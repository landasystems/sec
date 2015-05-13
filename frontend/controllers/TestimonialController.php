<?php

class TestimonialController extends Controller {

    public $breadcrumbs;
    public $layout = 'mainSingle';

    /**
     * @return array action filters
     */
//    public function filters() {
////        return array(
////            'accessControl', // perform access control for CRUD operations
////        );
//    }

    public function accessRules() {
        return array('allow', 'actions' => array('captcha'), 'users' => array('*'));
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

   
    public function actionIndex() {
        if (isset($_GET['access']) && $_GET['access'] == 'login')
            $this->layout = 'mainDashboardSingle';
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        //$criteria->condition = 'id=' . $param->id;
         $total = Testimonial::model()->count($criteria);
        
        $pages = new CPagination($total);
        $pages->setPageSize(1);
        $pages->applyLimit($criteria);
        $modelCreate = new Testimonial;
        if (isset($_POST['Testimonial'])) {
            $modelCreate->attributes = $_POST['Testimonial'];

            //for save field img_avatar
            $file = CUploadedFile::getInstance($modelCreate, 'img_avatar');
            if (is_object($file)) { //set image name
                $modelCreate->img_avatar = Yii::app()->landa->urlParsing($modelCreate->name) . '.' . $file->extensionName;
            }

            if ($modelCreate->save()) {
                //create thumbnail
                if (is_object($file)) { //upload image
                    $file->saveAs(param('pathImg') . 'testimonial/' . $modelCreate->img_avatar);
                    Yii::app()->landa->createImg('testimonial/', $modelCreate->img_avatar, $modelCreate->id);
                }
            }
        }

       
        // results per page
        
        
        $model = Testimonial::model()->findAll($criteria);
        


        $this->render('index', array(            
            'modelCreate' => $modelCreate,
            'pages'=>$pages,
        ));
    }

    

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Testimonial::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'testimonial-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

   

}
