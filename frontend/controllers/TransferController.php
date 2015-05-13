<?php

class TransferController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainDashboardSingle';

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
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess("Transfer","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Transfer","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Transfer","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Transfer","d")'
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

    public function actionCodeConfirm() {
        if (isset($_POST['code'])) {
            $user = User::model()->findByAttributes(array('code' => $_POST['code']));
            $this->render('codeConfirm', array(
                'mUser' => $user,
            ));
        }
    }

    public function actionCreate() {
        $model = new Transfer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['to_user_id']) && isset($_POST['amount'])) {
            if ($_POST['amount'] == "") {
                user()->setFlash('warning', '<strong>Maaf!!</strong> Mohon isikan nominal yang kan anda transfer.');
                $this->render('create', array('model' => $model,));
                exit();
            }
            if (user()->saldo < $_POST['amount']) {
                user()->setFlash('error', '<strong>Error! </strong>Saldo / Coin anda tidak mencukupi, Max Saldo anda : <b>' . landa()->rp(user()->saldo) . '</b>.');
                $this->render('create', array('model' => $model,));
                exit();
            }
            $model->amount = $_POST['amount'];
            $model->to_user_id = $_POST['to_user_id'];
            $model->created = Yii::app()->user->id;
            $model->created_user_id = Yii::app()->user->id;
            $model->created = date('Y-m-d H:i');

            if (isset($_POST['amount'])) {
                $user = User::model()->findByPk(Yii::app()->user->id);
                $user->saldo -=$_POST['amount'];
                $user->save();
                user()->saldo = $user->saldo;
            }
            if (isset($_POST['amount'])) {
                $user = User::model()->findByPk($_POST['to_user_id']);
                $user->saldo +=$_POST['amount'];
                $user->save();
//                user()->saldo = $user->saldo;
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

        if (isset($_POST['Transfer'])) {
            $model->attributes = $_POST['Transfer'];
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

        $model = new Transfer('search');
        $model->unsetAttributes();  // clear any default values
        $model->created_user_id = user()->id;

        if (isset($_GET['Transfer'])) {
            $model->attributes = $_GET['Transfer'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->amount))
                $criteria->addCondition('amount = "' . $model->amount . '"');


            if (!empty($model->to_user_id))
                $criteria->addCondition('to_user_id = "' . $model->to_user_id . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Transfer_records'] = Transfer::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Transfer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Transfer']))
            $model->attributes = $_GET['Transfer'];

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
        $model = Transfer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'transfer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Transfer_records'])) {
            $model = $session['Transfer_records'];
        }
        else
            $model = Transfer::model()->findAll();


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

        if (isset($session['Transfer_records'])) {
            $model = $session['Transfer_records'];
        }
        else
            $model = Transfer::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Transfer');
        $pdf->SetSubject('Laporan Transfer Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Transfer, "");
        $pdf->SetHeaderData("", "", "Laporan Transfer", "");
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
        $pdf->Output("Transfer_002.pdf", "I");
    }

}
