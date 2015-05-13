<div class="form">
    <?php
    $settings = json_decode($model->settings);

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'site-config-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <?php
        $accessEcommerce = in_array('ecommerce', param('menu'));
        $accessSms = in_array('sms', param('menu'));
        $accessSaldo = in_array('saldo', param('menu'));
        $accessUser = in_array('user', param('menu'));
        $accessDonation = in_array('donation', param('menu'));
        $bank = '<li><a href="#bank">Bank Account</a></li>';
        $formatting = '<li><a href="#formating">Formating</a></li>';
        $sBank = ($accessEcommerce || $accessSaldo ) ? $bank : '';

        $sMenu = '';
        if (in_array('ecommerce', param('menu'))) {
            $sMenu .= '<li><a style="padding: 3px" href="#emailRegister">Register Email</a></li>
                    <li><a style="padding: 3px" href="#emailSell">Sell Order Email</a></li>
                    <li><a style="padding: 3px" href="#emailPayment">Payment Email</a></li>
                    <li><a style="padding: 3px" href="#emailOrder">Checkout Email</a></li>
                    <li><a style="padding: 3px" href="#emailConfirm">Confirm Email</a></li>
                    <li><a style="padding: 3px" href="#emailReject">Reject Email</a></li>
                    <li><a style="padding: 3px" href="#emailDelivered">Delivered Email</a></li>';
        }
        if (in_array('user', param('menu'))) {
            $sMenu .= '<li><a style="padding: 3px" href="#emailRegister">Register Email</a></li>';
        }
        ?>
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#site">Site</a></li>
            <li><a href="#common">Common</a></li>
            <?php
            echo $sBank;
            if ($accessEcommerce || $accessUser) {
                echo'
               
               ' . $formatting . '
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Format Layout Email <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    ' . $sMenu . '
                </ul>
            </li> ';
            }

            if (in_array('game', param('menu'))) {
                echo '<li><a href="#game">Game</a></li>';
            }
            ?>

        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="site">

                <div class="row">
                    <div class="span5">
                        <?php echo $form->textFieldRow($model, 'client_name', array('class' => 'span5', 'maxlength' => 255)); ?>
                        <?php echo $form->fileFieldRow($model, 'client_logo', array('class' => 'span5')); ?>
                        <?php // echo $form->dropDownListRow($model, 'language_default', array('id' => 'Indonesia', 'en' => 'English')); ?>
                        <div class="control-group ">
                            <?php
                            echo CHtml::activeLabel($model, 'province_id', array('class' => 'control-label'));
                            ?>
                            <div class="controls">
                                <?php
                                echo CHtml::dropDownList('province_id', $model->City->province_id, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array(
                                    'empty' => t('choose', 'global'),
                                    'ajax' => array(
                                        'type' => 'POST',
                                        'url' => CController::createUrl('landa/city/dynacities'),
                                        'update' => '#SiteConfig_city_id',
                                    ),
                                ));
                                ?>  
                            </div>
                        </div>
                        <?php echo $form->dropDownListRow($model, 'city_id', CHtml::listData(City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $model->City->province_id)), 'id', 'name'), array('class' => 'span3')); ?>
                        <?php echo $form->textFieldRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
                        <?php echo $form->textFieldRow($model, 'phone', array('class' => 'span5', 'maxlength' => 45)); ?>
                        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 45)); ?>
                    </div>
                    <div class="span5" style="padding-left: 98px;">
                        <?php
//                        if ($restrictSms) {
//                            echo $form->dropDownListRow(
//                                    $model, 'roles_contact', CHtml::listData(User::model()->roles(), 'id', 'name'), array('multiple' => true, 'class' => 'span4')
//                            );
//                        }
//                        
                        ?>
                        <?php
