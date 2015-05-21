<?php
/* @var $this ForumController */
/* @var $model BbiiMember */
/* @var $dataProvider CActiveDataProvider */

$this->bbii_breadcrumbs = array(
    Yii::t('BbiiModule.bbii', 'Forum') => array('forum/index'),
    Yii::t('BbiiModule.bbii', 'Members') => array('member/index'),
    $model->member_name . Yii::t('BbiiModule.bbii', '\'s profile'),
);

//$item = array(
//    array('label' => Yii::t('BbiiModule.bbii', 'Forum'), 'url' => array('forum/index')),
//    array('label' => Yii::t('BbiiModule.bbii', 'Members'), 'url' => array('member/index')),
//    array('label' => Yii::t('BbiiModule.bbii', 'Approval'), 'url' => array('moderator/approval'), 'visible' => $this->isModerator()),
//    array('label' => Yii::t('BbiiModule.bbii', 'Posts'), 'url' => array('moderator/admin'), 'visible' => $this->isModerator()),
//);

$df = Yii::app()->dateFormatter;
?>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<style>
    .breadcrumb {
        margin-bottom: 0px;
    }
</style>

<div id="bbii-wrapper" class="img-polaroid">



    <style>
        .form-horizontal .control-group {
            margin-bottom: 0px;
        }
        group:after {
            clear: none;
        }
    </style>
    <div class="bbii-box-top"><?php echo CHtml::encode($model->member_name) . Yii::t('BbiiModule.bbii', '\'s profile'); ?></div>
    <div class="row-fluid profile well" style=''>
        <?php if ($this->isModerator() || $model->id == Yii::app()->user->id): ?>
            <?php echo CHtml::htmlButton(Yii::t('BbiiModule.bbii', 'Edit profile'), array('class' => 'bbii-button-right', 'onclick' => 'js:document.location.href="' . $this->createAbsoluteUrl('member/update', array('id' => $model->id)) . '"')); ?>
        <?php endif; ?>
        <br>
        <div id="yw1">
            <ul id="yw2" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                <li class=""><a data-toggle="tab" href="#topic">Post</a></li>

            </ul>
            <div class="tab-content">
                <div id="profile" class="tab-pane fade active in" style='padding:20px;'>
                    <div class="row-fluid">
                        <div class='span2' align='center' style='padding: 0px; margin: 0px;'>
                            <img src="<?php echo $model->imgUrl['small'] ?>" class="img-rounded">

                            <strong><?php echo CHtml::encode($model->member_name); ?></strong><br>
                            <?php
                            if ($model->moderator == 1) {
                                echo '<span class="label label-info">Moderator</span>';
                            }
                            ?>
                        </div>
                        <div class='span6'>
                            <form class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Kategori Usaha</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo (isset($model->business->name) ? $model->business->name : 'Mohon di isi.') ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Type Usaha</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo $model->type_business; ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Nama Usaha</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo $model->company_name; ?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Phone</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php if (isset($model->phone)) echo CHtml::encode($model->phone); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Pin/whatsapp</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php if (isset($model->phone)) echo CHtml::encode($model->pin); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Kota/Kab</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo (isset($model->city->name)) ? CHtml::encode($model->city->name) : Yii::t('BbiiModule.bbii', '-'); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'><?php echo Yii::t('BbiiModule.bbii', 'Birthdate'); ?></label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo (isset($model->birthdate)) ? $df->formatDateTime($model->birthdate, 'long', null) : Yii::t('BbiiModule.bbii', 'Unknown'); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'><?php echo Yii::t('BbiiModule.bbii', 'Gender'); ?></label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo (isset($model->gender)) ? (($model->gender) ? Yii::t('BbiiModule.bbii', 'Perempuan') : Yii::t('BbiiModule.bbii', 'Laki-laki')) : Yii::t('BbiiModule.bbii', '-'); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Sosial / Website</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php if ($model->contact_email && $this->module->userMailColumn) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('User.png'), 'e-mail', array('title' => Yii::t('BbiiModule.bbii', 'Contact user by e-mail'))), array('member/mail', 'id' => $model->id)); ?>
                                        <?php if (isset($model->blogger)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Blogger.png'), 'Blogger', array('title' => 'Blogger', 'target' => '_blank')), $model->blogger); ?>
                                        <?php if (isset($model->facebook)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Facebook.png'), 'Facebook', array('title' => 'Facebook', 'target' => '_blank')), $model->facebook); ?>
                                        <?php if (isset($model->flickr)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Flickr.png'), 'Flickr', array('title' => 'Flickr', 'target' => '_blank')), $model->flickr); ?>
                                        <?php if (isset($model->google)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Google.png'), 'Google', array('title' => 'Google', 'target' => '_blank')), $model->google); ?>
                                        <?php if (isset($model->linkedin)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Linkedin.png'), 'Linkedin', array('title' => 'Linkedin', 'target' => '_blank')), $model->linkedin); ?>
                                        <?php if (isset($model->metacafe)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Metacafe.png'), 'Metacafe', array('title' => 'Metacafe', 'target' => '_blank')), $model->metacafe); ?>
                                        <?php if (isset($model->myspace)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Myspace.png'), 'Myspace', array('title' => 'Myspace', 'target' => '_blank')), $model->myspace); ?>
                                        <?php if (isset($model->orkut)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Orkut.png'), 'Orkut', array('title' => 'Orkut', 'target' => '_blank')), $model->orkut); ?>
                                        <?php if (isset($model->tumblr)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Tumblr.png'), 'Tumblr', array('title' => 'Tumblr', 'target' => '_blank')), $model->tumblr); ?>
                                        <?php if (isset($model->twitter)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Twitter.png'), 'Twitter', array('title' => 'Twitter', 'target' => '_blank')), $model->twitter); ?>
                                        <?php if (isset($model->website)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Globe.png'), 'Website', array('title' => 'Website', 'target' => '_blank')), $model->website); ?>
                                        <?php if (isset($model->wordpress)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Wordpress.png'), 'Wordpress', array('title' => 'Wordpress', 'target' => '_blank')), $model->wordpress); ?>
                                        <?php if (isset($model->yahoo)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Yahoo.png'), 'Yahoo', array('title' => 'Yahoo', 'target' => '_blank')), $model->yahoo); ?>
                                        <?php if (isset($model->youtube)) echo Chtml::link(CHtml::image($this->module->getRegisteredImage('Youtube.png'), 'Youtube', array('title' => 'Youtube', 'target' => '_blank')), $model->youtube); ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" style='text-align: left; font-weight: bold'>Alamat</label>
                                    <div class="controls" style='padding-top: 5px;'>
                                        <?php echo CHtml::encode($model->address); ?>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="span4">
                            <div class="control-group">
                                <label class="control-label" style='text-align: left; font-weight: bold'><?php echo Yii::t('BbiiModule.bbii', 'Number of posts'); ?></label>
                                <div class="controls" style='padding-top: 5px;'>
                                    <?php echo CHtml::encode($model->posts); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" style='text-align: left; font-weight: bold'><?php echo Yii::t('BbiiModule.bbii', 'Reputation'); ?></label>
                                <div class="controls" style='padding-top: 5px;'>
                                    <?php echo CHtml::encode($model->upvoted); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <center><img align="left" style="" src="<?php echo $model->imgUrlUsaha['medium'] ?>" alt="avatar"></center>
                    <?php echo $model->signature; ?>
                </div>

                <div id="topic" class="tab-pane fade" style='padding:20px;'>
                    <div class='span12'>
                        <div class="header2"><?php echo Yii::t('BbiiModule.bbii', 'Recent Posts'); ?></div>
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                            'dataProvider' => $dataProvider,
                            'itemView' => '_post',
                            'summaryText' => false,
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>