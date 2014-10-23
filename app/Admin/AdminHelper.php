<?php

class Admin_AdminHelper
{
    static public function insertBodyContent($admin_frame, $body_content)
    {
        return str_replace("{{body_content}}", $body_content, $admin_frame);
    }
}