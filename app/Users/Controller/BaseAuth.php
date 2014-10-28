<?php

//ToDo: More generalized way of extending frame based controllers?
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
        $admin_wrapped_html = Core_View_ViewDriver::insertBodyContent($admin_html, $body_html);
        $final_html = Core_View_ViewDriver::insertScripts($body_html, $admin_wrapped_html);
        //$final_html = Core_View_ViewDriver::insertAny($admin_html, $body_html);
        return $final_html;
    }
}