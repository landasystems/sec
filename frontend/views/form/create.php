<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->createUrl('form',array('create'=>$param->form_category_id)),'active'=>true, 'linkOptions'=>array()),
                array('label'=>'Daftar', 'icon'=>'icon-th-list', 'url'=>Yii::app()->createUrl('form',array('index'=>$param->form_category_id)), 'linkOptions'=>array()),		
//		array('label'=>'Export ke PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
//		array('label'=>'Export ke Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
	),
));
$this->endWidget();
?>

<?php
echo '<form name="form" method="post" class="">';
echo 
    '<div class="form-actions">
                <button class="btn btn-primary" id="yw3" type="submit" name="yt0">
                    <i class="icon-ok icon-white"></i> Simpan</button>            
                    <button class="btn" id="yw4" type="reset" name="yt1">
                        <i class="icon-remove"></i> Reset</button>        
    </div>';
echo "<input align='right' type='hidden' value='$param->form_category_id' name='form_category_id'/>";

$childForm=FormCategory::model()->findByPk($param->form_category_id);
$model=Form::model()->findAll(array('order'=>'ordering','condition'=>'form_category_id='.$param->form_category_id));

$this->renderPartial('_viewForm', array('model'=>$model,'name'=>$childForm->name));

$childForm=FormCategory::model()->findAll(array('order'=>'id','condition'=>'root='.$param->form_category_id.' and id!='.$param->form_category_id));
if (count($childForm)>0){
   if (count($childForm)>7) $jumlah=7;else $jumlah=20;
       
   
    $no=1;
    foreach ($childForm as $value) {
       $secondModel=Form::model()->findAll(array('order'=>'ordering','condition'=>'form_category_id='.$value->id));       
           $a= array('label' => substr($value->name,0,$jumlah).'..', 'content' => $this->renderPartial('_viewForm', array('model'=>$secondModel,'name'=>$value->name),true));
       $temp[]=$a;
       $no++;
    }
    
    $this->widget('bootstrap.widgets.TbWizard', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            
            'pagerContent' => '<div style="float:right">
                    <input type="button" class="btn button-next" name="next" value="Next" />
                    </div>
                    <div style="float:left">
                    <input type="button" class="btn button-previous" name="previous" value="Previous" />
                    </div>
                    <br /><br />',
            'options' => array(
            'nextSelector' => '.button-next',
            'previousSelector' => '.button-previous',                
            'onTabShow' => 'js:function(tab, navigation, index) {
            var $total = navigation.find("li").length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $("#wizard-bar > .bar").css({width:$percent+"%"});
            }',
    ),
    'tabs' => $temp,
    ));
}
echo 
    '<div class="form-actions">
                <button class="btn btn-primary" id="yw3" type="submit" name="yt0">
                    <i class="icon-ok icon-white"></i> Simpan</button>            
                    <button class="btn" id="yw4" type="reset" name="yt1">
                        <i class="icon-remove"></i> Reset</button>        
    </div>';
echo '</form>';
?>
