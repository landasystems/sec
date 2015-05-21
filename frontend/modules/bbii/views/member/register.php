<?php
/* @var $this ForumController */
/* @var $model BbiiMember */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    Yii::t('BbiiModule.bbii', 'Members') => array('member/index'),
    Yii::t('BbiiModule.bbii', 'Register')
);

$item = array(
    array('label' => Yii::t('BbiiModule.bbii', 'Forum'), 'url' => array('forum/index')),
 array('label' => Yii::t('BbiiModule.bbii', 'Login'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
    array('label' => Yii::t('BbiiModule.bbii', 'Members'), 'url' => array('member/index'), 'visible' => $this->isModerator() || $this->isAdmin()),
    array('label' => Yii::t('BbiiModule.bbii', 'Register'), 'url' => array('member/register'), 'visible' => Yii::app()->user->isGuest),
    array('label' => Yii::t('BbiiModule.bbii', 'Approval'), 'url' => array('moderator/approval'), 'visible' => $this->isModerator()),
    array('label' => Yii::t('BbiiModule.bbii', 'Posts'), 'url' => array('moderator/admin'), 'visible' => $this->isModerator()),
);
?>
<div id="bbii-wrapper" class="img-polaroid">
    <?php echo $this->renderPartial('_header', array('item' => $item)); ?>

    <div class="form" style='margin-top: 0px;'>

        <?php
        $form = $this->beginWidget(
                'bootstrap.widgets.TbActiveForm', array(
            'id' => 'horizontal',
            'type' => 'horizontal',
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'),
                )
        );
        ?>
        <div id="yw1">
            <ul id="yw2" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#yw1_tab_1">Register Form</a></li>
            </ul>
            <div class="tab-content"> 
                <div id="yw1_tab_1" class="tab-pane fade active in" style='padding:20px;'>
                    <?php echo $form->textFieldRow($model, 'member_name', array('class' => 'span3', 'maxlength' => 45)); ?>
                    <?php echo $form->dropDownListRow($model, 'gender', array('0' => Yii::t('BbiiModule.bbii', 'Male'), '1' => Yii::t('BbiiModule.bbii', 'Female')), array('class' => 'span3')); ?>
                    <?php
                    echo $form->datepickerRow(
                            $model, 'birthdate', array(
                        'options' => array(
                            'language' => 'en',
                            'format' => 'yyyy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'style' => 'margin:0px;',
                            'class' => 'span2'
                        )
                            ), array(
                        'prepend' => '<i class="icon-calendar"></i>'
                            )
                    );
                    ?>
                    <?php
                    $data = array_combine(DateTimeZone::listIdentifiers(), DateTimeZone::listIdentifiers());
                    ?>
                    <div class="control-group">
                        <label class="control-label">Time Zone</label>
                        <div class="controls">
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbSelect2', array(
                                'name' => 'BbiiMember[timezone]',
                                'data' => $data,
                                'options' => array(
                                    'placeholder' => 'Please Choose',
                                ),
                                'htmlOptions' => array(
                                    'class' => 'span3',
                                ),
                                    )
                            );
                            ?>
                        </div>
                    </div>
                    <?php echo $form->textFieldRow($model, 'location', array('maxlength' => 255, 'class' => 'span3')); ?>
                    <?php echo $form->textAreaRow($model, 'personal_text', array('maxlength' => 255, 'class' => 'span3')); ?>
                    <?php echo $form->textFieldRow($model, 'username', array('maxlength' => 255, 'class' => 'span3')); ?>
                    <?php echo $form->passwordFieldRow($model, 'password', array('maxlength' => 255, 'class' => 'span3')); ?>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <?php
            $this->widget(
                    'bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Register'
                    )
            );
            ?>

            <?php $this->endWidget(); ?>

        </div><!-- form -->
    </div>
</div>
