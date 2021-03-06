<?php
/* @var $this MessageController */
/* @var $item array */
?>
<div id="bbii-header">
    <?php if (!Yii::app()->user->isGuest): ?>
        <div class="bbii-profile-box" style='margin-bottom: 25px;'>
            <?php echo CHtml::link(Yii::t('BbiiModule.bbii', 'Forum'), array('forum/index')); ?>
        </div>
    <?php endif; ?>
    <div class="bbii-title" style="height: 40px;"><?php // echo $this->module->forumTitle; ?></div>
    <table style="margin:0;"><tr><td style="padding:0;">
                <div id="bbii-menu">
                    <?php
                    $this->widget(
                            'bootstrap.widgets.TbMenu', array(
                        'type' => '',
                        'htmlOptions' => array('
                                    style="height:40px;"
                        '),
                        'items' => $item
                            )
                    );
                    ?>
                </div>
            </td></tr></table>
</div>
<?php if (isset($this->bbii_breadcrumbs)): ?>
    <?php
    $this->widget(
            'bootstrap.widgets.TbBreadcrumbs', array(
        'homeLink' => false,
        'links' => $this->bbii_breadcrumbs,
            )
    );
    ?><!-- breadcrumbs -->
    <?php
 endif?>