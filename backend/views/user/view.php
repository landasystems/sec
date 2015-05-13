<?php
$this->setPageTitle('Lihat Users | ID : ' . $model->id);
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->name,
);
?>

<?php
$create = "";
$edit = "";
if ($type == "client") {
    $create = landa()->checkAccess('Client', 'c');
    $edit = landa()->checkAccess('Client', 'u');
} elseif ($type == "contact") {
    $create = landa()->checkAccess('Contact', 'c');
    $edit = landa()->checkAccess('Contact', 'u');
} elseif ($type == "customer") {
    $create = landa()->checkAccess('Customer', 'c');
    $edit = landa()->checkAccess('Customer', 'u');
} elseif ($type == "employment") {
    $create = landa()->checkAccess('Employment', 'c');
    $edit = landa()->checkAccess('Employment', 'u');
} elseif ($type == "guest") {
    $create = landa()->checkAccess('Guest', 'c');
    $edit = landa()->checkAccess('Guest', 'u');
} else {
    $create = landa()->checkAccess('User', 'c');
    $edit = landa()->checkAccess('User', 'u');
}

$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('visible'=>$create,'label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create', array('type' => $type)), 'linkOptions' => array()),
        array('label' => 'Daftar', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl($type), 'linkOptions' => array()),
        array('visible'=>$edit,'label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id, 'type' => $type,)), 'linkOptions' => array()),
        //array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
        array('label' => 'Print', 'icon' => 'icon-print', 'url' => 'javascript:void(0);return false', 'linkOptions' => array('onclick' => 'printDiv();return false;')),
        array('visible' => in_array('mlm', param('menu')), 'label' => 'Diagram Jaringan', 'icon' => 'entypo-icon-card', 'url' => url('mlmDiagram/downline', array('id' => $model->id)), 'linkOptions' => array()),
        array('visible' => in_array('mlm', param('menu')), 'label' => 'History Bonus', 'icon' => 'entypo-icon-card', 'url' => url('mlmPrize/det', array('id' => $model->id)), 'linkOptions' => array()),
)));
$this->endWidget();
?>
<div class='printableArea'>

    <?php
//$this->widget('bootstrap.widgets.TbDetailView', array(
//    'data' => $model,
//    'attributes' => array(
//        'id',
//        'username',
//        'email',
//        'password',
//        'user_position_id',
//        'code',
//        'name',
//        'city_id',
//        'address',
//        'phone',
//        'created',
//        'created_user_id',
//        'modified',
//    ),
//));
    ?>
</div>
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
<div class="tab-pane active" id="personal">

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
                                if ($model->roles_id == -1) {
                                    echo 'Super User';
                                } else {
                                    if (empty($model->Roles->name)) {
                                        echo '~~~';
                                    } else {
//                                        echo $model->Roles->name;
                                    }
                                }
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
                    <?php
                    if (in_array('donation', param('menu'))) {
                        $saldo = json_decode($model->others, true);
                        $gold_slot = (isset($saldo['mlm_gold_slot'])) ? $saldo['mlm_gold_slot'] : 0;
                        $silver = (isset($saldo['mlm_silver'])) ? $saldo['mlm_silver'] : 0;
                        $coin_gold_slot = (isset($saldo['mlm_gold_slot'])) ? $saldo['mlm_gold_slot'] / 50000 : '-';
                        $coin_silver = (isset($saldo['mlm_silver'])) ? $saldo['mlm_silver'] / 15000 : '-';
                        echo'<tr class="inventory">
                        <td style="text-align: left" class="span2">
                            <b>Kolom Koin Kosong</b>
                        </td>
                        <td style="text-align: left;width:1px">
                            :
                        </td>
                        <td style="text-align: left" class="span4">
                              ' . landa()->rp($gold_slot) . ' (<b>' . $coin_gold_slot . ' coin</b>)
                        </td>
                        <td style="text-align: left" class="span2 inventory">
                            <b>Koin Perak</b>
                        </td>
                        <td style="text-align: left;width:1px" class="inventory">
                            :
                        </td>                        
                        <td style="text-align: left" class="span4 inventory">
                            ' . landa()->rp($silver) . ' (<b>' . $coin_silver . ' coin</b>)
                        </td>

                    </tr>';
                    }
                    ?>

                    <tr class="inventory">
                        <td style="text-align: left" class="span2" colspan="7">
                            <?php echo '<i>"' . $model->description . '"</i>'; ?>
                        </td>


                    </tr>                     
                </table>                                           
            </td>

        </tr>  


        <tr class="inventory">
            <td style="text-align: left" class="span2" colspan="6">
                <?php echo '<i>"' . $model->description . '"</i>'; ?>
            </td>


        </tr>                     
    </table>                                           
</td>

</tr>


</table>

</div> 
