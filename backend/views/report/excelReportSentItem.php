
<table class="table table-bordered">
    <thead>
        <tr>            
            <th colspan="4"><h2>Sent Item Report</h2><br><?php echo date('d F Y', strtotime($start)) . " - " . $end = date('d F Y', strtotime($end)); ?></th>
            

        </tr>
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
        foreach ($model as $o) {
            $no++;
            $phone = (isset($o->Sms->phone)) ? $o->Sms->phone : '-';
            $listUserPhone = User::model()->listUserPhone();
            if (array_key_exists($phone, $listUserPhone))
                $sResult = '' . ucwords($listUserPhone[$phone]['name']) . '(' . landa()->hp($phone) . ')';
            else
                $sResult = '' . landa()->hp($o->Sms->phone) . '';
            echo'
               <tr>
               <td>' . $no . '</td>
               <td style="width:160px;">' . $sResult . '</td>
               <td>' . $o->message . '</td>
               <td style="width:120px;">' . date('d F Y', strtotime($o->created)) . '</td>
                                  <td>' . SmsDetail::model()->labelStatus($o->status) . '</td>

               </tr>';

        }
        ?>

    </tbody>

</table>
