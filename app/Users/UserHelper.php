<?php

class Users_UserHelper
{
    static public function checkAuth()
    {
        session_start();
        if(isset($_SESSION['user'])) {
            return $_SESSION['user']['username'];
        } else {
            return false;
        }
    }
}