<?php

class ContactUsController extends Controller {
    public $layout = 'mainSingle';
    
    public function accessRules() {
        return array('allow', 'actions' => array('captcha'), 'users' => array('*'));
    }
    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }


    /**
     * Displays the contact page
     */
    public function actionIndex() {
        $site_config = SiteConfig::model()->listSiteConfig();
        app()->landa->registerAssetCss('landaContactUs.css');
        
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail($site_config->email, $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('index', array('model' => $model, 'site_config' => $site_config, 'param' => json_decode($_GET['menuParam'])));
        
        
    }
    
    public function actionSiteMap(){
        $menulvl1 = Menu::model()->findAll(array('condition'=>'level=1','order'=>'id asc'));
        $article = Article::model()->findAll(array());
        $product = Product::model()->findAll(array());
        $productcat = ProductCategory::model()->findAll(array());
        $this->render('siteMap', array('menulvl1'=>$menulvl1,'article'=>$article,'product'=>$product,'productcat'=>$productcat));
    }


}

