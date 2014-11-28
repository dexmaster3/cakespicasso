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

    //These were used for recursive notes -- not needed for comment system now
    static public function getNoteChildren($all_notes, $parent_id = 0)
    {
        $final_tree = array();
        foreach ($all_notes as $note) {
            if ($note['parent_note'] == $parent_id) {
                $children = self::getNoteChildren($all_notes, $note['id']);
                if ($children) {
                    $note['children'] = $children;
                }
                $final_tree[] = $note;
            }
        }
        return $final_tree;
    }

    static public function displayNoteChildren($all_notes, $level = 0)
    {
        foreach ($all_notes as $key => $val) {
            if(is_array($val)) {
                echo "<ul>";
                self::displayNoteChildren($val);
                echo "</ul>";
            } else {
                echo "<li>$key ==== $val</li>";
            }
        }
    }
}