<?php
/* @var $this SettingController */
/* @var $data BbiiForum (category) */
/* @var $forum[] BbiiForum */

$forumitems = array();
foreach($forum as $forumdata) {
	$forumitems['frm_'.$forumdata->id] = $this->renderPartial('_forum', array('forumdata'=>$forumdata), true);
}
?>

<table style="margin:0;">
<tbody class="category">
	<tr>
		<td class="name">
                   <strong> <?php echo $data->name; ?></strong><br>
                    <?php echo $data->subtitle; ?>
                    
			
		</td>
		<td rowspan="2" style="width:140px;">
                    <?php echo CHtml::link('<i class="brocco-icon-pencil"></i>',array('bbiiForum/update','id'=>$data->id)); ?> |
                    <?php echo CHtml::link('<i class="brocco-icon-trashcan"></i>', array('bbiiForum/del', 'id' => $data->id)); ?><br>
			<?php // echo CHtml::button(Yii::t('Edit'), array('onclick'=>'editCategory(' . $data->id . ',"' . Yii::t('Edit category') . '", "' . $this->createAbsoluteUrl('setting/getForum') .'")')); ?>
		</td>
	</tr>
	
</tbody>
<tr>
	<td colspan="2">
	<?php 
		$this->widget('zii.widgets.jui.CJuiSortable', array(
			'id' => 'sortfrm' . $data->id,
			'items' => $forumitems,
			'htmlOptions'=>array('style'=>'list-style:none;margin-top:1px;padding-right:0;'),
//			'theme'=>$this->module->juiTheme,
			'options'=>array(
				'delay'=>'100',
                            'update' => "js:function(){
                        $.ajax({
                                type: 'POST',
                                url: '{$this->createUrl('bbiiForum/sort')}',
                                data: $(this).sortable('serialize'),
                        });
                }",
//				'update'=>'js:function(){Sort(this,"' . Yii::app()->controller->createUrl('bbiiForum/sort') . '");}',
			),
		));
	?>
	</td>
</tr>
</table>