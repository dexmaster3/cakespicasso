<?php

class Admin_Controller_Admin extends Core_Controller_BaseController
{
    public function layouts($query)
    {
        $layouts = new Layouts_Controller_Layout();
        //todo grab html insert for the admin pages here, then pass to the return controller
        $html = $this->render();//this should give back html strings?
        return $layouts->index();
    }
    public function blank($query)
    {
        return $this->render();
    }
    public function dropandseedeverything()
    {
        $dbseeder = new DB_Model_Seed();
        $dbseeder->initializeDatabase(true);
    }
}