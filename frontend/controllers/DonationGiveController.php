<?php

class DonationGiveController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("DonationGive","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("DonationGive","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("DonationGive","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("DonationGive","d")'
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

    public function actionConfirm() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $others = json_decode($user->others, true);
        $model = new DonationGive;
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();
        $type = (isset($_POST['type'])) ? $_POST['type'] : $_POST['type_offer'];
        if ($type == 'request') {
            if (user()->saldo < $_POST['amount']) {
                user()->setFlash('error', '<strong>Error! </strong>Saldo / Coin anda tidak mencukupi, Max Saldo anda : <b>' . landa()->rp(user()->saldo) . '</b>.');
                $this->render('confirm');
                exit();
            }
        } else {
            if ($others['mlm_gold_slot'] < $_POST['amount']) {
                user()->setFlash('error', '<strong>Error! </strong>Saldo / Coin anda tidak mencukupi, Max Saldo anda : <b>' . landa()->rp($others['mlm_gold_slot']) . '</b>.');
                $this->render('confirm');
                exit();
            }
        }
        $id = (isset($_POST['id'])) ? $_POST['id'] : $_POST['id_offer'];
        $a = Donation::model()->findByPk($id);
        $user_to = User::model()->findByPk($a->created_user_id);
        $this->render('confirm', array('user_to' => $user_to, 'model' => $model));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new DonationGive;
        if ($_POST['type'] == 'request') {
//            $model->attributes = $_POST['DonationGive'];
            if (isset($_POST['amount']) && $_POST['type'] == 'request') {
                $model->donation_id = $_POST['id'];
                $model->amount = $_POST['amount'];
                $other = array();
                $donation = Donation::model()->findByPk($_POST['id']);
                $donation->amount_less -= $_POST['amount'];

                $userRequest = User::model()->findByPk($_POST['created_user_id']);
                $userRequest->saldo += $_POST['amount'];
                $user = User::model()->findByPk(Yii::app()->user->id);
                $others = json_decode($user->others, true);

//                if ($user->saldo < $_POST['amount']) {
//                    user()->setFlash('error', '<strong>Error! </strong>Saldo / Coin anda tidak mencukupi, Max Saldo anda : <b>' . $user->saldo . '</b>.');
//                    $this->render('confirm');
//                    exit();
//                }

                if (isset($others['mlm_action'])) {
                    $other['mlm_action'] = $others['mlm_action'];
                }else{
                    $other['mlm_action'] = "";
                }
                if (isset($others['mlm_silver'])) {
                    $other['mlm_silver'] = $others['mlm_silver'] + ($_POST['request_coin'] * 15000);
                } else {
                    $other['mlm_silver'] = $_POST['request_coin'] * 15000;
                }
                if (isset($others['mlm_gold_slot'])) {
                    $other['mlm_gold_slot'] = $others['mlm_gold_slot'] + $_POST['amount'];
                } else {
                    $other['mlm_gold_slot'] = $_POST['amount'];
                }
                if (isset($others['bank_name'])) {
                    $other['bank_name'] = $others['bank_name'];
                }else{
                    $other['bank_name'] = "";
                }
                if (isset($others['bank_account'])) {
                    $other['bank_account'] = $others['bank_account'];
                }else{
                    $other['bank_account'] = "";
                }
                if (isset($others['bank_account_name'])) {
                    $other['bank_account_name'] = $others['bank_account_name'];
                }else{
                    $other['bank_account_name'] = "";
                }
                if (isset($others['time_action'])) {
                    $other['time_action'] = $others['time_action'];
                }else{
                    $other['time_action'] = "";
                }
                $user->saldo -= $_POST['amount'];
                $user->others = json_encode($other);
                $userRequest->save();
                $donation->save();
                $user->save();

                user()->saldo = $user->saldo;
            }
        } elseif ($_POST['type'] == 'offer') {
            if (isset($_POST['amount']) && $_POST['type'] == 'offer' && isset($_POST['created_user_id_offer'])) {
                $model->donation_id = $_POST['id'];
                $model->amount = $_POST['amount'];
                $other = array();
                $donation = Donation::model()->findByPk($_POST['id']);
                if ($donation->amount_less == 0) {
                    user()->setFlash('error', '<strong>Error! </strong>udah di ambil</b>.');
                    $this->render('create');
                    exit();
                }
                $donation->amount_less -= $_POST['amount'];
                $donation->save();
                

                //PEMBERI ACCOUNT
                $user = User::model()->findByPk(Yii::app()->user->id);
                $others = json_decode($user->others, true);
                if (isset($others['mlm_action'])) {
                    $other['mlm_action'] = $others['mlm_action'];
                }else{
                    $other['mlm_action'] = "";
                }
                if (isset($others['mlm_silver'])) {
                    $other['mlm_silver'] = $others['mlm_silver'];
                }else{
                    $other['mlm_silver'] = "";
                }
                if (isset($others['mlm_gold_slot'])) {
                    $other['mlm_gold_slot'] = $others['mlm_gold_slot'] - $_POST['amount'];
                } else {
                    $other['mlm_gold_slot'] = $_POST['amount'];
                }
                if (isset($others['bank_name'])) {
                    $other['bank_name'] = $others['bank_name'];
                }else{
                    $other['bank_name'] = "";
                }
                if (isset($others['bank_account'])) {
                    $other['bank_account'] = $others['bank_account'];
                }else{
                    $other['bank_account'] = "";
                }
                if (isset($others['bank_account_name'])) {
                    $other['bank_account_name'] = $others['bank_account_name'];
                }else{
                    $other['bank_account_name'] = "";
                }
                if (isset($others['time_action'])) {
                    $other['time_action'] = $others['time_action'];
                }else{
                    $other['time_action'] = "";
                }
                $user->saldo += $_POST['amount'];
                $user->others = json_encode($other);
                $user->save();
                
                //PENERIMA ACCOUNT
                $userOffer = User::model()->findByPk($_POST['created_user_id_offer']);
                $user_other = json_decode($userOffer->others, true);

                if (isset($user_other['mlm_action'])) {
                    $other['mlm_action'] = $user_other['mlm_action'];
                } else {
                    $other['mlm_action'] = "";
                }
                if (isset($user_other['mlm_silver'])) {
                    $other['mlm_silver'] = $user_other['mlm_silver'] + ($_POST['offer_coin'] * 15000);
                } else {
                    $other['mlm_silver'] = $user_other['mlm_silver'];
                }
                if (isset($user_other['mlm_gold_slot'])) {
                    $other['mlm_gold_slot'] = $user_other['mlm_gold_slot'];
                } else {
                    $other['mlm_gold_slot'] = "";
                }
                if (isset($user_other['bank_name'])) {
                    $other['bank_name'] = $user_other['bank_name'];
                } else {
                    $other['bank_name'] = "";
                }
                if (isset($user_other['bank_account'])) {
                    $other['bank_account'] = $user_other['bank_account'];
                } else {
                    $other['bank_account'] = "";
                }
                if (isset($user_other['bank_account_name'])) {
                    $other['bank_account_name'] = $user_other['bank_account_name'];
                } else {
                    $other['bank_account_name'] ="";
                }
                if (isset($user_other['time_action'])) {
                    $other['time_action'] = $user_other['time_action'];
                } else {
                    $other['time_action'] ="";
                }
                $userOffer->others = json_encode($other);
                $userOffer->save();
                user()->saldo = $user->saldo;
            }
        }

        if ($model->save())
            $this->redirect(array('view', 'id' => $model->id));

//        if (isset($_POST['DonationGive'])) {
//            
//        }

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

        if (isset($_POST['DonationGive'])) {
            $model->attributes = $_POST['DonationGive'];
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

        $model = new DonationGive('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['DonationGive'])) {
            $model->attributes = $_GET['DonationGive'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->donation_id))
                $criteria->addCondition('donation_id = "' . $model->donation_id . '"');


            if (!empty($model->amount))
                $criteria->addCondition('amount = "' . $model->amount . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');
        }
        $session['DonationGive_records'] = DonationGive::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new DonationGive('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['DonationGive']))
            $model->attributes = $_GET['DonationGive'];

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
        $model = DonationGive::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'donation-give-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['DonationGive_records'])) {
            $model = $session['DonationGive_records'];
        }
        else
            $model = DonationGive::model()->findAll();


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

        if (isset($session['DonationGive_records'])) {
            $model = $session['DonationGive_records'];
        }
        else
            $model = DonationGive::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan DonationGive');
        $pdf->SetSubject('Laporan DonationGive Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" DonationGive, "");
        $pdf->SetHeaderData("", "", "Laporan DonationGive", "");
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
        $pdf->Output("DonationGive_002.pdf", "I");
    }

}
