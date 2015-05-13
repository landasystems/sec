<?php

class ReportController extends Controller {

    public $breadcrumbs;
    public $layout = 'main';

//    public function filters() {
//        return array(
//            'rights', 
//        );
//    }
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // r
                'actions' => array('stockCard'),
                'expression' => 'app()->controller->isValidAccess("Report_StockCard","r")'
            ),
            array('allow', // r
                'actions' => array('buy'),
                'expression' => 'app()->controller->isValidAccess("Report_Buy","r")'
            ),
            array('allow', // r
                'actions' => array('buyRetur'),
                'expression' => 'app()->controller->isValidAccess("Report_BuyRetur","r")'
            ),
            array('allow', // r
                'actions' => array('sell'),
                'expression' => 'app()->controller->isValidAccess("Report_Sell","r")'
            ),
            array('allow', // r
                'actions' => array('sellRetur'),
                'expression' => 'app()->controller->isValidAccess("Report_SellRetur","r")'
            ),
            array('allow', // r
                'actions' => array('stockItem'),
                'expression' => 'app()->controller->isValidAccess("Report_StockItem","r")'
            ),
            array('allow', // r
                'actions' => array('sentItem'),
                'expression' => 'app()->controller->isValidAccess("Report_SentItem","r")'
            ),
            array('allow', // r
                'actions' => array('pasang'),
                'expression' => 'app()->controller->isValidAccess("Report_Pasang","r")'
            ),
            array('allow', // r
                'actions' => array('PlayRank'),
                'expression' => 'app()->controller->isValidAccess("Report_PlayRank","r")'
            ),
        );
    }

    public function actionStockCard() {
//        $modelClassroom = new Classroom;
//        $modelExam = new Exam;
//        $this->render('examReport', array('modelClassroom'=>$modelClassroom,'modelExam'=>$modelExam));
        $mProductStockCard = new ProductStockCard();
        if (isset($_POST['ProductStockCard'])) {
            $mProductStockCard->attributes = $_POST['ProductStockCard'];
        }

        $this->render('stockCard', array('mProductStockCard' => $mProductStockCard));
    }

    public function actionBuy() {
        $mBuy = new Buy();
        if (!empty($_POST['Buy']['created'])) {
            $mBuy->attributes = $_POST['Buy'];
        }

        $this->render('buy', array('mBuy' => $mBuy));
    }

    public function actionBuyRetur() {
        $mBuy = new BuyRetur();
        if (!empty($_POST['BuyRetur']['created'])) {
            $mBuy->attributes = $_POST['BuyRetur'];
        }

        $this->render('buyretur', array('mBuy' => $mBuy));
    }

    public function actionSell() {
        $mBuy = new Sell();
        if (!empty($_POST['Sell']['created'])) {
            $mBuy->attributes = $_POST['Sell'];
        }

        $this->render('sell', array('mBuy' => $mBuy));
    }

    public function actionSellRetur() {
        $mBuy = new SellRetur();
        if (!empty($_POST['SellRetur']['created'])) {
            $mBuy->attributes = $_POST['SellRetur'];
        }

        $this->render('sellretur', array('mBuy' => $mBuy));
    }

    public function actionStockItem() {
        $mProductStockItem = new Product();
        if (isset($_POST['Product'])) {
            $mProductStockItem->attributes = $_POST['Product'];
        }

        $this->render('stockItem', array('mProductStockItem' => $mProductStockItem));
    }

    public function actionSentItem() {
        $mSmsSentItem = new Sms();
        $mSmsdetSentItem = new SmsDetail();
        if (isset($_POST['Sms'])) {
            $mSmsSentItem->attributes = $_POST['Sms'];
        }
        if (isset($_POST['SmsDetail'])) {
            $mSmsdetSentItem->attributes = $_POST['SmsDetail'];
        }

        $this->render('sentItem', array('mSmsSentItem' => $mSmsSentItem, 'mSmsdetSentItem' => $mSmsdetSentItem));
    }

    public function actionPasang() {
        $mPlay = new Play();
        if (isset($_POST['Play'])) {
            $mPlay->attributes = $_POST['Play'];
        }
        $this->render('pasang', array('mPlay' => $mPlay));
    }

    public function actionPlayRank() {
        $mPlay = new Play();
        if (isset($_POST['Play'])) {
            $mPlay->attributes = $_POST['Play'];
        }
        $this->render('playRank', array('mPlay' => $mPlay));
    }

    public function actionPembuangan() {
        $mPlay = new Play();
        if (isset($_POST['Play'])) {
            $mPlay->attributes = $_POST['Play'];
        }

        if (isset($_POST['btnExcel']))
            Yii::app()->request->sendFile('pembuangan-' . date('Y-m-d', strtotime($mPlay->created)) . '.xls', 
                    $this->renderPartial('_pembuangan',array('mPlay' => $mPlay), true)
            );
        else
            $this->render('pembuangan', array('mPlay' => $mPlay));
    }

    public function actionGenerateExcelSentItem() {
        $a = explode('-', str_replace(".html", "", $_GET['last_date']));
        $start = date('Y/m/d', strtotime($a[0]));
        $end = date('Y/m/d', strtotime($a[1])) . " 23:59:59";
        logs($start);
        $model = SmsDetail::model()->findAll(array('condition' => '(created >="' . $start . '" AND created <="' . $end . '" AND created_user_id is not null AND created_user_id != "" ) '));
//        $model = Sms::model()->findAll();


        Yii::app()->request->sendFile('sentitems-' . date('dmY') . '.xls', $this->renderPartial('excelReportSentItem', array(
                    'model' => $model,
                    'start' => $start,
                    'end' => $end,
//                    'smsdet' => $smsdet,
                        ), true)
        );
    }

}

?>
