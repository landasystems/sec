<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Pembuangan');
$this->breadcrumbs = array(
    'Pembuangan',
);
?> 
<div class="well">
    <?php
    echo $form->datepickerRow(
            $mPlay, 'created', array(
        'prepend' => '<i class="icon-calendar"></i>'
            )
    );
    ?>
    <?php
    echo $form->dropDownListRow($mPlay, 'output', PlayResult::model()->type(), array('class' => 'span2', 'empty' => t('choose', 'global')));
    echo $form->dropDownListRow($mPlay, 'type', Play::model()->type(), array('class' => 'span2', 'empty' => t('choose', 'global')));
    ?>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'View Report',
        ));
        ?>
        <button class="btn btn-primary" value="excel" name="btnExcel" type="submit"><i class="icon-download"></i> Export Excel</button>
    </div>
    <?php $this->endWidget(); ?>
</div>
<?php
if (isset($mPlay->created) && isset($mPlay->output)) {
//    $output = $mPlay->output;
//    $date = date('Y-m-d', strtotime($mPlay->created));

    $this->renderPartial('_pembuangan', array('mPlay' => $mPlay));
}
?>