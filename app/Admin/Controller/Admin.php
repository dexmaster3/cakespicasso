<?php

class Admin_Controller_Admin extends Core_Controller_BaseController
{
    public function layouts($query)
    {
        $sub_action = $query['action'];
        $layouts = new Layouts_Controller_Layout();
        $layouts_html = $layouts->$sub_action($query);
        $admin_frame_html = $this->render();
        return Admin_AdminHelper::insertBodyContent($admin_frame_html, $layouts_html);
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