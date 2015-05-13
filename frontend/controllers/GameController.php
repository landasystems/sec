<?php

class GameController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainSingleDashboard';
    
    public function actionGamePoker(){
        $this->layout = 'mainDashboardSingle';
        $this->render('gameFlash', array());
    }
}