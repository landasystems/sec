<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_avatar')); ?>:</b>
	<?php echo CHtml::encode($data->img_avatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('testimonial')); ?>:</b>
	<?php echo CHtml::encode($data->testimonial); ?>
	<br />


</div>