//                        if ($restrictEcommerce) {
//                            echo $form->dropDownListRow(
//                                    $model, 'roles_customer', CHtml::listData(User::model()->roles(), 'id', 'name'), array('multiple' => true, 'class' => 'span4')
//                            );
//                        }
//                        
                        ?>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="common">
                <?php echo $form->textFieldRow($model, 'url_facebook', array('class' => 'span2', 'maxlength' => 255, 'prepend' => 'http://www.facebook.com/')); ?>
                <?php echo $form->textFieldRow($model, 'url_twitter', array('class' => 'span2', 'maxlength' => 255, 'prepend' => 'http://www.twitter.com/')); ?>
                <?php echo $form->textFieldRow($model, 'url_ym', array('class' => 'span2', 'maxlength' => 255, 'prepend' => 'http://www.yahoo.com/')); ?>
                <?php echo $form->textFieldRow($model, 'lat', array('class' => 'span5', 'maxlength' => 255)); ?>
                <?php echo $form->textFieldRow($model, 'lng', array('class' => 'span5', 'maxlength' => 255)); ?>
                <?php echo $form->toggleButtonRow($model, 'article_socialmedia'); ?>
                <?php echo $form->toggleButtonRow($model, 'article_comment'); ?>
                <?php echo $form->dropDownListRow($model, 'article_comment_color', array('light' => 'Light', 'dark' => 'Dark')); ?>
                <div class="control-group" style>
                    <label class="control-label">Roles Register User</label>
                    <div class="controls">
                        <?php
