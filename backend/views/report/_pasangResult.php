<div class="printableArea">
    <div class="row-fluid">
        <div class="span6">Date : <b><?php echo date('d F Y', strtotime($mPlay->created)) ?></b></div>
        <div class="span6">
            Output : <b><?php echo ($mPlay->output == 's') ? 'Singapore ' : 'Hongkong'; ?></b>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>            
                <th>No</th>
                <th>Angka</th>
                <th>Pasang</th>
                <th>Type</th>
                <th>Status</th>
                <th>Keluaran</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            $total = 0;
            $cOutput = (!empty($mPlay->output)) ? ' AND output="' . $mPlay->output . '"' : '';
            $cType = (!empty($mPlay->type)) ? ' AND type="' . $mPlay->type . '"' : '';
            $date = date('Y-m-d', strtotime($mPlay->created));
            $play = Play::model()->findAll(array('select' => 'number,output,type, sum(amount) as sum_amount,status,play_result_id', 'group' => 'number,output,type,status,play_result_id', 'condition' => 'date(created)="' . $date . '"' . $cOutput . $cType, 'order' => 'type, sum_amount DESC'));

            $group = '';
            foreach ($play as $o) {
                $no++;
//            $name = (isset($o->User->fullContact)) ? $o->User->fullContact :'';
                $playresult = (isset($o->PlayResult->number)) ? $o->PlayResult->number : '';

                if ($group != $o->type) {
                    $group = $o->type;
                    echo '<tr style="background-color: beige;"><td colspan="6">Permainan : ' . $group . '</td></tr>';
                }

                echo'<tr>
            <td>' . $no . '</td>    
            <td>' . $o->number . '</td>    
            <td>' . landa()->rp($o->sum_amount) . '</td>    
            <td>' . $o->type . '</td>    
            <td>' . $o->statusUser . '</td>    
            <td>' . $playresult . '</td>    
            </tr>';
                $total += $o->sum_amount;
            }
            echo'<tr>
            <td></td>    
            <td></td>    
            <td></td>    
            <td>' . landa()->rp($total) . '</td>    
            <td></td>    
            <td></td>     
            </tr>';
            ?>
        </tbody>
    </table>
</div>
<style type="text/css" media="print">
    body {visibility:hidden;}
    .printableArea{
        position:absolute;
        top:0;
        left:0;
        visibility:visible;
        -webkit-print-color-adjust: exact; 
    } 
    .table{
        width: 100%;
    }
</style>
<script type="text/javascript">
    function printDiv()
    {

        window.print();

    }
</script>