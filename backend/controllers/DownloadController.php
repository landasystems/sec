<?php

class DownloadController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("Download","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Download","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Download","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Download","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
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
                $model = Download::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->publish = 1;
                    $a->save();
                }
                user()->setFlash('info', '<strong>Hurray! </strong>Document is publish now.');
                $this->redirect(array('download/create', 'id' => $_POST['id_download']));
            } elseif (isset($_POST['buttonunpublish'])) {
                $model = Download::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['id']) . ')'));
                foreach ($model as $a) {
                    $a->publish = 0;
                    $a->save();
                }
                user()->setFlash('warning', '<strong>Yaapp! </strong>Document is unpublish now.');
                $this->redirect(array('download/create', 'id' => $_POST['id_download']));
            } else {
                Download::model()->deleteAll('id IN (' . implode(',', $_POST['id']) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>Document is deleted.');
                $this->redirect(array('download/create', 'id' => $_POST['id_download']));
            }
            
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please checked the document and then choose the button.');
            $this->redirect(array('download/create', 'id' => $_POST['id_download']));
        }
    }

    public function actionUnpublish($id) {
        $model = Download::model()->findByPk($id);
        $model->publish = 0;
        $model->save();
    }

    public function actionCreate() {
        $model = new Download;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Download'])) {
            $model->attributes = $_POST['Download'];

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $model->download_category_id = $_GET['id'];
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

        if (isset($_POST['Download'])) {
            $model->attributes = $_POST['Download'];
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

        $model = new Download('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Download'])) {
            $model->attributes = $_GET['Download'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->download_category_id))
                $criteria->addCondition('download_category_id = "' . $model->download_category_id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->url))
                $criteria->addCondition('url = "' . $model->url . '"');


            if (!empty($model->public))
                $criteria->addCondition('public = "' . $model->public . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Download_records'] = Download::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
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

    public function actionGeneratePdf() {

        $session = new CHttpSession;
        $session->open();
        Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/tcpdf.php');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/config/lang/eng.php');

        if (isset($session['Download_records'])) {
            $model = $session['Download_records'];
        }
        else
            $model = Download::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Download');
        $pdf->SetSubject('Laporan Download Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Download, "");
        $pdf->SetHeaderData("", "", "Laporan Download", "");
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
        $pdf->Output("Download_002.pdf", "I");
    }

    public function actionUpload() {


        $download_category = DownloadCategory::model()->findByPk($_GET['id']);

        Yii::import("common.extensions.EAjaxUpload.qqFileUploader");

        $folder = 'images/' . $download_category->path; // folder for uploaded files
        Yii::log($folder, 'info');
        $allowedExtensions = array("zip", "rar", "doc", "docx", "pdf", "ppt"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 7 * 1024 * 1024; // maximum file size in bytes



        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        //$fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
        // $fileName = $result['filename']; //GETTING FILE NAME
        //Yii::log(json_encode($result),'info');
        //Yii::log($_GET,'info');
        $model = new Download;
        $model->download_category_id = $_GET['id'];
        $model->name = ' ';
        $model->publish = 1;
        $model->url = ($result['filename']);
        $model->save();

//        $model = new UserLog;
//        $model->save();


        echo $return; // it's array
    }

}
