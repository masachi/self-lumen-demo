<?php
/**
 * Created by PhpStorm.
 * User: masachi
 * Date: 2017/7/11
 * Time: 下午1:58
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;

class NotificationController extends Controller{
    function getNotification(Request $request){
        $sql = "select * from notification ORDER BY id DESC LIMIT 10";
        $result = array (
            'code' => 200,
            'message' => 'success',
        );
        $data = DB::select($sql);
//        $i = 0;
//        while($row = mysql_fetch_row($data)){
//            $result['data'][$i] = array(
//                'title' => urlencode ($row[1]),
//                'url' => urlencode ($row[2]),
//                'date' => urlencode ($row[3])
//            );
//        }
        return array_merge($result, array('data' => $data));
    }
}