//                        echo CHtml::dropDownList('SiteConfig[settings][register_user_id]', (isset($settings->register_user_id)) ? $settings->register_user_id : '', CHtml::listData(Roles::model()->findAll(), 'id', 'name'));
                        ?>
                    </div>

                </div>
               

            </div>
            <?php if ($accessEcommerce || $accessSaldo) { ?>
                <div class="tab-pane" id="bank">                                               
                    <?php
                    echo $form->textAreaRow(
                            $model, 'bank_account', array(
                        'class' => 'span4',
                        'label' => 'List Bank Account',
                        'rows' => 5,
                        'height' => '200',
                            )
                    );

//                echo $form->html5EditorRow(
//                        $model, 'bank_account', array(
//                    'class' => 'span4',
//                    'hint' => 'One account bank per line with format : <b>[name bank] - [account name] - [account number]</b><br>example : <br> BCA - Yulianto Frandi - 0824655421 <br> Mandiri - Yulianto Frandi - 645646545',
//                    'rows' => 5,
//                    'height' => '200',
//                    'options' => array('color' => true)
//                        )
//                );
                    ?>     
                    <div class="well">
                        One account bank per line with format : <b>[name bank] - [account name] - [account number]</b><br>example : <br> BCA - Yulianto Frandi - 0824655421  <br> Mandiri - Yulianto Frandi - 645646545
                    </div>
                </div>

                <div class="tab-pane" id="formating">    
                    <?php
                    if ($accessEcommerce) {
                        echo $form->dropDownListRow($model, 'method', array('fifo' => 'FIFO', 'lifo' => 'LIFO'));
                        echo $form->textFieldRow($model, 'format_sell', array('class' => 'span5', 'maxlength' => 255));
                        echo $form->textFieldRow($model, 'format_in', array('class' => 'span5', 'maxlength' => 255));
                        echo $form->textFieldRow($model, 'format_out', array('class' => 'span5', 'maxlength' => 255));
                        echo $form->textFieldRow($model, 'format_opname', array('class' => 'span5', 'maxlength' => 255));
                    }
                    ?>

                    <?php if ($accessUser) { ?>

                        <div class="control-group" style>
                            <label class="control-label">Format Register User Code</label>
                            <div class="controls">
                                <?php
//                                trace($settings);
                                $this->widget(
                                        'bootstrap.widgets.TbToggleButton', array(
                                    'name' => 'SiteConfig[settings][register_is_generate_code]',
                                    'value' => (isset($settings->register_is_generate_code) && $settings->register_is_generate_code) ? TRUE : false,
                                    'enabledLabel' => 'YES',
                                    'disabledLabel' => 'NO',
                                        )
                                );
                                ?>

                            </div>

                        </div>
                        <div class="control-group" style>
                            <label class="control-label">Format Register User Code</label>
                            <div class="controls">
                                <?php echo CHtml::textField('SiteConfig[settings][format][user]', (isset($settings->format->user)) ? $settings->format->user : '', array('class' => 'span5', 'maxlength' => 255, 'placeholder' => 'enter code register')); ?>
                            </div>
                        </div>

                    <?php } ?>

                    <div class="well">
                        <ul>
                            <li>Isikan formating code, agar sistem dapat melakukan generate kode untuk module - module yang sudah tersedia</li>
                            <li><b>{ai|<em>3</em>}</b> / <b>{ai|<em>4</em>}</b>  / <b>{ai|<em>5</em>}</b> / <b>{ai|<em>6</em>}</b> : berikan format berikut untuk generate Auto Increase Numbering, contoh {ai|5} untuk 5 digit angka, {ai|3} untuk 3 digit angka</li>
                            <li><b>{dd}</b>/<b>{mm}</b>/<b>{yy}</b> : berikan format berikut untuk melakukan generate tanggal, bulan, dan tahun </li>
                            <li>Contoh Formating : <b>PO/{dd}/{mm}{yy}/{ai|5}</b>, Hasil Generate : <b>PO/14/0713/00001</b></li>
                        </ul>
                    </div>             
                </div>  

                <?php
                if (in_array('game', param('menu'))) {
                    $this->renderPartial('_formGame', array('settings'=>$settings));
                }
                ?>

                <div class="tab-pane" id="emailRegister">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_register', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      


                    <div class="well">
                        <ul>
                            <li>Design layout email register anda. Dan gunakan format berikut untuk men-generate sebuah field.</li>
                            <li><b>{name}</b>  : Mengembalikan nama user</li>
                            <li><b>{username}</b> : Mengembalikan username user</li>
                            <li><b>{email}</b> : Mengembalikan email user</li>
                            <li><b>{password}</b> : Mengembalikan email user</li>                        
                            <li><b>{confirm}</b> : Mengembalikan hasil generate link konfirmasi untuk user</li>
                        </ul>
                    </div>   
                </div>     

                <div class="tab-pane" id="emailSell">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_sell', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      


                    <div class="well">
                        <ul>
                            <li>Design layout email sell order anda. Dan gunakan format berikut untuk men-generate sebuah field.</li>
                            <li><b>{invoice}</b>  : Mengembalikan nomer invoice pembelian</li>
                            <li><b>{name}</b> : Mengembalikan nama pembeli</li>
                            <li><b>{city}</b> : Mengembalikan kota pada alamat tujuan pengiriman</li>
                            <li><b>{province}</b> : Mengembalikan provinsi pada alamat tujuan pengiriman</li>
                            <li><b>{address}</b> : Mengembalikan alamat tujuan pengiriman </li>
                            <li><b>{phone}</b> : Mengembalikan nomor telephone pembeli</li>                        
                            <li><b>{listproduct}</b> : Mengembalikan daftar produk yang dibeli</li>
                            <li><b>{confirm}</b> : Mengembalikan hasil generate link konfirmasi pembayaran</li>
                        </ul>
                    </div>   
                </div>             

                <div class="tab-pane" id="emailPayment">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_payment', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      


                    <div class="well">
                        <ul>
                            <li>Design layout email payment anda. Dan gunakan format berikut untuk men-generate sebuah field.</li>
                            <li><b>{invoice}</b>  : Mengembalikan nomor transaksi  yang dikonfirmasi</li>
                            <li><b>{name}</b>  : Mengembalikan nama account</li>
                            <li><b>{accountnumber}</b> : Mengembalikan nomer rekening</li>
                            <li><b>{amount}</b> : Mengembalikan total yang dibayar</li>
                            <li><b>{destination}</b> : Mengembalikan tujuan transfer bank</li>                                                
                            <li><b>{note}</b> : Mengembalikan note saat transfer</li>                                                
                        </ul>
                    </div>   
                </div>
                <div class="tab-pane" id="emailOrder">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_order', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      



                </div>
                <div class="tab-pane" id="emailConfirm">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_confirm', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      



                </div>
                <div class="tab-pane" id="emailReject">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_reject', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      



                </div>
                <div class="tab-pane" id="emailDelivered">                                
                    <?php
                    echo $form->ckEditorRow(
                            $model, 'mail_delivered', array(
                        'options' => array(
                            'fullpage' => 'js:true',
                            'resize_maxWidth' => '1007',
                            'resize_minWidth' => '320'
                        ), 'label' => false,
                            )
                    );
                    ?>      



                </div>
            <?php } ?>

        </div>            


</div>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'reset',
        'icon' => 'remove',
        'label' => 'Reset',
    ));
    ?>
</div>
</fieldset>

<?php $this->endWidget(); ?>

</div>
