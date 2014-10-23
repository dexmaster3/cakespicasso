<?php

class Admin_Controller_Admin extends Core_Controller_BaseController
{
    public function index($query = null)
    {
        if(Users_UserHelper::checkAuth()) {
            return $this->render(__FUNCTION__);
        } else {
            return "Login Authentication Error";
        }
    }
}