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
            if(Users_UserHelper::checkAuth()) {
                return call_user_func_array(array($this, $method), $arguments);
            } else {
                header("Location: /");
                return $this->renderString("Your session expired: relog");
            }
        }
    }

    /**
     * This function is to extend the functionality of the base renderer, but wraps the auth HTML
     * @param string $calling_function to be used if from other instantiated controller
     * @return mixed|string
     */
    public function render($calling_function = null)
    {
        $body_html = parent::render($calling_function);
        $admin = new Admin_Controller_Admin();
        $admin_html = $admin->index();
        $final_html = Core_View_ViewDriver::replaceShivs($admin_html, $body_html);
        return $final_html;
    }
}