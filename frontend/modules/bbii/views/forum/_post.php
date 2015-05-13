<?php
/* @var $this ForumController */
/* @var $data BbiiPost */
/* @var $postId integer */
?>
<article class="clearfix">

    <div class="codo_topics_post_img visible-desktop">

        <div class="codo_topics_no_replies"><span><?php echo CHtml::encode($data->topic->num_replies); ?></span>dibalas</div>
        <div class="codo_topics_no_replies" id="codo_topics_no_views"><span><?php echo CHtml::encode($data->topic->num_views); ?></span>dilihat</div>
    </div>
    <div class="codo_topics_post_content">
        <div class="codo_topics_post_avatar">
            <img src="<?php echo $data->poster->imgUrl['small'] ?>">
            <?php // echo CHtml::image((isset($data->poster->avatar)) ? (Yii::app()->request->baseUrl . $this->module->avatarStorage . '/' . $data->poster->avatar) : $this->module->getRegisteredImage('empty.jpeg'), 'avatar'); ?>
            <?php echo CHtml::tag('a', array('name' => $data->id)); ?>
        </div>
        <div class="codo_topics_post_title"><?php echo CHtml::link(CHtml::encode($data->poster->member_name), array('member/view', 'id' => $data->poster->id)); ?>
            <?php if (!Yii::app()->user->isGuest) { ?>
                <?php // echo CHtml::image($this->module->getRegisteredImage('warn.png'), 'warn', array('title' => Yii::t('BbiiModule.bbii', 'Report post'), 'style' => 'cursor:pointer;', 'onclick' => 'reportPost(' . $data->id . ')')); ?>

                <?php echo CHtml::link(CHtml::image($this->module->getRegisteredImage('warn.png'), 'pm', array('title' => Yii::t('BbiiModule.bbii', 'Lapor Admin'))), array('message/sendReport', 'id' => $data->id), array('target' => '_blank')); ?>
                <?php echo CHtml::link(CHtml::image($this->module->getRegisteredImage('pm.png'), 'pm', array('title' => Yii::t('BbiiModule.bbii', 'Send private message'))), array('message/create', 'id' => $data->user_id)); ?>
                <?php echo $this->showUpvote($data->id); ?>
            <?php } ?>
        </div>
        <div class="codo_topics_post_name">

            <?php // echo (isset($postId) && $postId == $data->id) ? ' target' : ''; ?><?php // echo CHtml::encode($data->subject); ?>
            <?php // echo '&raquo; ' . CHtml::encode($data->poster->member_name); ?>



            <span>
                <span id="posted_txt"><i><?php echo DateTimeCalculation::full($data->create_time); ?></i>  &nbsp;·&nbsp;
                    <?php echo ' <span class="reputation" title="' . Yii::t('BbiiModule.bbii', 'Reputation') . '">' . $data->upvoted . '</span>'; ?>&nbsp;·&nbsp;
                    <span id="posted_txt"><i>Tanggal Gabung</i> : </span><?php echo Yii::t('BbiiModule.bbii', '') . DateTimeCalculation::shortDate($data->poster->first_visit); ?> &nbsp;·&nbsp;
                    <span id="posted_txt"><i>Total Post</i> : </span><?php echo CHtml::link(CHtml::encode($data->poster->posts), array('member/view', 'id' => $data->poster->id)); ?><br></span>
        </div>


    </div>
    <div class="codo_topics_post_message">
        <?php echo $data->content; ?>
        <?php if ($this->isModerator()): ?>
            <?php echo CHtml::link(CHtml::image($this->module->getRegisteredImage('warn.png'), 'warn', array('title' => Yii::t('BbiiModule.bbii', 'Warn user'))), array('message/create', 'id' => $data->user_id, 'type' => 1)); ?>
            <?php echo CHtml::image($this->module->getRegisteredImage('delete.png'), 'delete', array('title' => Yii::t('BbiiModule.bbii', 'Delete post'), 'style' => 'cursor:pointer;', 'onclick' => 'if(confirm("' . Yii::t('BbiiModule.bbii', 'Do you really want to delete this post?') . '")) { deletePost("' . $this->createAbsoluteUrl('moderator/delete', array('id' => $data->id)) . '") }')); ?>
            <?php echo CHtml::image($this->module->getRegisteredImage('ban.png'), 'ban', array('title' => Yii::t('BbiiModule.bbii', 'Ban IP address'), 'style' => 'cursor:pointer;', 'onclick' => 'if(confirm("' . Yii::t('BbiiModule.bbii', 'Do you really want to ban this IP address?') . '")) { banIp(' . $data->id . ', "' . $this->createAbsoluteUrl('moderator/banIp') . '") }')); ?>
        <?php endif; ?>
    </div>
    <div class="codo_topics_post_foot clearfix">
        <div class="codo_topics_no_replies">
            <?php if ($data->change_time): ?>
                <?php echo Yii::t('BbiiModule.bbii', '<i>diupdate tanggal</i>') . ': ' . DateTimeCalculation::long($data->change_time) . ', Alasan di ganti : ' . CHtml::encode($data->change_reason); ?>
            <?php endif; ?>
        </div>

        <div class="codo_topics_last_post">
           
                <table>
                    <tr>
                         <?php if (!( $data->topic->locked) ) { ?>
                        <td>
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'action' => array('forum/quote', 'id' => $data->id),
                                'enableAjaxValidation' => false,
                            ));
                            ?>
                            <button type="submit" class="btn btn-warning"><i class=" icon-share"></i> Quote</button>
                            <?php $this->endWidget(); ?>
                        </td>
                        <?php } ?>
                        <td>
                            <?php if (!($data->user_id != Yii::app()->user->id || $data->topic->locked) || $this->isModerator()) { ?>
                                <div class="form">
                                    <?php
                                    $form = $this->beginWidget('CActiveForm', array(
                                        'action' => array('forum/update', 'id' => $data->id),
                                        'enableAjaxValidation' => false,
                                    ));
                                    ?>
                                    <button type="submit" class="btn btn-warning"><i class=" icon-edit"></i> Edit</button>
                                    <?php $this->endWidget(); ?>
                                </div><!-- form -->	
                            <?php } ?>
                        
                    </td>
                </tr>
            </table>
            <div class="form">

            </div><!-- form -->	
            <?php // } ?>


        </div>
    </div>

</article>




