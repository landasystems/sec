<?php

class GalleryController extends Controller {

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
                'actions' => array( 'create'),
                'expression' => 'app()->controller->isValidAccess("Gallery","c")'
            ),
            array('allow', // r
                'actions' => array( 'index','view'),
                'expression' => 'app()->controller->isValidAccess("Gallery","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Gallery","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Gallery","d")'
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
    public function actionCreate() {
        cs()->registerCss('gallery', '
                            .product-list-img-item{
                            position:relative;
                            }
                            .photo-det-btn{
                                position:absolute;
                                top:5px;
                                left:10px
                            }
                            .caption {
                                max-height: 30px;
                                overflow: hidden;
                            }
');
        cs()->registerScript('gallery', '$(".photo-det-btn").hide();                  
                            $(".product-list-img-item").hover(function() {
                                 $(this).find(".photo-det-btn").fadeIn(300);
                            }, function() {
                                $(this).find(".photo-det-btn").fadeOut(300); 
                            });');

        $model = new Gallery;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gallery'])) {
            $model->attributes = $_POST['Gallery'];
            if ($model->save()) {
                //$this->redirect(array('view', 'id' => $model->id));
            }
        }


        $model->gallery_category_id = $_GET['id'];
        $this->render('create', array(
            'model' => $model,
            'modelGallery' => $model->findAll(array('condition' => 'gallery_category_id=' . $model->gallery_category_id)),
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

        if (isset($_POST['Gallery'])) {
            $model->attributes = $_POST['Gallery'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdateDesc($id) {
        $model = $this->loadModel($id);
        $model->description = $_POST['desc'];
        $model->save();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        
        
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);
//            logs('images/' . $model->GalleryCategory->path . '/' . $model->img['small']);
//            unlink('images/' . $model->GalleryCategory->path . '/' . $model->img['small']);
//            unlink('images/' . $model->GalleryCategory->path . '/' . $model->img['medium']);
//            unlink('images/' . $model->GalleryCategory->path . '/' . $model->img['big']);
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
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Gallery('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Gallery'])) {
            $model->attributes = $_GET['Gallery'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->gallery_category_id))
                $criteria->addCondition('gallery_category_id = "' . $model->gallery_category_id . '"');
        }
        $session['Gallery_records'] = Gallery::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Gallery('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Gallery']))
            $model->attributes = $_GET['Gallery'];

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
        $model = Gallery::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gallery-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Gallery_records'])) {
            $model = $session['Gallery_records'];
        }
        else
            $model = Gallery::model()->findAll();


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

        if (isset($session['Gallery_records'])) {
            $model = $session['Gallery_records'];
        }
        else
            $model = Gallery::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Gallery');
        $pdf->SetSubject('Laporan Gallery Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Gallery, "");
        $pdf->SetHeaderData("", "", "Laporan Gallery", "");
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
        $pdf->Output("Gallery_002.pdf", "I");
    }

    public function actionUpload() {


        $gallery_category = GalleryCategory::model()->findByPk($_GET['id']);

        Yii::import("common.extensions.EAjaxUpload.qqFileUploader");

        $folder = 'images/' . $gallery_category->path; // folder for uploaded files
        $allowedExtensions = array("jpg", "jpeg", "gif", "png", "gif"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 2 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

//        $fileSize = filesize($folder . $result['filename']); //GETTING FILE SIZE
//        $fileName = $result['filename']; //GETTING FILE NAME
        //Yii::log(json_encode($result),'info');
//        Yii::log($_GET,'info');
        $model = new Gallery;
        $model->gallery_category_id = $_GET['id'];
        $model->image = Yii::app()->landa->urlParsing($result['filename']);
        $model->save();
        Yii::app()->landa->createImg($gallery_category->path, $result['filename'], $model->id);

        echo $return; // it's array
    }

}
