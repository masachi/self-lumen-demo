<?php
/**
 * Created by PhpStorm.
 * User: masachi
 * Date: 2017/7/11
 * Time: 下午2:08
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;

class CalendarController extends Controller{
    function getExamDate(){
        $number = $_POST['username'];
        $date = $_POST['date'];
        $result = array(
            'code' => 200,
            'message' => 'success',
        );
        $sql = "select * from exam where number = {$number} and date = '{$date}'";
        $data = DB::select($sql);
//        $i = 0;
//        while($row = mysql_fetch_row($data)){
//            $result['data'][$i] = array(
//                'id' => urlencode($row[0]),
//                'date' => urlencode ($row[2]),
//                'course' => urlencode ($row[3]),
//                'time' => urlencode ($row[4]),
//                'location' => urlencode ($row[5]),
//                'type' => urlencode ($row[6])
//            );
//            $i++;
//        }
        return array_merge($result, array('data' => $data));
    }

    function getAllDate(){
        $number = $_POST['username'];
        $result = array(
            'code' => 200,
            'message' => 'success',
        );
        $sql = "select date from exam where number = {$number}";
        $data = DB::select($sql);
        return array_merge($result, array('data' => $data));
    }
}