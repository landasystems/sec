<?php
$this->pageTitle = $_GET['title'];
$this->breadcrumbs = array(
    $_GET['title']
);
?>
<div class="events">
    <h3 class="widget-title">Upcoming Events</h3>
    <?php $this->widget('common.extensions.landa.widgets.LandaEvent',array('model'=>$model, 'type'=>'upcoming')); ?>
    
    <h3>Past events</h3>	
    <?php $this->widget('common.extensions.landa.widgets.LandaEvent',array('model'=>$model, 'type'=>'past')); ?>
</div>
<?php
$this->widget('CLinkPager', array(
	'header' => '',
	'firstPageLabel' => '&lt;&lt;',
	'prevPageLabel' => '&lt;',
	'nextPageLabel' => '&gt;',
	'lastPageLabel' => '&lt;&lt;',
	'pages' => $pages,
));
?>