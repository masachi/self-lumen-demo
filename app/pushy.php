<?php
/**
 * Created by PhpStorm.
 * User: Masachi
 * Date: 2017/6/20
 * Time: 下午12:38
 */
namespace App;

class PushyAPI {
    static public function sendPushNotification($data, $tokens, $options) {
        // Insert your Secret API Key here
        $apiKey = 'be6bd0cabb52bb1cf26cb2b60c55a4eea3f8a381ffafc9e6b5ed7393afd796b9';

        // Default post data to provided options or empty array
        $post = $options ?: array();

        // Set notification payload and recipient devices
        $post['data'] = $data;
        $post['tokens'] = $tokens;

        // Set Content-Type header since we're sending JSON
        $headers = array(
            'Content-Type: application/json'
        );

        // Initialize curl handle
        $ch = curl_init();

        // Set URL to Pushy endpoint
        curl_setopt($ch, CURLOPT_URL, 'https://api.pushy.me/push?api_key=' . $apiKey);

        // Set request method to POST
        curl_setopt($ch, CURLOPT_POST, true);

        // Set our custom headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Get the response back as string instead of printing it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set post data as JSON
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post, JSON_UNESCAPED_UNICODE));

        // Actually send the push
        $result = curl_exec($ch);

        // Display errors
        if (curl_errno($ch)) {
            echo curl_error($ch);
        }

        // Close curl handle
        curl_close($ch);

        // Debug API response
        //echo $result;
    }
}