<?php

$this->setPageTitle('Register');
$this->breadcrumbs = array(
    'Users' => array('index'),
    'Create',
);
?>

<?php

foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>     


<?php

$criteria = new CDbCriteria();
$criteria->limit = 1;
$criteria->order = 'RAND()';
$users = User::model()->find($criteria);


echo $this->renderPartial('_form', array('model' => $model, 'codeRandom' => $users, 'code' => (isset($_GET['code'])) ? $_GET['code'] : '', 'listSiteConfig' => $listSiteConfig,));
?>