<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = 'Contact Us';
$this->breadcrumbs = array(
    'Contact Us',
);

//bt() = bu();
?>

<div id="landaContactUs">
<p><?php if (isset($param->prependText)) echo $param->prependText ?></p>
<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>
    <div class="row-fluid">
        <div class="span6 contact-inf">
            <h4>Contact Information:</h4>
            <br />
            <div class="lico lico-address">Address :</div>
            <p><?php 
            if((isset($param->contactAddress) && $param->contactAddress)){
                echo $site_config->fullAddress;
                
            }else{
                echo $site_config->address;
            }
             ?></p>

            <div class="lico lico-phone">Phone :</div>
            <p><?php echo $site_config->phone ?></p>

            <div class="lico lico-mail">Email :</div>
            <p><?php echo $site_config->email ?></p>
            <hr>
            <p>
                <?php
                
                Yii::import('common.extensions.EGMap.*');

                $gMap = new EGMap();
                $gMap->width = '100%';
                $gMap->zoom = 16;
                $gMap->setCenter($site_config->lat, $site_config->lng);

// Create GMapInfoWindow
//                $info_window = new EGMapInfoWindow('<div style="color:black">'.param('client_desc').'</div>');

// Create marker
                $marker = new EGMapMarker($site_config->lat, $site_config->lng, array('title' => $site_config->client_name));
                //$marker->addHtmlInfoWindow($info_window);
                $gMap->addMarker($marker);
                $gMap->renderMap();
                ?>

            <style>
                #EGMapContainer1 img{max-width: none}
            </style>
            </p>
        </div>

        <div class="span6">
            <div class="bordered">
                <div class="contact-form">
                    <div class="clr"></div><br />
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'contact-form',
//                'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                    ?>
                    <?php echo $form->errorSummary($model); ?>
                    <h5>Whats your Name?</h5>
                    <?php echo $form->textField($model, 'name', array('class' => 'txbx')); ?>
                    <?php echo $form->error($model, 'name'); ?><br />
                    <h5>Whats your Email?</h5>
                    <?php echo $form->textField($model, 'email', array('class' => 'txbx')); ?>
                    <?php echo $form->error($model, 'email'); ?><br />
                    <h5>Email Subject?</h5>
                    <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128, 'class' => 'txbx')); ?>
                    <?php echo $form->error($model, 'subject'); ?> <br />
                    <div class="erabox">
                        <h5>Message to us</h5>
                        <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50, 'class' => 'txbx era')); ?>
                        <?php echo $form->error($model, 'body'); ?>

                        <?php if (CCaptcha::checkRequirements()): ?>
                            <div class="row" style="text-align: left;margin-left: 20px;">
                                <h5><?php echo $form->labelEx($model, 'verifyCode'); ?></h5>
                                    <?php $this->widget('CCaptcha'); ?>
                                    <?php echo $form->textField($model, 'verifyCode'); ?>
                                <?php echo $form->error($model, 'verifyCode'); ?>
                            </div>
                        <?php endif; ?>
                        <?php echo CHtml::submitButton('Submit', array('class' => 'btn')); ?>

                        <div id="spanMessage">
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div><!-- end-contact-form  -->
            </div>
        </div>
    </div>
<?php endif; ?>





</div>