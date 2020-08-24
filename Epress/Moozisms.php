<?php
/**
 * User: hymenoby
 * Date: 05/08/2017
 * Time: 18:33
 */

final class Moozisms
{
    CONST API_URL = "http://api.moozisms.com/";
    private $api_key;
    private $api_secret;
    private $datatype;

    /**
     * Moozisms constructor.
     * @param $api_key
     * @param $api_secret
     */
    public function __construct($api_key, $api_secret)
    {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->datatype = "json";
    }

    public function sendSMS($from, $to, $text, $mt=false){

        $data = array(
            "mt" => $mt ? $mt : 0, // message type 
            "api_key" => $this->api_key,
            "api_secret" => $this->api_secret,
            "to" => $to,    // destination number with country code without OO or+
            "from" => $from, // your startup or company name (max 11 characters)
            "text" => $text,
            "datatype"=> $this->datatype // can replace json with xml to get xml reponse
        );

        $str_data = json_encode($data);

        $request = curl_init($this::API_URL);
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        curl_setopt($request, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_POSTFIELDS,$str_data);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($request);

        curl_close($request);

        $result = json_decode($result);

        return $result;

    }
}