<?php

class Pages_Controller_Admin extends Core_Controller_BaseController
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
        $dbseeder = new Core_DatabaseSeeder();
        $dbseeder->seedDatabase();
    }
}