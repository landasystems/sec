<?php
echo '<form name="form" method="post">';
echo '<div class="btn-group" align="right">';
echo '<input align="right" class="btn " type="reset" value="Reset" />';
echo '<input align="right" class="btn " type="submit" value="    Save    " />';
echo "<input align='right' type='hidden' value='$param->form_category_id' name='form_category_id'/>";
echo '</div><br><br>';



$childForm=FormCategory::model()->findByPk($param->form_category_id);
$model=Form::model()->findAll(array('order'=>'ordering','condition'=>'form_category_id='.$param->form_category_id));

$this->renderPartial('_viewForm', array('model'=>$model,'name'=>$childForm->name));

$childForm=FormCategory::model()->findAll(array('order'=>'id','condition'=>'root='.$param->form_category_id.' and id!='.$param->form_category_id));
if (count($childForm)>0){
   
    $no=1;
    foreach ($childForm as $value) {
       $secondModel=Form::model()->findAll(array('order'=>'ordering','condition'=>'form_category_id='.$value->id));       
           $a= array('label' => substr($value->name,0,13).'..', 'content' => $this->renderPartial('_viewForm', array('model'=>$secondModel,'name'=>$value->name),true));
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

echo '</form>';
?>
