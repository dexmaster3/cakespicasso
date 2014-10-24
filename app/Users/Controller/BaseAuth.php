<?php

class Users_Controller_BaseAuth extends Core_Controller_BaseController
{
    /**
     * Magic function to check auth before any function call, in controllers that inherit this
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            Users_UserHelper::checkAuth();
            return call_user_func_array(array($this, $method), $arguments);
        }
    }

    /**
     * This function is to extend the functionality of the base renderer, but wrapps the auth HTML
     * @return mixed|string
     */
    public function render()
    {
        $body_html = parent::render();
        $admin = new Admin_Controller_Admin();
        $admin_html = $admin->index();
        $admin_wrapped_html = Admin_AdminHelper::insertBodyContent($admin_html, $body_html);
        return $admin_wrapped_html;
    }
}