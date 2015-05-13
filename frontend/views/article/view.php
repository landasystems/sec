<?php
cs()->registerCss('','
        ul.entry-meta li {
                display: inline-block;
                margin: 0 10px 0 0;
                background-repeat: no-repeat;
                line-height: 1em;
                        font-size:0.85em;
        }
         ul.entry-meta [class^="icon-"], [class*=" icon-"] {
         line-height: 1em;
        }
         ul.entry-meta [class^="icon-"], [class*=" icon-"] {
            line-height: 1.5em;
           }
           ');
$this->setPageTitle($model->title);
//$this->setMetaDescription($model->description);
//$this->setMetaKeyword($model->keyword);
//trace($_GET['alias']);
$this->breadcrumbs = array(
//    'Articles' => array('index'),
    $model->title,
    
);


if ($siteConfig->article_socialmedia){
    $sosmed = $this->widget('common.extensions.landa.widgets.LandaInformation', array('socials'=>$siteConfig->article_socialmedia), true);
}elseif (isset($param->socialmedia) && $param->socialmedia) {
    $sosmed = $this->widget('common.extensions.landa.widgets.LandaInformation', array('socials'=>$siteConfig->article_socialmedia), true);
}else{
    $sosmed = '';
}

if ($siteConfig->article_comment){
    $comment = $this->widget('common.extensions.FBComment', array('posts'=>$siteConfig->article_comment), true);
}elseif (isset($param->comment) && $param->comment) {
    $comment = $this->widget('common.extensions.FBComment', array('posts'=>$siteConfig->article_comment), true);
}else{
    $comment = '';
}



$sImage = (strpos($model->img['small'],'noimage')) ? '' : '<a href="' . $model->img['big'].'" target="_blank"><div class=""><img src="' . $model->img['medium'] . '" align="left" class="img-polaroid" style="margin-right:6px;width:30%"  alt=""/></a></div>';

echo '<h3>'.$model->title.'</h3><hr/>';
echo '
    <div class="row-fluid">
        <div class="span4">
            <ul class="entry-meta">
                <li class="entry-category"><i class="icon-eye-open"></i> ' . $model->hits . '</li>
                <li class="entry-author"><i class="icon-ok-sign"> </i> ' . date('d F Y, G:i', strtotime($model->created)) . '</li>
            </ul>
        </div>
        <div class="span8" style="text-align:right">
            '.$sosmed.'
        </div>
    </div><br/>';
echo $sImage .$model->content.'';
echo $comment;

?>

