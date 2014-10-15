<?php

class Seams_Controller_Admin extends Core_Controller_BaseController
{
    public function index($query)
    {
        return $this->render();
    }
    public function blank($query)
    {
        return $this->render();
    }
    public function dropandseedeverything()
    {
        $pages = new Seams_Model_Pages();
        $pages->createTable();
        return "pages table created";
    }
}