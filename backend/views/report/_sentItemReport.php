<?php
$a = explode('-', $last_date);
$start = date('d M Y', strtotime($a[0]));
$end = date('d M Y', strtotime($a[1]));
?>

<table width="100%">
    <tr>
        <td  style="text-align: center" colspan="3"><h2>Sent Item Report</h2>
            <?php echo date('d/m/Y', strtotime($a[0])) . " - " . $end = date('d/m/Y', strtotime($a[1])); ?>
            <hr></td>
    </tr>   
</table>
<a class="btn" href="<?php echo Yii::app()->controller->createUrl('report/GenerateExcelSentItem?last_date='.str_replace(" ", "" ,$last_date)) ?>">
    <i class="entypo-icon-list"></i>Export to Excel</a>
<a href="#myModal" role="button" class="btn" data-toggle="modal"><i class=" cut-icon-printer-2"></i>Print this report</a>
<hr>

<table class="table table-bordered">
    <thead>
        <tr>            
            <th>No</th>
            <th>To</th>
            <th>Message</th>
            <th>Sent Date</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($smsdet as $o) {
            $no++;
            $phone = (isset($o->Sms->phone)) ? $o->Sms->phone : '-';
            $listUserPhone = User::model()->listUserPhone();
            if (array_key_exists($phone, $listUserPhone))
                $sResult = '-> ' . ucwords($listUserPhone[$phone]['name']) . '(' . landa()->hp($phone) . ')';
            else
                $sResult = '-> ' . landa()->hp($o->Sms->phone) . '';

//            $phone = (isset($o->Sms->phone)) ? landa()->hp($o->Sms->phone) : '-';
//            C$smsDet = SmsDetail::model()->findAll(array('condition' => 'date_received=' . $o->last_date));
//            foreach ($smsDet as $a) {
            echo'
               <tr>
               <td>' . $no . '</td>
               <td style="width:160px;">' . $sResult . '</td>
               <td>' . $o->message . '</td>
               <td style="width:140px;">' . date('d F Y H:i', strtotime($o->created)) . '</td>
               <td>' . SmsDetail::model()->labelStatus($o->status) . '</td>
               </tr>';
//            }
        }
        ?>

    </tbody>

</table>



<div id="myModal" style="width:700px;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <div class='printableArea'>
            <table class="table table-bordered">
                <thead>
                    <tr>            
                        <th >No</th>
                        <th >To</th>
                        <th >Message</th>
                        <th >Sent Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    foreach ($smsdet as $o) {
                        $no++;
                        $phone = (isset($o->Sms->phone)) ? $o->Sms->phone : '-';
                        $listUserPhone = User::model()->listUserPhone();
                        if (array_key_exists($phone, $listUserPhone))
                            $sResult = '-> ' . ucwords($listUserPhone[$phone]['name']) . '(' . landa()->hp($phone) . ')';
                        else
                            $sResult = '-> ' . landa()->hp($o->Sms->phone) . '';

//            $phone = (isset($o->Sms->phone)) ? landa()->hp($o->Sms->phone) : '-';
//            C$smsDet = SmsDetail::model()->findAll(array('condition' => 'date_received=' . $o->last_date));
//            foreach ($smsDet as $a) {
                        echo'
               <tr>
               <td>' . $no . '</td>
               <td style="width:160px;">' . $sResult . '</td>
               <td>' . $o->message . '</td>
               <td style="width:120px;">' . date('d F Y', strtotime($o->date_received)) . '</td>
               </tr>';
//            }
                    }
                    ?>

                </tbody>

            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button onclick="js:printDiv();
            return false;" class="btn btn-primary">Print</button>
    </div>
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

