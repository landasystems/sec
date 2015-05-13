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
class GalleryController extends CController {

    public $breadcrumbs;
    public $layout = 'mainSingle';

    public function actionIndex() {
//        $param = json_decode($_GET['menuParam']);
        app()->landa->registerAssetCss('prettyPhoto.css', 'screen');
        app()->landa->registerAssetCss('landaGallery.css');
        app()->landa->registerAssetScript('jquery.prettyPhoto.js');
        $criteria = new CDbCriteria();
        $criteria->condition = 'gallery_category_id=' . $_GET['gallery_category_id'];
        $criteria->order = 'id DESC';
        
        
        $total = Gallery::model()->count($criteria);
        // results per page
        $pages = new CPagination($total);
        $pages->setPageSize(12);
        $pages->applyLimit($criteria);
        
        $model = Gallery::model()->findAll($criteria);
        
        app()->landa->registerAssetScript('landaGallery.js', CClientScript::POS_END);
        $modelGallery = GalleryCategory::model()->findAll(array('condition'=>'parent_id='.$_GET['gallery_category_id'], 'order'=>'id DESC'));
        $this->render('view', array(
            'model' => $model,
//            'menu'=>  $_GET['menu'],
//          'modelPortfolioCategory' => PortfolioCategory::model()->findAll(),
            'modelGallery' => $modelGallery,
            'pages'=>$pages,
        ));
        
        
        
    }

    
}

