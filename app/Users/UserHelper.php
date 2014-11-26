<?php

class Users_UserHelper
{
    static public function checkAuth()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check the password of the provided user object
     * @param $current_user
     * @param $password
     * @return bool password correct or not
     */
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

    /**
     * Create and get a new password for registering users
     * @param $new_password
     * @return array Salt and Password
     */
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
    static public function isObjectOwner($object_author_id)
    {
        $user_id = $_SESSION['user']['id'];
        if ($user_id === $object_author_id) {
            return true;
        } else {
            return false;
        }
    }
    //ToDo: find better recursion method of building note comment tree (view my site?)
    static public function noteHasChildren($parent_note)
    {
        $note_model = new Users_Model_Note();
        $return_notes = array();
        $note_children = $note_model->findAllByColumnValue('parent_note', $parent_note['id']);
        foreach ($note_children as $note_item) {

        }
    }
}