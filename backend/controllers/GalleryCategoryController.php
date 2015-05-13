<?php

class GalleryCategoryController extends Controller {

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
                'actions' => array('index','view'),
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
        $model = new GalleryCategory;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['GalleryCategory'])) {
            if ($_POST['GalleryCategory']['parent_id']) {
                $root = $model->findByPk($_POST['GalleryCategory']['parent_id']);
                $child = new GalleryCategory;
                $child->attributes = $_POST['GalleryCategory'];
                // $child->path = 'gallery/' . Yii::app()->landa->urlParsing($model->name) . '/';
                $child->path = $root->path . Yii::app()->landa->urlParsing($child->name) . '/';

                $root = $model->findByPk($_POST['GalleryCategory']['parent_id']);
                if ($child->appendTo($root))
                    mkdir('images/' . $child->path, 0775);
                $this->redirect(array('gallery/create', 'id' => $child->id));
            }else {
                $model->attributes = $_POST['GalleryCategory'];
                $model->path = 'gallery/' . Yii::app()->landa->urlParsing($model->name) . '/';
                mkdir('images/' . $model->path, 0775);
                if ($model->saveNode())
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionDefaultPhoto($id) {

        $model = $this->loadModel($id);
        $results = array('id'=>$_GET['gallery_id'],'image'=>$_GET['image']);
        $model->image = json_encode($results);
        $model->saveNode();
    }
    

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
       // $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['GalleryCategory'])) {
            $oldfolderpath = 'images/' . $model->path;

            if ($_POST['GalleryCategory']['parent_id']) {
                $model->attributes = $_POST['GalleryCategory'];

                $root = $model->findByPk($_POST['GalleryCategory']['parent_id']);
                $model->path = $root->path . Yii::app()->landa->urlParsing($model->name) . '/';

                if ($model->saveNode()) {
                    $model->moveAsFirst($root);

                    //move the folder
                    $newfolderpath = 'images/' . $model->path;
                    rename($oldfolderpath, $newfolderpath);

                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {

                $model->attributes = $_POST['GalleryCategory'];
                $model->path = 'gallery/' . Yii::app()->landa->urlParsing($model->name) . '/';

                //move the folder
                $newfolderpath = 'images/' . $model->path ;
                rename($oldfolderpath, $newfolderpath);

                $model->saveNode();
                if (!($model->isRoot()))
                    $model->moveAsRoot();
                $this->redirect(array('view', 'id' => $model->id));
            }
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

            $model = $this->loadModel($id);

            //delete download where have child
            $descendants = $model->children()->findAll();
            $sWhere[] = $id;
            foreach ($descendants as $o) {
                $sWhere[] = $o->id;
            }

            landa()->deleteDir('images/' . $model->path);
            cmd('DELETE FROM acca_gallery WHERE gallery_category_id IN (' . implode(',', $sWhere) . ')')->execute();

            // we only allow deletion via POST request
            $model->deleteNode();

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

        $model = new GalleryCategory('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['GalleryCategory'])) {
            $model->attributes = $_GET['GalleryCategory'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->image))
                $criteria->addCondition('image = "' . $model->image . '"');
        }
        $session['GalleryCategory_records'] = GalleryCategory::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new GalleryCategory('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['GalleryCategory']))
            $model->attributes = $_GET['GalleryCategory'];

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
        $model = GalleryCategory::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gallery-category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['GalleryCategory_records'])) {
            $model = $session['GalleryCategory_records'];
        }
        else
            $model = GalleryCategory::model()->findAll();


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

        if (isset($session['GalleryCategory_records'])) {
            $model = $session['GalleryCategory_records'];
        }
        else
            $model = GalleryCategory::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan GalleryCategory');
        $pdf->SetSubject('Laporan GalleryCategory Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" GalleryCategory, "");
        $pdf->SetHeaderData("", "", "Laporan GalleryCategory", "");
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
        $pdf->Output("GalleryCategory_002.pdf", "I");
    }

}
