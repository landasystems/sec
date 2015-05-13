<?php


$image = 'forum';
if (!isset($data->last_post_id) || $this->forumIsRead($data->id)) {
    $image .= '2';
} else {
    $image .= '1';
}
if ($data->locked) {
    $image .= 'l';
}
if ($data->moderated) {
    $image .= 'm';
}
if (!$data->public) {
    $image .= 'h';
}
?>

<?php if ($data->type): ?>
    <article class="clearfix">

        <div class="codo_topics_forum_img visible-desktop">
            <div class="codo_topics_no_replies"><span>
                    <?php
                    $jumlah_ribuan = 2;
                    $pemisah_ribuan = ',';
                    echo CHtml::encode($data->num_topics);
                    ?></span>topic</div>
            <div class="codo_topics_no_replies" id="codo_topics_no_views"><span><?php echo CHtml::encode($data->num_posts); ?></span>kiriman</div>

        </div>
        <div class="codo_topics_forum_content">
            <div class="codo_topics_forum_avatar ">
                <!--<a href="http://codologic.com/forum/index.php?u=/user/profile/5253">-->
                    <img src="<?php echo bt('images/forum.png')   ?>" alt="" />
                <!--</a>-->
            </div>

            <div class="codo_topics_forum_title">
                <?php echo CHtml::link(CHtml::encode($data->name), array('forum', 'id' => $data->id)); ?>

            </div>


        </div>
        <div class="codo_topics_forum_message">
            <div class="row-fluid">
                <div class="span8">
                    <?php // echo CHtml::encode($data->subtitle); ?>
                    <?php
                    $terbaru='';
                    $id='';
                    if ($data->last_post_id && $data->lastPost) {
                        $topic = BbiiTopic::model()->findAll(array('condition'=>'forum_id='.$data->id,'limit'=>3,'order'=>'id desc'));
                        foreach($topic as $a){
                         $terbaru = $a->title;
                         $id = $a->id;
                          echo '<span class="asem-jawa"><a href="'.url('forum/forum/topic', array('id'=>$id)).'">'.ucwords(strtolower($terbaru)).'</a></span><hr style="margin-top: 2px;margin-bottom: 2px;">';
                        }
//                echo CHtml::encode($data->lastPost->poster->member_name);
//        echo CHtml::encode($data->lastPost->subject);
                       
//                        echo 'Post Terakhir: <span class="asem-jawa">' . CHtml::link(CHtml::encode($data->lastPost->subject, 'next', array('style' => 'margin-left:5px;color:#5388B4')), array('style' => 'margin-left:5px;color:#5388B4', 'topic', 'id' => $data->lastPost->topic_id)) . '</span>';
                        
//                        echo '<span style="font-size: 12px;">' . DateTimeCalculation::long($data->lastPost->create_time) . ', <i>oleh</i> : <span style="color:#5388B4">' . CHtml::encode($data->lastPost->poster->member_name) . '</span></span>';
                    } else {
                        echo Yii::t('BbiiModule.bbii', '<center>Tidak ada posting</center>');
                    }
                    ?>
                </div>
                <div class="span4">
                    <?php
                    $terbaru='';
                    $id='';
                    if ($data->last_post_id && $data->lastPost) {
                        $topic = BbiiTopic::model()->findAll(array('condition'=>'forum_id='.$data->id,'limit'=>3,'order'=>'id desc'));
                        foreach($topic as $a){
                        $post = BbiiPost::model()->findByAttributes(array('topic_id'=>$a->id));
                              
                        echo '<span class="pull-right"  style="font-size: 12px;">' . date('d  M  Y H:i:s', strtotime($post->create_time)) . ' </span><br><hr style="margin-top: 2px;margin-bottom: 2px;">';
                    
                        }
//                echo CHtml::encode($data->lastPost->poster->member_name);
//        echo CHtml::encode($data->lastPost->subject);
//                        echo 'Post Terakhir: <span class="asem-jawa"><a href="'.url('forum/forum/topic', array('id'=>$id)).'">'.$terbaru.'</a></span>';
//                        echo 'Post Terakhir: <span class="asem-jawa">' . CHtml::link(CHtml::encode($data->lastPost->subject, 'next', array('style' => 'margin-left:5px;color:#5388B4')), array('style' => 'margin-left:5px;color:#5388B4', 'topic', 'id' => $data->lastPost->topic_id)) . '</span>';
                   } else {
                        echo Yii::t('BbiiModule.bbii', '<center>Tidak ada posting</center>');
                    }
                    ?>
                </div>
            </div>



        </div>
        

    </article>




<?php else: ?>
    <?php
    if ($index > 0) {
        echo '</div>';
    }
    ?>

    <div class="forum-category" style="background:#faa61a" onclick="BBii.toggleForumGroup(<?php echo $data->id; ?>, '<?php echo Yii::app()->createAbsoluteUrl($this->module->id . '/forum/setCollapsed'); ?>');">
        <div class="header5">
            <?php echo CHtml::encode($data->name); ?>
        </div>
        <div class="header4">
            <?php echo CHtml::encode($data->subtitle); ?>
        </div>
    </div>
    <div class="forum-group" id="category_<?php echo $data->id; ?>" <?php
         if ($this->collapsed($data->id)) {
             echo 'style="display:none;"';
         }
         ?>>
         <?php endif; ?>

    <?php
    if ($index == $lastIndex) {
        echo '</div>';
    }
    ?>
