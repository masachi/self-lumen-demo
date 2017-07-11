<?php
/**
 * Created by PhpStorm.
 * User: masachi
 * Date: 2017/7/11
 * Time: 上午11:28
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;

class UserController extends Controller{
    function addTimeOff(){
        $number = $_POST['username'];
        $date = $_POST['date'];
        $course = json_decode('"'.$_POST['course'].'"');
        $type = json_decode('"'.$_POST['type'].'"');
        $timeoff = json_decode('"'.$_POST['timeoff'].'"');
        mysql_query("SET names UTF8");
        $sql = "insert into timeoff (number, date, course, type, text) values ('{$number}', '{$date}', '{$course}', '{$type}', '{$timeoff}');";
        $sql2 = "update course set timeoff = 1 where number = {$number} and course = '{$course}' and date = '{$date}';";
        $result = DB::insert($sql);
        $result2 = DB::update($sql2);
        if($result > 0 && $result2 > 0){
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

    function insertDevice(){
        $number = $_POST['username'];
        $deviceToken = $_POST['token'];

        $sql = "select * from device where number = {$number};";
        $results = DB::select($sql);
        //echo mysql_num_rows($data);
        if(mysql_num_rows($results) > 0){
            $sql1 = "update device set token = '{$deviceToken}' where number = {$number};";
        }
        else{
            $sql1 = "insert into device (number, token) values ({$number}, '{$deviceToken}')";
        }
        $result = DB::update($sql1);
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

    function getProfile(){
        $number = $_POST['username'];

        $result = array(
            'code' => 200,
            'message' => 'success',
        );
        $sql = "select * from profile where number = {$number}";
        $results = DB::select($sql);

        //$result[data] = $results;

        return array_merge($result, array('data' => $results));
    }
}