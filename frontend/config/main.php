<?php

Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'language' => 'en',
    // preloading 'log' component
    'preload' => array('log', 'bootstrap'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'common.models.*',
        'common.models.cms.*',
        'common.components.*',
//        'application.modules.rights.*',
//        'application.modules.rights.components.*',
//        'application.modules.rights.components.dataproviders.*',
        'common.extensions.*',
        'common.extensions.image.helpers.*',
    ),
    'aliases' => array(
        'xupload' => 'common.extensions.xupload'
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'landak',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'common.extensions.giiplus'  //Ajax Crud template path
            ),
        ),
        'forum' => array(
            'class' => 'application.modules.bbii.BbiiModule',
            'adminId' => 1,
            'userClass' => 'User',
            'userIdColumn' => 'id',
            'userNameColumn' => 'username',
        ),
//        'rights' => array(
//            'superuserName'=>'Super User',
////            'appLayout' => 'common.themes.backend.spr.views.layouts.main',
//            'debug' => true,
//        ),
    ),
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=' . $db,
            'emulatePrepare' => true,
            'username' => $dbUser,
            'password' => $dbPwd,
            'tablePrefix' => 'acca_',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        ),
        'db2' => array(
            'connectionString' => 'mysql:host=localhost;dbname=landa_acca',
            'emulatePrepare' => true,
            'username' => $dbUser,
            'password' => $dbPwd,
            'tablePrefix' => 'intern_',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'class' => 'CDbConnection'          // DO NOT FORGET THIS!
        ),
        'landa' => array(
            'class' => 'LandaCore',
        ),
        'messages' => array(
            'basePath' => $root . 'common/messages/',
        ),
        'user' => array(
            // enable cookie-based authentication
//            'class' => 'RWebUser',
            // enable cookie-based authentication
            'loginUrl' => array('/site/login'),
            'allowAutoLogin' => true,
        ),
//        'authManager' => array(
//            'class' => 'RDbAuthManager',
////            'connectionID' => 'db',
//            'itemTable' => 'acca_rights_authitem',
//            'itemChildTable' => 'acca_rights_authitem_child',
//            'assignmentTable' => 'acca_rights_auth_assignment',
//            'rightsTable' => 'acca_rights',
//            'defaultRoles' => array('Guest'),
//        ),
//        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
//                '<mn:\d+>/<id:\d+>/*'=>'/article/view',
//                'artikel/<id:\d+>/*/*'=>'/article/view',
//                'artikel-kategori/<id:\d+>/*' => '/article/view',
//                '<id:\d+>/galeri'=>'/article/view', 
//                '<id:\d+>/kontak-kami'=>'/article/view',
                'index' => 'index.html',
//                'landing' => '/site/landing',
                'dashboard' => '/site/dashboard',
//                'register'=>'/user/dashboard',
//                'read/<category:\w+>/<alias:\w+>' => '/article/viewByAlias',
//                'read/<category1>/<subcat1>/<alias:\w+>' => '/article/viewByAlias',
//                'read/<category>/<subcat1>/<subcat2>/<alias:\w+>' => '/article/viewByAlias',
//                'read/<category>/<subcat1>/<subcat2>/<subcat3>/<alias:\w+>' => '/article/viewByAlias',
//                'category/<alias:\w+>' => '/article/viewByAlias',
//                'category/<subcat1>/<alias:\w+>' => '/article/viewByAlias',
                array('class' => 'LandaUrlRule'),
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'urlSuffix' => '',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'common.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '192.168.1.215'),
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
//                    'filter' => 'CLogFilter',
                ),
            ),
        ),
        'bootstrap' => array(
            'class' => 'common.extensions.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => TRUE,
        ),
        'image' => array(
            'class' => 'common.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'themeManager' => array(
            'basePath' => $root . 'common/themes/frontend/',
            'baseUrl' => $themesUrl . 'frontend/', //this is the important part, setup a subdomain just for your common dir
        ),
        'cache' => array(
            //'class'=>'system.caching.CMemCache',
            'class' => 'system.caching.CFileCache'
        ),
    ),
    'params' => array(
        'client' => $client,
        'clientName' => $clientName,
        'id' => '1',
        'urlImg' => $rootUrl . 'images/',
        'pathImg' => (isset($pathImg)) ? $pathImg : $root . 'backend/www/' . $client . '/images/',
        'menu' => $menu,
    ),
);
?>
