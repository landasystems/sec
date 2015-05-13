<?php
cs()->registerCss('', '
        ul.entry-meta li {
                display: inline-block;

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
//trace($_GET['alias']);
$this->breadcrumbs = array(
//    'Articles' => array('index'),
    $model->title,
);

$img = app()->landa->urlImg('event/', $model->image, $model->id);
?>
<style>
    .span9{
        padding: 20px;
    }
</style>

<div class="row " style="padding:25px">
    <div class="span12">
        <?php
        $sosmed = $this->widget('common.extensions.landa.widgets.LandaInformation', array(), true);

        $sImage = (isset($model->img['small'])) ? '<img src="' . param('urlImg') . 'file/events_medium.jpg" align="left" class="img-polaroid" style="margin-right:6px;width:30%"  alt=""/>' : '<a href="' . $model->img['big'] . '" target="_blank"><div class=""><img src="' . $model->img['medium'] . '" align="left" class="img-polaroid" style="margin-right:6px;width:30%"  alt=""/></a></div>';

        
        echo '
    <div class="row-fluid">
        <div class="span12">
        <h3>' . $model->title . '</h3>
            <ul class="entry-meta">
                <li class="entry-category"><i class="icon-eye-open"></i> ' . $model->hits . '</li>
                <li class="entry-author"><i class="icon-ok-sign"> </i> ' . date('d F Y, G:i', strtotime($model->created)) . '</li>
            </ul>
        </div>
        
    </div><br/>';
        echo $sImage . $model->content . '';
//        $this->widget('common.extensions.FBComment');
        ?>
    </div>
</div>
<div class="row " style="padding:25px">
    <div class="span12">
        <div class="row-fluid">
            <ul class="thumbnails">
                
                <?php
                $upcomming = Event::model()->findAll(array('condition'=>'date_event >="'.$model->date_event.'"','limit'=>3));
                foreach($upcomming as $a){
                    $image = (isset($model->img['small'])) ? '<img src="' . param('urlImg') . 'file/events_medium.jpg" align="left" class="img-polaroid" style=""  alt=""/>' : '<a href="' . $model->img['big'] . '" target="_blank"><div class=""><img src="' . $model->img['medium'] . '" align="left" class="img-polaroid" style=""  alt=""/></a></div>';
                    echo'
                        <li class="span4">
                    <div class="thumbnail">
                        '.$image.'
                            <br>
                        <div class="caption">
                            <p><h4> <a href="' . url('event/' . $a->alias) . '">'.$a->title.'</a></h4></p>
                        </div>
                    </div>
                </li>
                        ';
                }
                ?>
                
            </ul>
        </div>
    </div>
</div>

