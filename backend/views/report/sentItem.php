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
$this->setPageTitle('Report Sents Item');
$this->breadcrumbs = array(
    'Report Sents Item',
);
?>
<script>
    function hide() {
        $(".well").hide();
        $(".form-horizontal").hide();
    }

</script>
<div class="well">

    <div class="row-fluid">
        <div class="span11">
            <?php // echo $form->dropDownListRow($mBuy, 'departement_id', CHtml::listData(Departement::model()->findAll(), 'id', 'name'), array('class' => 'span5', 'empty' => t('choose', 'global')));  ?>      

            <?php
            echo $form->dateRangeRow(
                    $mSmsSentItem, 'last_date', array(
                'hint' => 'Click inside! An even a date range field!.',
                'prepend' => '<i class="icon-calendar"></i>',
                'options' => array('callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}')
                    )
            );
            ?>    
        </div>
        <div>
            <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>

        </div>

    </div>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'View Report',
        ));
        ?>
    </div>
    


    <?php $this->endWidget(); ?>
</div>

<?php
if (isset($mSmsSentItem->last_date)) {
    $a = explode('-', $mSmsSentItem->last_date);
    $start = date('Y/m/d', strtotime($a[0]));
    $end = date('Y/m/d', strtotime($a[1])) . " 23:59:59";

  

//    $sms = Sms::model()->findAll(array('condition' => '(last_date >="' . $start . '" AND last_date <="' . $end . '") ' ));
    $smsdet = SmsDetail::model()->findAll(array('condition' => '(created >="' . $start . '" AND created <="' . $end . '" AND created_user_id is not null AND created_user_id != "" ) '));
    $this->renderPartial('_sentItemReport', array('smsdet' => $smsdet, 'last_date' => $mSmsSentItem->last_date));
}
?>