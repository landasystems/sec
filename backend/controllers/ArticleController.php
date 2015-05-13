<?php

class ArticleController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

//    public function action() {
//        return array(
//            'upload' => array(
//                'class' => 'xupload.actions.XUploadAction',
//                'path' => Yii::app()->getBasePath() . "/../uploads",
//                'publicPath' => Yii::app()->getBaseUrl() . "/uploads",
//            ),
//        );
//    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('index', 'create'),
                'expression' => 'app()->controller->isValidAccess("Article","c")'
            ),
            array('allow', // r
                'actions' => array('view'),
                'expression' => 'app()->controller->isValidAccess("Article","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Article","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Article","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->clientScript->registerMetaTag('foo, bar', 'keywords');
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionViewFull($id) {
        Yii::app()->clientScript->registerMetaTag('foo, bar', 'keywords');
        $model = $this->loadModel($id);
        $this->render('viewFull', array(
            'model' => $model,
        ));
    }

    public function actionViewList($id) {
        $this->render('viewList', array(
            'model' => Article::model()->findAll('article_category_id=:article_category_id', array(':article_category_id' => $id)),
            'modelCategory' => ArticleCategory::model()->findAll('parent_id=:parent_id', array(':parent_id' => $id)),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    
    public function actionPublish() {
//        logs(implode(',', $_POST['id']));
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            if (isset($_POST['buttonpublish'])) {
                $model = Article::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->publish = 1;
                    $a->save();
                }
                user()->setFlash('info', '<strong>Hurray! </strong>Article is publish now.');
                $this->redirect(array('article/index'));
            } elseif (isset($_POST['buttonunpublish'])) {
                $model = Article::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->publish = 0;
                    $a->save();
                }
                user()->setFlash('warning', '<strong>Yaapp! </strong>Article is unpublish now.');
                $this->redirect(array('article/index'));
            } else {
                Article::model()->deleteAll('id IN (' . implode(',', $_POST['id']) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>Article is deleted.');
                $this->redirect(array('article/index'));
            }
            
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please chekked article and then choose the button.');
            $this->redirect(array('article/index'));
        }
    }
    
    public function actionCreate() {
        $model = new Article;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            
            $model->alias = landa()->urlParsing($model->title);
            $model->keyword = json_encode($_POST['Article']['keyword']);
            $model->description = $_POST['Article']['description'];
            $model->publish = $_POST['Article']['publish'];

            $file = CUploadedFile::getInstance($model, 'primary_image');
            if (is_object($file)) { //set image name
                $model->primary_image = Yii::app()->landa->urlParsing($model->title) . '.' . $file->extensionName;
            }
            if ($model->save()) {
                if (is_object($file)) { //upload image
                    $file->saveAs('images/article/' . $model->primary_image);
                    Yii::app()->landa->createImg('article/', $model->primary_image, $model->id);
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

        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->alias = landa()->urlParsing($model->title);
            $model->keyword = $_POST['Article']['keyword'];
            $model->description = $_POST['Article']['description'];
            $file = CUploadedFile::getInstance($model, 'primary_image');
            if (is_object($file)) {
                $model->primary_image = Yii::app()->landa->urlParsing($model->title) . '.' . $file->extensionName;
                $file->saveAs('images/article/' . $model->primary_image);
                Yii::app()->landa->createImg('article/', $model->primary_image, $model->id);
            } else {
                unset($model->primary_image);
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
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Article('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Article'])) {
            $model->attributes = $_GET['Article'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->title))
                $criteria->addCondition('title = "' . $model->title . '"');


            if (!empty($model->article_category_id))
                $criteria->addCondition('article_category_id = "' . $model->article_category_id . '"');


            if (!empty($model->content))
                $criteria->addCondition('content = "' . $model->content . '"');


            if (!empty($model->primary_image))
                $criteria->addCondition('primary_image = "' . $model->primary_image . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Article_records'] = Article::model()->findAll($criteria);

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Article('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Article']))
            $model->attributes = $_GET['Article'];

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
        $model = Article::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Article-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Article_records'])) {
            $model = $session['Article_records'];
        }
        else
            $model = Article::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
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

        if (isset($session['Article_records'])) {
            $model = $session['Article_records'];
        }
        else
            $model = Article::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Article');
        $pdf->SetSubject('Laporan Article Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Article, "");
        $pdf->SetHeaderData("", "", "Laporan Article", "");
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
        $pdf->Output("Article_002.pdf", "I");
    }
    
   

}
