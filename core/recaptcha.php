<?php

class recaptcha {
    private $secret = "6LeudFAtAAAAAJ8-gVHyYLV1mBTrUrDyBZragxa4";

    function verify($token) {
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $data = [
            "secret"   => $this->secret,
            "response" => $token
        ];

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);


        if ($result === false) {
            return false;
        }

        $response = json_decode($result);

        return $response->success ?? false;
    }
}