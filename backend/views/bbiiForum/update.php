<?php
if (isset($_GET['v'])) {
    $this->setPageTitle('Lihat Bbii Forums | ID : ' . $model->id);
    $this->breadcrumbs = array(
        'Bbii Forums' => array('index'),
        $model->name,
    );
} else {
    $this->setPageTitle('Edit Bbii Forums | ID : ' . $model->id);
    $this->breadcrumbs = array(
        'Bbii Forums' => array('index'),
        $model->name => array('view', 'id' => $model->id),
        'Update',
    );
}
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
if (isset($_GET['v'])) {
    $this->widget('bootstrap.widgets.TbMenu', array(
        'type' => 'pills',
        'items' => array(
            array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
            array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
            array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id)), 'linkOptions' => array()),
            array('label' => 'Print', 'icon' => 'icon-print', 'url' => 'javascript:void(0);return false', 'linkOptions' => array('onclick' => 'printDiv();return false;')),
    )));
} else {
    $this->widget('bootstrap.widgets.TbMenu', array(
        'type' => 'pills',
        'items' => array(
            array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
            array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
            array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id)), 'active' => true, 'linkOptions' => array()),
        ),
    ));
}
$this->endWidget();
?>

<?php
if ($model->cat_id == 0) {
    ?>
    <div class="form">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'bbii-forum-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            )
        ));
        ?>
        <fieldset>
            <legend>
                <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
            </legend>

            <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
            <?php
            foreach (Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
            }
            ?>

            <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

            <?php
            echo $form->textAreaRow(
                    $model, 'subtitle', array('class' => 'span4', 'rows' => 5)
            );
            ?>
            <div class="control-group ">
                <label class="control-label" for="BbiiForum_cat_id">Poll</label>
                <div class="controls">
                    <?php
                    echo CHtml::dropDownList('BbiiForum[poll]', $model, array('0' => 'No polling', '1' => 'Moderator Poliing','2'=>'User Polling'));
                    ?>
                </div>
            </div>

            <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'submit',
                        'type' => 'primary',
                        'icon' => 'ok white',
                        'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
                    ));
                    ?>
                    <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType' => 'reset',
                        'icon' => 'remove',
                        'label' => 'Reset',
                    ));
                    ?>
                </div>
            <?php } ?>    </fieldset>

        <?php $this->endWidget(); ?>

    </div>

    <?php
} else {
    echo $this->renderPartial('_form', array('model' => $model));
}
?>