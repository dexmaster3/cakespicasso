<?php

class Cake_Controller_Home extends Core_Controller_BaseController
{
    public function index($query)
    {
        if (strtolower($query['user']) === "french") {
            $data = array(
                'London' => 'PARIS',
                'United' => 'DIVIDED'
            );
        }
        else {
            $data = array(
                'London' => "United States",
                'Kingdom' => "STATES"
            );
        }
        return $this->render($data);
    }
}