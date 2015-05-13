<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portfolio
 *
 * @author landa
 */
class EventController extends CController {

    public $breadcrumbs;
    public $layout = 'mainSingle';

    public function actionIndex() {
        $criteria = new CDbCriteria();
        //$criteria->condition = 'id=';


        $total = Event::model()->count($criteria);
        // results per page
        $pages = new CPagination($total);
        $pages->setPageSize(5);
        $pages->applyLimit($criteria);

        $model = Event::model()->findAll(array('order' => 'date_event DESC'));
        app()->landa->registerAssetCss('landaEvent.css');
//        app()->landa->registerAssetScript('jquery.prettyPhoto.js');
//        
//        app()->landa->registerAssetScript('landaGallery.js', CClientScript::POS_END);
        $this->render('view', array(
            'model' => $model,
            'pages' => $pages,
        ));
    }

    public function actionViewDetail($alias) {
        app()->landa->registerAssetCss('landaEvent.css');
        $this->render('viewDetail', array(
            'model' => $this->loadModelByAlias($alias),
//            'param'=>  json_decode($_GET['menuParam']),
        ));
    }

    public function actionCalender($alias) {
        $model = Event::model()->findAll(array('order' => 'date_event DESC'));
        app()->landa->registerAssetCss('fullcalendar.css');
//        app()->landa->registerAssetCss('landacalendar.css');
        app()->landa->registerAssetScript('fullcalendar.min.js', CClientScript::POS_END);
//        app()->landa->registerAssetScript('landaCalendar1.js');
//        app()->landa->registerAssetScript('landaCalendar2.js');
        cs()->registerScript('', '');
        cs()->registerCss('', '
           #calendar {
		width: 800px;
		margin: 0 auto;
		}
');
        $this->render('calender', array('model' => $model));
    }

    public function loadModelByAlias($alias) {

        $model = Event::model()->find(array('condition' => 'alias="' . $alias . '"'));
        
        cs()->registerMetaTag($model->content, 'keywords', null, array());
        cs()->registerMetaTag(param('clientName') . '.' . $model->content, 'description', null, array());
        cs()->registerMetaTag($model->title, null, null, array('property' => 'og:title'));
        cs()->registerMetaTag('event', null, null, array('property' => 'og:type'));
        cs()->registerMetaTag(url($model->title), null, null, array('property' => 'og:url'));
        cs()->registerMetaTag(param('client'), null, null, array('property' => 'og:site_name'));
        cs()->registerMetaTag($model->img['big'], null, null, array('property' => 'og:image'));
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        $this->addHits($model);
        return $model;
    }

    public function addHits($model) {
        $model->hits++;
        $model->save();
    }

}

