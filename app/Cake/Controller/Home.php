<?php

class Cake_Controller_Home extends Core_Controller_BaseController
{
    public function index($query)
    {
        //Todo: PDO data fetching here?
        if (strtolower($query['user']) === "french") {
            $this->data->London = 'Paris';
            $this->data->United = "DIVIDED";
        }
        else {
            $data = array(
                'London' => "United States",
                'Kingdom' => "STATES"
            );
        }
        if (isset($query['city'])) {
            $this->data->city = $query['city'];
        }
        return $this->render($this->data);
    }
    public function stuff($query)
    {
        //Todo: PDO data fetching here?
        if (strtolower($query['user']) === "french") {
            $data = array(
                'London' => 'CAKES',
                'United' => 'PICASSO'
            );
        }
        else {
            $data = array(
                'London' => "AMERICAN",
                'Kingdom' => "AMERICA"
            );
        }
        return $this->render($data);
    }
}