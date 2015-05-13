<?php
$this->setPageTitle($modelCategory->name);
$this->breadcrumbs = array(
    'Articles' => array('index'),
);

?>
<ul class="icon-lists">
    <?php 
    foreach ($modelCategorys as $m){
        echo '<li><a href="'.url('read/list/'. $m->id . '/'. $m->alias).'" style="padding-left: 30px;" class="list-right">'.$m->name.'</a></li>';
    }
    ?>
    <?php 
    foreach ($model as $m){
        if ($_GET['access']=='login') {
            $pre = 'r/';
        }else{
            $pre = 'read/';
        }
        echo '<li><a href="'.url($pre . $m->ArticleCategory->alias . '/' . $m->alias ).'" style="padding-left: 30px;" class="list-right">'.$m->title.'</a></li>';
    }
    ?>
</ul>

<ul class="nav-list">
    <?php 
//    foreach ($model as $m){
//        echo '<li><a href="'.url('read/' . $m->ArticleCategory->alias . '/' . $m->alias ).'" style="padding-left: 30px;">'.$m->title.'</a></li>';
//    }
    ?>
</ul>
