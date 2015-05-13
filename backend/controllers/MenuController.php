<?php

class MenuController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("Menu","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("Menu","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("Menu","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("Menu","d")'
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

    public function actionSelectMenuCategory() {
        if (isset($_POST['Menu']['menu_category_id'])) {
            $menu = Menu::model()->findAll(array('order' => 'root, lft', 'condition' => 'menu_category_id=' . $_POST['Menu']['menu_category_id']));
            $menu = CHtml::listData($menu, 'id', 'nestedname');
            $return['parent'] = CHtml::dropDownList('Menu[parent_id]', '', $menu, array('class' => 'span3', 'empty' => 'root',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => url('menu/selectMenuSubCategory'),
                            'success' => 'function(data) {                                   
                                obj = JSON.parse(data);                                                                       
                                $(".ordering").html(obj.ordering);
                                    }
                        ',
                        )
            ));
//            $menu = Menu::model()->findAll(array('order' => 'root, lft', 'condition' => 'level=1 and menu_category_id=' . $_POST['Menu']['menu_category_id']));
//            $menu = CHtml::listData($menu, 'id', 'nestedname');
//            $first = array('first' => 'Move First', 'Last' => 'Move Last', 'sparator' => '--------------------------------------------');
//            $menu = $first + $menu;
            $menu = array();
            $return['ordering'] = CHtml::dropDownList('Menu[ordering]', '', $menu, array('class' => 'span3', 'empty' => 'Select Ordering Menu'));

            echo json_encode($return);
        }
    }

    public function actionSelectMenuSubCategory() {
        if (!empty($_POST['Menu']['parent_id'])) {
            $menu = Menu::model()->findAll(array('order' => 'root, lft', 'condition' => 'parent_id=' . $_POST['Menu']['parent_id']));
            $menu = CHtml::listData($menu, 'id', 'name');
            $first = array('first' => 'Move First', 'Last' => 'Move Last', 'sparator' => '--------------------------------------------');
            $menu = $first + $menu;
        } else {
//            $menu = Menu::model()->findAll(array('order' => 'root, lft', 'condition' => 'level=1 and menu_category_id=' . $_POST['Menu']['menu_category_id']));
            $menu = array();
        }
        $return['ordering'] = CHtml::dropDownList('Menu[ordering]', '', $menu, array('class' => 'span3', 'empty' => 'Select Ordering Menu'));

        echo json_encode($return);
    }

    public function actionCreate() {
        $model = new Menu;
        if (isset($_GET['type'])) {
            $model->type = $_GET['type'];
        }

        if (isset($_POST['Menu'])) {
            $param = json_encode($_POST['Menu']['param']);
            if ($_POST['Menu']['parent_id']) {
                $child = new Menu;
                if (empty($_POST['Menu']['alias'])) {
                    $child->alias = Yii::app()->landa->urlParsing($_POST['Menu']['name']);
                } else {
                    $child->alias = Yii::app()->landa->urlParsing($_POST['Menu']['alias']);
                }
                $child->attributes = $_POST['Menu'];
                $child->param = $param;
                $child->type = $_GET['type'];

                $root = $model->findByPk($_POST['Menu']['parent_id']);
                $child->appendTo($root);

                if ($_POST['Menu']['ordering'] == "first") {
                    $parent = Menu::model()->findByPk($child->parent_id);
                    $child->moveAsFirst($parent);
                } elseif ($_POST['Menu']['ordering'] == "last") {
                    $parent = Menu::model()->findByPk($child->parent_id);
                    $child->moveAsLast($parent);
                } elseif ($_POST['Menu']['ordering'] == "sparator") {
                    
                } elseif ($_POST['Menu']['ordering'] != "") {  // berisi id dari ordering -> di set after
                    $after = Menu::model()->findByPk($_POST['Menu']['ordering']);
                    $child->moveAfter($after);
                }
                $this->redirect(array('view', 'id' => $child->id));
            } else {
                $model->attributes = $_POST['Menu'];
                if (empty($_POST['Menu']['alias'])) {
                    $model->alias = Yii::app()->landa->urlParsing($_POST['Menu']['name']);
                } else {
                    $model->alias = Yii::app()->landa->urlParsing($_POST['Menu']['alias']);
                }
                $model->param = $param;
                $model->saveNode();


                if ($_POST['Menu']['ordering'] == "first") {
                    $model->moveAsFirst();
                } elseif ($_POST['Menu']['ordering'] == "last") {
                    $model->moveAsLast();
                } elseif ($_POST['Menu']['ordering'] == "sparator") {
                    
                } elseif ($_POST['Menu']['ordering'] != "") {  // berisi id dari ordering -> di set after
                    $after = Menu::model()->findByPk($_POST['Menu']['ordering']);
                    $model->moveAfter($after);
                }


                if ($model->saveNode()) {
//clear session 
                    unset(Yii::app()->session['listMenu']);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

//    public function generateLink($param_post) {
//        $rtn = '';
//        
//        if ($param_post['Menu']['type'] == 'url') {
//            $rtn = 'http://' . $param_post['Menu']['link'];
//        } elseif ($_POST['Menu']['type'] == 'singleArticle') {
//            $rtn = '{menuid}/1/' . Yii::app()->landa->urlParsing($param_post['Menu']['name']);
//        }
//        
//        return $rtn;
//    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);
        if (isset($_GET['type'])) {
            $model->type = $_GET['type'];
        }
        if (isset($_POST['Menu'])) {
            if (isset($_POST['Menu']['param']))
                $param = json_encode($_POST['Menu']['param']);
            else
                $param = json_encode(array());

//set attributes
            $model->attributes = $_POST['Menu'];
            $model->param = $param;
            if (empty($_POST['Menu']['alias'])) {
                $model->alias = Yii::app()->landa->urlParsing($_POST['Menu']['name']);
            } else {
                $model->alias = Yii::app()->landa->urlParsing($_POST['Menu']['alias']);
            }

            if ($_POST['Menu']['parent_id']) {
                if ($model->saveNode()) {
                    $root = $model->findByPk($_POST['Menu']['parent_id']);
                    $model->moveAsFirst($root);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {
                $model->saveNode();
                if (!($model->isRoot()))
                    $model->moveAsRoot();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

//clear session 
        unset(Yii::app()->session['listMenu']);

        $this->render('update', array(
            'model' => $model
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
            $this->loadModel($id)->deleteNode();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Menu('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Menu'])) {
            $model->attributes = $_GET['Menu'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->ordering))
                $criteria->addCondition('ordering = "' . $model->ordering . '"');


            if (!empty($model->access))
                $criteria->addCondition('access = "' . $model->access . '"');


            if (!empty($model->lft))
                $criteria->addCondition('lft = "' . $model->lft . '"');


            if (!empty($model->rgt))
                $criteria->addCondition('rgt = "' . $model->rgt . '"');


            if (!empty($model->root))
                $criteria->addCondition('root = "' . $model->root . '"');


            if (!empty($model->link))
                $criteria->addCondition('link = "' . $model->link . '"');


            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');
        }
        $session['Menu_records'] = Menu::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Menu('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Menu']))
            $model->attributes = $_GET['Menu'];

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
        $model = Menu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Menu_records'])) {
            $model = $session['Menu_records'];
        } else
            $model = Menu::model()->findAll();


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

        if (isset($session['Menu_records'])) {
            $model = $session['Menu_records'];
        } else
            $model = Menu::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

//die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Menu');
        $pdf->SetSubject('Laporan Menu Report');
//$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Menu, "");
        $pdf->SetHeaderData("", "", "Laporan Menu", "");
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
        $pdf->Output("Menu_002.pdf", "I");
    }

//    public function actionTypeParam() {
//        $data = array();
//        if ($_POST['type'] == 'url') {
//            $this->renderPartial('_type_url', $data);
//        } elseif ($_POST['type'] == 'article') {
//            $this->renderPartial('_type_article', $data);
//        }
//    }
}
