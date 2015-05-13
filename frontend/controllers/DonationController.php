<?php

class DonationController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("Donation","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Donation","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Donation","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Donation","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionListRequest() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Donation('search');
        $this->render('listRequest', array('model' => $model));
    }

    public function actionListGive() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Donation('search');
        $this->render('listRequest', array('model' => $model));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionConfirmCancel() {
        $created = $_POST['created_user_id_donation'];
        $this->render('confirmCancel', array('created' => $created));
    }

    public function actionCancel() {
        if (isset($_POST['id_donation']) && isset($_POST['created_user_id_donation'])) {
            
            // cancel to user
            $user = User::model()->findByPk($_POST['created_user_id_donation']);
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
                $other['mlm_gold_slot'] = $others['mlm_gold_slot'] - $_POST['amount_less_donation'];
            } else {
                $other['mlm_gold_slot'] = $_POST['Donation']['amount'];
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
            $user->others = json_encode($other);
            $user->saldo += $_POST['amount_less_donation'];
            $user->save();

            //delete donation
            Donation::model()->deleteAll('id=' . $_POST['id_donation'] . '');
            $this->redirect(url('dashboard'));
        }
    }

    public function actionCreate() {

        $model = new Donation;
//        $silver = $_POST['coin'] * 15000;
        // $this->performAjaxValidation($model);

        if (isset($_POST['Donation'])) {
            $model->attributes = $_POST['Donation'];
            if ($_POST['type'] == 'request') {
                $model->type = $_POST['type'];
                $user = User::model()->findByPk(Yii::app()->user->id);
                $others = json_decode($user->others, true);

                if ($others['mlm_gold_slot'] < $_POST['Donation']['amount']) {
                    user()->setFlash('error', '<strong>Error! </strong>Saldo / Coin anda tidak mencukupi, Max Saldo anda : <b>' . landa()->rp($others['mlm_gold_slot']) . '</b>.');
                    $this->render('create', array('model' => $model,));
                    exit();
                }

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
                    $other['mlm_gold_slot'] = $others['mlm_gold_slot'] - $_POST['Donation']['amount'];
                } else {
                    $other['mlm_gold_slot'] = $_POST['Donation']['amount'];
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
                $user->others = json_encode($other);
//                $user->saldo -= $_POST['Donation']['amount'];
                $user->save();

                user()->saldo = $user->saldo;
            }
            if ($_POST['type'] == 'offer') {
                $other = array();

                $model->type = $_POST['type'];
                $user = User::model()->findByPk(Yii::app()->user->id);
                $others = json_decode($user->others, true);

                //checking saldo if minus, cannot process
                if ($user->saldo < $_POST['Donation']['amount']) {
                    user()->setFlash('error', '<strong>Error! </strong>Saldo / Coin anda tidak mencukupi, Max Saldo anda : <b>' . landa()->rp($user->saldo) . '</b>.');
                    $this->render('create', array('model' => $model,));
                    exit();
                }

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
                    $other['mlm_gold_slot'] = $others['mlm_gold_slot'] + $_POST['Donation']['amount'];
                } else {
                    $other['mlm_gold_slot'] = $_POST['Donation']['amount'];
                }
                if (isset($others['bank_name'])) {
                    $other['bank_name'] = $others['bank_name'];
                }else{
                    $other['bank_name'] = "";
                }
                if (isset($others['bank_account'])) {
                    $other['bank_account'] = $others['bank_account'];
                }else{
                    $other['bank_account'] ="";
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
                $user->saldo -= $_POST['Donation']['amount'];
                $user->others = json_encode($other);
                $user->save();

                user()->saldo = $user->saldo;
            }
            $model->amount_less = $_POST['Donation']['amount'];

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
    public function actionUpdate() {
        $model = new Donation;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Donation'])) {
            $model->attributes = $_POST['Donation'];
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

        $model = new Donation('search');
        $model->unsetAttributes();  // clear any default values
        $model->created_user_id = user()->id;
        if (isset($_GET['Donation'])) {
            $model->attributes = $_GET['Donation'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->amount))
                $criteria->addCondition('amount = "' . $model->amount . '"');


            if (!empty($model->amount_less))
                $criteria->addCondition('amount_less = "' . $model->amount_less . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Donation_records'] = Donation::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionRequest() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Donation('search');
        $model->unsetAttributes();  // clear any default values
//        $model->created_user_id = user()->id;
        $model->type = 'request';
        if (isset($_GET['Donation'])) {
            $model->attributes = $_GET['Donation'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->amount))
                $criteria->addCondition('amount = "' . $model->amount . '"');


            if (!empty($model->amount_less))
                $criteria->addCondition('amount_less = "' . $model->amount_less . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');

            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Donation_records'] = Donation::model()->findAll($criteria);


        $this->render('listRequest', array(
            'model' => $model,
            'type' => 'request',
        ));
    }

    public function actionOffer() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Donation('search');
        $model->unsetAttributes();  // clear any default values
//        $model->created_user_id = user()->id;
        $model->type = 'offer';
        if (isset($_GET['Donation'])) {
            $model->attributes = $_GET['Donation'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');


            if (!empty($model->amount))
                $criteria->addCondition('amount = "' . $model->amount . '"');


            if (!empty($model->amount_less))
                $criteria->addCondition('amount_less = "' . $model->amount_less . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');

            if (!empty($model->created))
                $criteria->addCondition('created = "' . date('Y-d-m ', strtotime($model->created)) . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        $session['Donation_records'] = Donation::model()->findAll($criteria);


        $this->render('listGive', array(
            'model' => $model,
            'type' => 'offer',
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Donation('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Donation']))
            $model->attributes = $_GET['Donation'];

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
        $model = Donation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'donation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Donation_records'])) {
            $model = $session['Donation_records'];
        }
        else
            $model = Donation::model()->findAll();


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

        if (isset($session['Donation_records'])) {
            $model = $session['Donation_records'];
        }
        else
            $model = Donation::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Donation');
        $pdf->SetSubject('Laporan Donation Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Donation, "");
        $pdf->SetHeaderData("", "", "Laporan Donation", "");
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
        $pdf->Output("Donation_002.pdf", "I");
    }

}
