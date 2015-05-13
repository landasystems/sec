<?php
/* @var $this ForumController */
/* @var $data BbiiTopic */
?>
<article class="clearfix">

    <div class="codo_topics_topic_img">
        <a href="http://codologic.com/forum/index.php?u=/category/general-discussion">

        </a>
    </div>
    <div class="codo_topics_topic_content">
        <div class="codo_topics_topic_avatar">
            
                <img src="<?php echo bt('images/forum.png')   ?>" alt="" />
            
        </div>
        <div class="codo_topics_topic_name">
            <?php echo Yii::t('BbiiModule.bbii', '') . '' . CHtml::encode($data->starter->member_name); ?>
            <span><span id="posted_txt">posted </span><?php echo ' ' . Yii::t('BbiiModule.bbii', 'on') . ' ' . DateTimeCalculation::medium($data->firstPost->create_time); ?></span>
        </div>
        <div class="codo_topics_topic_title">
            <?php
            if($data->sticky == 1){
                echo'<u><i class="fa fa-thumb-tack"></i> Sticky</u> :';
            }
            ?>
            <?php echo CHtml::link(CHtml::encode($data->title), array('topic', 'id' => $data->id), array('class' => $data->hasPostedClass())); ?></a>
            <?php if ($this->isModerator()): ?>
                <?php echo CHtml::image($this->module->getRegisteredImage('empty.png'), 'empty'); ?>
                <?php echo CHtml::image($this->module->getRegisteredImage('update.png'), 'update', array('title' => Yii::t('BbiiModule.bbii', 'Update topic'), 'style' => 'cursor:pointer', 'onclick' => 'BBii.updateTopic(' . $data->id . ', "' . $this->createAbsoluteUrl('moderator/topic') . '")')); ?>
            <?php endif; ?>
        </div>                                        

    </div>
    <div class="codo_topics_topic_message">
        <?php
        $post = BbiiPost::model()->findByAttributes(array('topic_id' => $data->id));
        echo implode(" ", array_slice(explode(" ", $post->content), 0, 225));
        ?>


    </div>





    <div class="codo_topics_topic_foot clearfix">

        <div class="codo_topics_no_replies"><span><?php echo CHtml::encode($data->num_replies); ?></span>dibalas</div>
        <div class="codo_topics_no_replies" id="codo_topics_no_views"><span><?php echo CHtml::encode($data->num_views); ?></span>dilihat</div>
        <div class="codo_topics_last_post">
            balasan terakhir dari <a href=""><?php echo CHtml::encode($data->lastPost->poster->member_name) . CHtml::link(CHtml::image($this->module->getRegisteredImage('next.png'), 'next', array('style' => 'margin-left:5px;')), array('topic', 'id' => $data->id, 'nav' => 'last')); ?></a>
            &nbsp;·&nbsp; <span class="codo_topics_last_post_time"><?php echo DateTimeCalculation::long($data->lastPost->create_time) ?></span>
        </div>
    </div>

</article>
