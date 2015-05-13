<?php

class ArticleController extends CController {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'mainSingle';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->clientScript->registerMetaTag('foo, bar', 'keywords');

        $param = json_decode($_GET['menuParam']);
        if (!empty($param->layout)) {
            if ($param->layout == 'mainsingle2') {
                $this->layout = 'mainSingle2';
            } elseif ($param->layout == 'mainsingle3') {
                $this->layout = 'mainSingle3';
            } elseif ($param->layout == 'mainsingle4') {
                $this->layout = 'mainSingle4';
            } elseif ($param->layout == 'mainsingle5') {
                $this->layout = 'mainSingle5';
            } elseif ($param->layout == 'mainsingle4b') {
                $this->layout = 'mainSingle4b';
            } elseif ($param->layout == 'mainsingle4c') {
                $this->layout = 'mainSingle4c';
            } elseif ($param->layout == 'mainsingle6') {
                $this->layout = 'mainSingle6';
            } else {
                $this->layout = 'mainSingle7';
            }
        } else {
            if (isset($_GET['access']) && $_GET['access'] == 'login')
                $this->layout = 'mainDashboardSingle';
        }

        $model = $this->loadModel($id);
        
        cs()->registerMetaTag($model->keyword, 'keywords', null, array());
        cs()->registerMetaTag(param('clientName') . '.' . $model->description, 'description', null, array());
        cs()->registerMetaTag($model->title, null, null, array('property' => 'og:title'));
        cs()->registerMetaTag('article', null, null, array('property' => 'og:type'));
        cs()->registerMetaTag(url($model->title), null, null, array('property' => 'og:url'));
        cs()->registerMetaTag(param('client'), null, null, array('property' => 'og:site_name'));
        cs()->registerMetaTag($model->img['medium'], null, null, array('property' => 'og:image'));
        
        $this->addHits($model);
        $this->render('view', array(
            'siteConfig' => SiteConfig::model()->listSiteConfig(),
            'model' => $model,
            'param' => $param,
        ));
    }

    public function actionViewByAlias($alias) {

//        cs()->registerMetaTag('description',null,null,array('property'=>'og:title'));
        if (isset($_GET['access']) && $_GET['access'] == 'login')
            $this->layout = 'mainDashboardSingle';

        if (isset($_GET['menuParam'])) {
            $param = json_decode($_GET['menuParam']);
        } else {
            $param = array();
        }

//        $breadcumb = array()
        $model = $this->loadModelByAlias($alias);
        $this->addHits($model);

        cs()->registerMetaTag($model->keyword, 'keywords', null, array());
        cs()->registerMetaTag(param('clientName') . '.' . $model->description, 'description', null, array());
        cs()->registerMetaTag($model->title, null, null, array('property' => 'og:title'));
        cs()->registerMetaTag('article', null, null, array('property' => 'og:type'));
        cs()->registerMetaTag(url($model->title), null, null, array('property' => 'og:url'));
        cs()->registerMetaTag(param('client'), null, null, array('property' => 'og:site_name'));
        cs()->registerMetaTag($model->img['medium'], null, null, array('property' => 'og:image'));


        $this->render('view', array(
            'model' => $model,
            'siteConfig' => SiteConfig::model()->listSiteConfig(),
//            'param'=>  json_decode($_GET['menuParam']),
        ));
    }

    public function actionViewList($id) {
        Yii::app()->clientScript->registerMetaTag('foo, bar', 'keywords');
        $this->render('viewList', array(
            'model' => Article::model()->findAll('article_category_id=:article_category_id', array(':article_category_id' => $id)),
            'modelCategorys' => ArticleCategory::model()->findAll('parent_id=:parent_id', array(':parent_id' => $id)),
            'modelCategory' => ArticleCategory::model()->findByPk($id),
        ));
    }

//    public function actionViewCoba() {
//        
//        
//        $criteria = new CDbCriteria();
//        $count = Article::model()->count(array('order' => 'created DESC', 'condition' => 'article_category_id=' . 50));
//        $pages = new CPagination($count);
//
//        // results per page
//        $pages->pageSize = 10;
//        $pages->applyLimit($criteria);
//
//        app()->landa->registerAssetCss('landaBlog.css');
//        $model = Article::model()->findAll(array('order' => 'created DESC', 'condition' => 'article_category_id=' . 50));
//        $this->render('viewBlog', array('model' => $model, 'menu' => array('name'=>'asdfgds '), 'pages' => $pages));
//    }
    public function actionViewBlog() {
        if (isset($_GET['access']) && $_GET['access'] == 'login')
            $this->layout = 'mainDashboardSingle';

        $param = json_decode($_GET['menuParam']);

        $criteria = new CDbCriteria();
        $criteria->order = 'created DESC';
        $criteria->condition = 'article_category_id=' . $param->article_category_id . ' AND publish=1';

        $total = Article::model()->count($criteria);
        // results per page
        $pages = new CPagination($total);
        $pages->setPageSize(5);
        $pages->applyLimit($criteria);

        $model = Article::model()->findAll($criteria);

        app()->landa->registerAssetCss('landaBlog.css');
        $this->render('viewBlog', array('model' => $model, 'pages' => $pages));
    }

    public function actionViewTimeline() {
        $param = json_decode($_GET['menuParam']);
        app()->landa->registerAssetCss('landaTimeline.css');
        $model = Article::model()->findAll(array('order' => 'created DESC', 'condition' => 'article_category_id=' . $param->article_category_id . ' AND publish=1'));
        $this->render('viewTimeline', array('model' => $model));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Article::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelByAlias($alias) {
        $model = Article::model()->find(array('condition' => 'alias="' . $alias . '"'));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function addHits($model) {
        $model->hits++;
        $model->save();
    }

    public function actionSearchJson() {
        $article = Article::model()->findAll(array('condition' => 'content like "%' . $_POST['queryString'] . '%"', 'limit' => 7));
        $results = array();
        foreach ($article as $no => $o) {
            $results[$no]['url'] = $o->url;
            $results[$no]['img'] = $o->img['small'];
            $results[$no]['title'] = $o->title;
            $results[$no]['description'] = substr(strip_tags($o->content), 0, 80);
        }
        echo json_encode($results);
    }

}
