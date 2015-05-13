<?php
$this->setPageTitle('Lihat Transfers | ID : '. $model->id);
$this->breadcrumbs=array(
	'Transfers'=>array('index'),
	$model->id,
);
?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Transfer', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'History Transfer', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
//                array('label'=>'Edit', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id)), 'linkOptions'=>array()),
		//array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
//		array('label'=>'Print', 'icon'=>'icon-print', 'url'=>'javascript:void(0);return false', 'linkOptions'=>array('onclick'=>'printDiv();return false;')),

)));
$this->endWidget();
?>
<div class='printableArea'>


</div>
<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<div class="alert alert-success">
    Berhasil tertransfer ke <b><u><i><?php echo  $model->UserTo->name ?></i></u></b>.
</div>
<div class="well">
    <?php
    $from = (isset($model->User->name)) ? $model->User->name : '-';
    $to = (isset($model->UserTo->name)) ? $model->UserTo->name : '-';
    echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Dari</b>
                    </div>
                   
                    <div class="span8" style="text-align:left">
                        :&nbsp;&nbsp;' . $from . '
                    </div>
                </div>';
    echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Transfer Kepada</b>
                    </div>
                   
                    <div class="span8" style="text-align:left">
                        :&nbsp;&nbsp;' . $to . '
                    </div>
                </div>';
    echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Jumlah Coin</b>
                    </div>
                   
                    <div class="span8" style="text-align:left">
                        :&nbsp;&nbsp; ' .($model->amount/50000). ' Coin
                    </div>
                </div>';
    echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Jumlah Transfer</b>
                    </div>
                   
                    <div class="span8" style="text-align:left">
                         :&nbsp;&nbsp;' . landa()->rp($model->amount). '
                    </div>
                </div>';
    echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Tanggal Transfer</b>
                    </div>
                    
                    <div class="span8" style="text-align:left">
                         :&nbsp;&nbsp;' . date('d F Y', strtotime($model->created)). '
                    </div>
                </div>';
    ?>
</div>
<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
