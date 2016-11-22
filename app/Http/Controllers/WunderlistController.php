<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Wunderlist;

class WunderlistController extends Controller
{
    public function add(Request $request)
    {
        $user_id     = $request->json('user_id');
        $item        = $request->json('item');
        $wunderlist  = new Wunderlist();
        $wunderlist  = $wunderlist->where('user_id', $user_id)->first();
        $accessToken = $wunderlist->accessToken;

        ob_start();
        $out = fopen('php://output', 'w');

        $arr        = array(
            "list_id" => 268310833,
            "title" => $item
        );
        $arrEncoded = json_encode($arr);
        $ch         = curl_init('http://a.wunderlist.com/api/v1/tasks');
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_STDERR, $out);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arrEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Access-Token: $accessToken",
            'X-Client-ID: c921829faacc8abe5ce3',
            'Content-Type: application/json',
            'Content-Length: ' . strlen($arrEncoded)
        ));

        $result = curl_exec($ch);
        echo $result;

        fclose($out);
        $debug = ob_get_clean();
        echo $debug;
    }
}
