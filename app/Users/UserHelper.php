<?php

class Users_UserHelper
{
    static public function checkAuth()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
    static public function checkPassword($current_user, $password)
    {
        $pw_check = hash('sha256', $password . $current_user['salt']);
        for ($test = 0; $test < 999; $test++) {
            $pw_check = hash('sha256', $pw_check . $current_user['salt']);
        }
        if ($pw_check === $current_user['password']) {
            return true;
        } else {
            return false;
        }
    }
    static public function getPassword($new_password)
    {
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $new_password . $salt);
        for ($test = 0; $test < 999; $test++) {
            $password = hash('sha256', $password . $salt);
        }
        return array(
            'salt' => $salt,
            'password' => $password
        );
    }
}