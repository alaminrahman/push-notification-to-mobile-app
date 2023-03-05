<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function test_push_notification()
    {
        $data = [
            'title' => 'test notify',
            'description' => 'test notify',
            'image' => 'test notify',
            'order_id' => 111,
        ];

        $key = 'AAAAvevrrq0:APA91bG4Wv8TvdEmGDKxOkFvqY6-ZOhSLK2Pp42RHjXV87JMVbACtlPloE9TH-ir54-k3ZaNUGvwMuIZU0LXyCPJsdirAmWYSykSCH98wcOPDPlaL5vm9VmxCkZJncSo-pQUeZkseA2K';
        $fcm_token = 'dMlT1qu3Tqm656QGfflvDK:APA91bFaHiiioECRtVyKE7ljUN_McdA7cxDfeAIamJn1n9DxSHkaAWIzqgI91OjRo4WzwlyrZ6bxYzmDKZ7bHuFvaLw8ezPaQS7bjR716CH6COehSNtiLBuBCxGVdZHf0FjlNopHHikL';

        $url = "https://fcm.googleapis.com/fcm/send";        
        $header = array("authorization: key=" . $key . "",        
            "content-type: application/json"
        );

        if (isset($data['order_id']) == false) {
            $data['order_id'] = null;
        }

        $postdata = '{
            "to" : "' . $fcm_token . '",
            "data" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "image" : "' . $data['image'] . '",
                "order_id":"' . $data['order_id'] . '",
                "is_read": 0
              },
              "notification" : {
                "title" :"' . $data['title'] . '",
                "body" : "' . $data['description'] . '",
                "image" : "' . $data['image'] . '",
                "order_id":"' . $data['order_id'] . '",
                "title_loc_key":"' . $data['order_id'] . '",
                "is_read": 0,
                "icon" : "new",
                "sound" : "default"
              }
        }';

        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        curl_close($ch);

        return $result;
    }
    //End
}
