<?php
$this->setPageTitle('Confirm Code User');
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'ws-finish-submit-form',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url('transfer/create'),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<div class="well">
    <?php
    if (isset($mUser->name)) {
        $accessDonation = in_array('donation', param('menu'));
        ?>

        <?php
        if (empty($_POST['Transfer']['amount'])) {
            echo'<div class="alert alert-warning">
           Masukan jumlah coin yang akan anda transfer.
        </div>';
        } else {
            echo'<div class="alert alert-info">
            Apakah anda yakin untuk mentransfer coin anda ?
        </div>';
        }
        ?>
        <?php
        $coin = ($_POST['Transfer']['amount']) / 50000;
        echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Tujuan Transfer</b>
                    </div>
                    <div class="span5">: &nbsp;&nbsp;' . $mUser->name . '</div>
                </div>';
        if ($accessDonation) {
            echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Jumlah Coin</b>
                    </div>
                    <div class="span1">: &nbsp;&nbsp;' . $coin . '</div>
                </div>';
        }
        echo'<div class="row-fluid">
                    <div class="span3">
                        <b>Jumlah Transfer</b>
                    </div>
                    <div class="span7">: &nbsp;&nbsp;  ' . landa()->rp($_POST['Transfer']['amount']) . '</div>
                </div>';
        echo'<input type="hidden" name="created_user_id" value="' . user()->id . '">
        <input type="hidden" name="to_user_id" value="' . $mUser->id . '">
        <input type="hidden" name="amount" value="' . $_POST['Transfer']['amount'] . '">';
        ?>

    </div>  
    <div class="form-actions">
        <a class="btn btn-warning" href="<?php echo url('transfer/create') ?>"  name="request"><i class="icon-arrow-left"></i> Back</a>
        <a class="btn btn-danger" href="<?php echo url('dashboard') ?>"  name="request"><i class="icon-ok icon-remove"></i> Cancel</a>
        
        <?php
        if (!empty($_POST['Transfer']['amount'])) {
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'Transfer',
        ));
        }
        ?>   
    </div>
<?php } else { ?>
    <div class="alert alert-block">
        <strong>Maaf!!</strong> Code user yang anda masukan tidak ada.
    </div>
    <a class="btn btn-warning" href="<?php echo url('transfer/create') ?>"  name="request"><i class="icon-arrow-left"></i> Back</a>
    <a class="btn btn-danger" href="<?php echo url('dashboard') ?>"  name="request"><i class="icon-ok icon-remove"></i> Cancel</a>
    </div>  
<?php } ?>
<?php
$this->endWidget();
?>
