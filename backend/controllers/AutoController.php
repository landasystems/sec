<?php

class AutoController extends Controller {

//    public $layout = 'none';

    public function actionEmailSend() {
        $mEmail = Email::model()->findAll(array('condition' => 'is_send=0', 'limit' => '4'));
        foreach ($mEmail as $o) {
            Email::model()->sending($o->email_to, $o->client, $o->email_from, $o->title, $o->content);
            $o->is_send = 1;
            $o->save();
        }
    }

    public function actionSmsInbox() {
//        $listSiteConfig = SiteConfig::model()->listSiteConfig();
//        $context = stream_context_create(array('http' => array('timeout' => 20)));
//        $konten = file_get_contents('http://36.74.74.146/sms/rio/getInboxSentItems', false, $context);
//        echo $konten ;

        $listSiteConfig = SiteConfig::model()->listSiteConfig();

        $context = stream_context_create(array('http' => array('timeout' => 20, 'header' => "User-Agent:MyAgent/1.0\r\n")));
        $konten = @file_get_contents('http://' . $listSiteConfig['sms_ip'] . '/sms/' . param('client') . '/getInboxSentItems.php', false, $context);
        $decode = (json_decode($konten));
            echo 'http://' . $listSiteConfig['sms_ip'] . '/sms/' . param('client') . '/getInboxSentItems.php';
//        print_r ($decode);
        if ($konten) {
            //change status to is sent
            foreach ($decode->sentitems as $value) {
                $mSmsDetail = SmsDetail::model()->findByPk($value->CreatorID);
                if (!empty($mSmsDetail)) {
                    $mSmsDetail->status = $value->Status;
                    $mSmsDetail->save();
                }
            }

            //insert to inbox
            foreach ($decode->inbox as $value) {
                $number = str_replace('+62', '', $value->SenderNumber);
                $text = $value->TextDecoded;
                $date = $value->ReceivingDateTime;
                Sms::model()->insertMsgNumber('', $number, $text, TRUE, $date);

                //check autoreply && keyword
                SmsKeyword::model()->check($text, $number);
            }
        } else {
            //failed to get konten
            echo 'http://' . $listSiteConfig['sms_ip'] . '/sms/' . param('client') . '/getInboxSentItems.php';
        }
    }

    public function actionSmsSend() {
        $message = SmsDetail::model()->findAll(array('condition' => 'is_process=0'));
        $data = array();
        foreach ($message as $value) {
            if ($value->Sms->type == 'group' || $value->Sms->type == 'mass') {
                $phones = json_decode($value->Sms->type_phones, true);
                foreach ($phones as $phone) {
                    $data[] = array('DestinationNumber' => '+62' . $phone, 'CreatorID' => $value->created_user_id, 'TextDecoded' => $value->message, 'SenderID' => "NULL");
                }
            } else {
                $data[] = array('DestinationNumber' => '+62' . $value->Sms->phone, 'CreatorID' => $value->id, 'TextDecoded' => $value->message, 'SenderID' => "NULL");
//                $data[] = array('DestinationNumber' => '+62' . $value->Sms->phone, 'CreatorID' => $value->id, 'TextDecoded' => $value->message);
            }
            $value->is_process = 1;
            $value->save();
        }

        $encode = json_encode($data);
        echo $encode;
    }

    public function actionSmsInfo() {
        $listSiteConfig = SiteConfig::model()->listSiteConfig();
        $port = ($listSiteConfig['sms_port'] == 0) ? '' : $listSiteConfig['sms_port'];
        $context = stream_context_create(array('http' => array('timeout' => 20)));
        $konten = @file_get_contents('http://' . $listSiteConfig['sms_ip'] . '/pulsa' . $port, false, $context);
//        echo $konten;
//        $konten = @file_get_contents('http://118.97.129.189/pulsa' . $port, false, $context);
//        echo 'http://' . $listSiteConfig['sms_ip'] . '/pulsa' . $port;
//        $status = 'success';
//        $amount = '';
//        $period_active = '';
//        $period_grace = '';
        $time_check = '';

        $mSmsInfo = new SmsInfo();
        if ($konten == false) {
            $mSmsInfo->content = 'Modem Server not Connected';
        } else {
            $arr = explode('"', $konten);
            $mSmsInfo->provider = $arr[1];
            $mSmsInfo->phone = $arr[3];
            $mSmsInfo->time_check = $arr[5];
            if (isset($arr[9])){
                $mSmsInfo->content = $arr[7] . ' | ' . $arr[9];
            }else{
                $mSmsInfo->content = $arr[7];
            }
//            print_r($arr);
        }
        $mSmsInfo->save();

//        if ($konten == false) {
//            $status = 'Modem Server not Connected';
//        } else {
//            $time_check = substr($konten, strpos($konten, "update:") + 7, 28);
//            if (strpos($konten, "Probably phone not connected") > 0) {
//                $status = "Phone not connected";
//            } else {
//                $amount = substr($konten, strpos($konten, "Rp.") + 3, strpos($konten, ".", strpos($konten, ".") + 1) - strpos($konten, "Rp.") - 3);
//                if ($listSiteConfig['sms_provider'] == 'indosat') {
//                    $period_active = substr($konten, strpos($konten, "Aktif") + 6, 8);
//                    $period_grace = substr($konten, strpos($konten, "Tenggang") + 9, 8);
//                } else if ($listSiteConfig['sms_provider'] == 'telkomsel') {
////                    $cellular_aktif = substr($konten, strpos($konten, "s.d.") + 5, 10);
//                }
//            }
//        }
//        $newDate = explode('/', $period_grace);
//        $period_grace = $newDate[1] . '/' . $newDate[0] . '/20' . $newDate[2];
//        $newDate = explode('/', $period_active);
//        $period_active = $newDate[1] . '/' . $newDate[0] . '/20' . $newDate[2];
        //------------------------------------------------------------------
//        $mSmsInfo = new SmsInfo();
//        $mSmsInfo->status = $status;
//        $mSmsInfo->amount = $amount;
//        $mSmsInfo->period_grace = date("Y-m-d H:i:s", strtotime($period_grace));
//        $mSmsInfo->period_active = date("Y-m-d H:i:s", strtotime($period_active));
//        $mSmsInfo->time_check = date("Y-m-d H:i:s", strtotime($time_check));
//        $mSmsInfo->save();
//        echo $konten . '<br/><hr>';
//        echo 'status=' . $status . '<br/>';
//        echo 'amount=' . $amount . '<br/>';
//        echo 'period_grace=' . date("Y-m-d H:i:s", strtotime($period_grace)) . '<br/>';
//        echo 'period_active=' . date("Y-m-d H:i:s", strtotime($period_active)) . '<br/>';
//        echo 'time_check=' . date("Y-m-d H:i:s", strtotime($time_check)) . '<br/>';
    }
    
    public function actionMltTerm(){
        //hanya user pasca bayar, jika ada saldo credit
        $user = User::model()->findAll(array('condition'=>'roles_id=27')); 
        foreach ($user as $val){
            $others = json_decode($val->others);
            if (isset($others->saldo_credit) && $others->saldo_credit > 0){
                $val->enabled = 0;
                $val->save();
            }
                
        }
    }
}
