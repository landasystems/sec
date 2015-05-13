<style>
    article > .codo_topics_post_img {
        right: 120px !important;
    }
    .codo_topics_no_replies a{
        color:#fff;
    }
    element.style {
    }
    article > .codo_topics_post_message {
        min-height: 40px !important;
        max-height: 120px !important;
    }

</style>

<article class="clearfix">

    <div class="codo_topics_post_img">


        <div class="codo_topics_no_replies"><span class="label label-info" style="color:#fff"><?php echo '<a href="' . url('forum/forum/forum', array('id' => $data->forum->id)) . '">' . $data->forum->name . '</a>'; ?></span></div>
    </div>
    <div class="codo_topics_post_content">
        <div class="codo_topics_post_avatar">
            <img src="<?php echo bt('images/forum.png') ?>" alt="" />
        </div>
        <div class="codo_topics_post_title">
            <?php
            echo CHtml::link($data->subject, array(
                'forum/topic',
                'id' => $data->topic_id,
                'nav' => $data->id
                    ), array(
//                'title' => DateTimeCalculation::medium($data->create_time) . ': ' . $data->forum->name,
                    )
            );
            ?>
        </div>
        <div class="codo_topics_post_name">

            <?php // echo (isset($postId) && $postId == $data->id) ? ' target' : ''; ?><?php // echo CHtml::encode($data->subject); ?>
            <?php // echo '&raquo; ' . CHtml::encode($data->poster->member_name); ?>



            <span>
                <span id="posted_txt"><i><?php echo DateTimeCalculation::full($data->create_time); ?></i>



                    </div>


                    </div>
                    <div class="codo_topics_post_message">
                        <?php echo $data->content; ?>

                    </div>
                    <div class="codo_topics_post_foot clearfix">
                        <div class="codo_topics_no_replies">
                            <?php if ($data->change_time): ?>
                                <?php // echo Yii::t('BbiiModule.bbii', '<i>diupdate tanggal</i>') . ': ' . DateTimeCalculation::long($data->change_time) . ', Alasan di ganti : ' . CHtml::encode($data->change_reason); ?>
                            <?php endif; ?>
                        </div>

                        <div class="codo_topics_last_post">


                            <div class="form">

                            </div><!-- form -->	
                            <?php // } ?>


                        </div>
                    </div>

                    </article>