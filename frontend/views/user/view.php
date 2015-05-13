<?php
$this->setPageTitle('Lihat Users | ID : ' . $model->id);
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->name,
);
?>

<?php
$accessDonation = in_array('donation', param('menu'));
?>
<div class='printableArea'>
</div>

<table>
    <tr>
        <td width="30%" style="vertical-align: top">

            <?php
            echo $model->mediumImage;
            ?>

        </td>
        <td style="vertical-align: top;" width="70%">
            <table class="table table-striped" style="width:100%">

                <tr>
                    <td style="text-align: left" class="span1">
                        <b>Name</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4">
                        <?php echo $model->name; ?>
                    </td>
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Position</b></span>
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">
                            <?php
//                                 if($model->roles_id == -1){
//                                    echo 'Super User';
//                                 }else{
//                                 echo $model->Roles->name;
//                                 }
                            ?>
                        </span>
                    </td>

                </tr>
                <tr>
                    <td style="text-align: left" class="span1">
                        <b>Province</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4">
                        <?php echo $model->City->Province->name; ?>
                    </td>
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Phone</b></span>
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">
                            <?php echo landa()->hp($model->phone); ?>            
                        </span>
                    </td>

                </tr>
                <tr>
                    <td style="text-align: left" class="span1">
                        <b>City</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4">
                        <?php echo $model->City->name; ?>
                    </td>
                    <td style="text-align: left" class="span1">
                        <span class="inventory"><b>Email</b></span>&nbsp;
                    </td>
                    <td style="text-align: left;width:1px" class="">
                        <span class="inventory">:</span>&nbsp;
                    </td>                        
                    <td style="text-align: left" class="span4">
                        <span class="inventory">
                            <?php
                            echo $model->email;
                            ?>

                        </span>&nbsp;
                    </td>

                </tr>                     

                <tr class="inventory">
                    <td style="text-align: left" class="span2">
                        <b>Address</b>
                    </td>
                    <td style="text-align: left;width:1px">
                        :
                    </td>
                    <td style="text-align: left" class="span4">
                        <?php echo $model->address; ?>
                    </td>
                    <?php
                        if (in_array('mlm', param('menu'))) {
                            $saldo = (isset($model->saldo)) ? landa()->rp($model->saldo) : '-';
                            echo'<td style="text-align: left" class="span2 inventory">
                            <b>Saldo</b>
                        </td>
                        <td style="text-align: left;width:1px" class="inventory">
                            :
                        </td>                        
                        <td style="text-align: left" class="span4 inventory">
                            <u><b>' . $saldo . '</b></u>
                        </td>';
                        } else {
                            echo'<td style="text-align: left" class="span2 inventory">
                            
                        </td>
                        <td style="text-align: left;width:1px" class="inventory">
                            
                        </td>                        
                        <td style="text-align: left" class="span4 inventory">
                    
                        </td>';
                        }
                        ?>

    </tr>  
    <?php if ($accessDonation) {
        $user =User::model()->findByPk($model->id);
        $coin = json_decode($user->others,true);
        ?>
        <tr class="inventory">
            <td style="text-align: left" class="span4">
                <b>Kolom Coin Emas</b>
            </td>
            <td style="text-align: left;width:1px">
                :
            </td>
            <td style="text-align: left" class="span4">
                <?php echo landa()->rp($coin['mlm_gold_slot']) ?>
            </td>
            <td style="text-align: left" class="span4 inventory">
                <b>Coin Silver</b>
            </td>
            <td style="text-align: left;width:1px" class="inventory">
                :
            </td>                        
            <td style="text-align: left" class="span4 inventory">
        <?php echo landa()->rp($coin['mlm_silver']) ?>
    </td>

    </tr>  
<?php } ?>

<tr class="inventory">
    <td style="text-align: left" class="span2" colspan="6">
<?php echo '<i>"' . $model->description . '"</i>'; ?>
    </td>


</tr>                     
</table>                                           
</td>

</tr>


</table>

<style type="text/css" media="print">
    body {visibility:hidden;}
    .printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
    function printDiv()
    {

        window.print();

    }
</script>
