<?php

class Analytics_AnalyticsHelper
{
    public static function saveClientInformation()
    {
        $client_ip = $_SERVER['REMOTE_ADDR'];
        $tracker_model = new Analytics_Model_Tracker();
        $trackings = $tracker_model->findAllByColumnValue('query', $client_ip);
        if ($trackings && !empty($trackings)) {
            return false;
        } else {
            $ip_data = file_get_contents("http://ip-api.com/json/$client_ip");
            $client_info = json_decode($ip_data, true);
            $added = $tracker_model->addRow($client_info);
            if ($added) {
                return true;
            } else {
                return false;
            }
        }
    }
}