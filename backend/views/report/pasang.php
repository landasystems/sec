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
$this->setPageTitle('Report Pemasangan');
$this->breadcrumbs = array(
    'Report Pemasangan',
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
        <button onclick="js:printDiv();
                return false;" class="btn btn-primary"><i class="icon-print"></i> Print</button>
    </div>
<?php $this->endWidget(); ?>
</div>
    <?php
    if (isset($mPlay->created) && isset($mPlay->output)) {
//    $output = $mPlay->output;
//    $date = date('Y-m-d', strtotime($mPlay->created));

        $this->renderPartial('_pasangResult', array('mPlay' => $mPlay));
    }
    ?>
