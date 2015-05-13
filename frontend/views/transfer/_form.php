<?php
$accessDonation = in_array('donation', param('menu'));
if ($accessDonation) {
    ?>
    <div class="form">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'ws-finish-submit-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'action' => url('transfer/codeConfirm'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            )
        ));
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <fieldset>
            <legend>
                <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
            </legend>

            <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Code</label>
                <div class="controls">
                    <input type="text"  style="height:30px; width:140px;" name="code" placeholder="Masukan Code User">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Coin</label>
                <div class="controls">
                    <input type="text" id="coin" style="height:30px; width:70px;" name="coin" placeholder="Coin" maxlength="3">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Amount</label>
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on">Rp</span>
                        <input class="span8" id="Transfer_amount" type="text" placeholder=""  name="Transfer[amount]" readonly>
                    </div>
                </div>
            </div>
            <?php
//            echo $form->textFieldRow(
//                    $model, 'amount', array('prepend' => 'Rp', 'style' => '', 'readOnly' => true)
//            );
            ?>



            <div class="form-actions">
                <button type="submit" class="btn btn-info"><i class="icon-ok white"></i> Cek User</button>
            </div>
        </fieldset>

        <?php $this->endWidget(); ?>

    </div>
    <script>
        $("#coin").on("input", function() {
            var coin = parseInt($(this).val());
            coin = coin || 0;
            $("#Transfer_amount").val(coin * 50000);
        });

    </script>

<?php } else { ?>

    <div class="form">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'ws-finish-submit-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'action' => url('transfer/codeConfirm'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            )
        ));
        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <fieldset>
            <legend>
                <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
            </legend>

            <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Code</label>
                <div class="controls">
                    <input type="text"  style="height:30px; width:140px;" name="code" placeholder="Masukan Code User">
                </div>
            </div>
            
            <?php
            echo $form->textFieldRow(
                    $model, 'amount', array('prepend' => 'Rp', 'style' => '',)
            );
            ?>



            <div class="form-actions">
                <button type="submit" class="btn btn-info"><i class="icon-ok white"></i> Cek User</button>
            </div>
        </fieldset>

        <?php $this->endWidget(); ?>

    </div>
    

<?php } ?>