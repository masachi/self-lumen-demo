<?php
/**
 * Created by PhpStorm.
 * User: masachi
 * Date: 2017/7/11
 * Time: 下午2:53
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;
use App\PushyAPI;

class CourseController extends Controller{
    function getCourseList(){
        $number = $_POST['username'];
        $date = $_POST['date'];
        $result = array(
            'code' => 200,
            'message' => 'success',
        );
        $sql = "select * from course where number = {$number} AND date = '{$date}'";
        $data = DB::select($sql);
//        $i = 0;
//        while($row = mysql_fetch_row($data)){
//            $result['data'][$i] = array(
//                'id' => urlencode($row[0]),
//                'number' => urlencode ($row[1]),
//                'date' => urlencode ($row[2]),
//                'num' => urlencode ($row[3]),
//                'course' => urlencode ($row[6]),
//                'teacher' => urlencode ($row[7]),
//                'location' => urlencode ($row[8]),
//                'comments' => urlencode ($row[9]),
//                'timeoff' => urlencode ($row[10])
//            );
//            $i++;
//        }

        return array_merge($result, array('data' => $data));
    }

    function getCourseInfo(){
        $number = $_POST['username'];
        $course = json_decode('"'.$_POST['course'].'"');
        $result = array(
            'code' => 200,
            'message' => 'success',
        );
        mysql_query("SET names UTF8");
        $sql = "select * from course_info where number = {$number} AND course = '{$course}'";
        $data = DB::select($sql);
//        $i = 0;
//        while($row = mysql_fetch_row($data)){
//            $result['data'][$i] = array(
//                'id' => urlencode($row[0]),
//                'number' => urlencode ($row[1]),
//                'course' => urlencode ($row[2]),
//                'weight' => urlencode ($row[3]),
//                'week' => urlencode ($row[4]),
//                'info' => urlencode ($row[5])
//            );
//            $i++;
//        }
        return array_merge($result, array('data' => $data));
    }

    function updateComments(){
        $number = $_POST['username'];
        $course = json_decode('"'.$_POST['course'].'"');
        $date = $_POST['date'];
        $comments = json_decode('"'.$_POST['comments'].'"');
        mysql_query("SET names UTF8");
        $sql = "update course set comments = '{$comments}', timeoff = 1 where number = {$number} and course = '{$course}' and date = '{$date}';";
        $result = DB::update($sql);
        if($result > 0){
            $result = array(
                'code' => 200,
                'message' => 'success',
            );
        }
        else{
            $result = array(
                'code' => 500,
                'message' => 'fail',
            );
        }
        return $result;
    }

    function push(){
        $number = $_POST['username'];
//        $message = $_POST['message'];
        // Payload data you want to send to devices
        $data = array('message' => 'test');
        $sql = "select token from device where number = {$number};";
        $date = DB::select($sql);
        $token = '';
//        foreach ($date as $row){
//            $token = $row[2];
//        }
// The recipient device tokens
        $deviceTokens = array($date);
// Optional push notification options (such as iOS notification fields)
//        $options = array(
//            'notification' => array(
//                'badge' => 1,
//                'sound' => 'ping.aiff',
//                'body'  => "Hello World \xE2\x9C\x8C"
//            )
//        );
        $options = array();
// Send it with Pushy
        PushyAPI::sendPushNotification($data, $deviceTokens, $options);
    }

}