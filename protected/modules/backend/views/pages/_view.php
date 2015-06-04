<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ru')); ?>:</b>
	<?php echo CHtml::encode($data->title_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_ro')); ?>:</b>
	<?php echo CHtml::encode($data->title_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_ru')); ?>:</b>
	<?php echo CHtml::encode($data->content_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_ro')); ?>:</b>
	<?php echo CHtml::encode($data->content_ro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug_ru')); ?>:</b>
	<?php echo CHtml::encode($data->slug_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug_ro')); ?>:</b>
	<?php echo CHtml::encode($data->slug_ro); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	*/ ?>

</div>