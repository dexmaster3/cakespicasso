<?php

class Display_Controller_Browser extends Core_Controller_BaseController
{
    public function index()
    {
        $pages_model = new Pages_Model_Page();
        $admin = new Admin_Controller_Admin();

        $this->data->pages = $pages_model->getAll();
        $body_html = $this->render();

        if (isset($_SESSION['user'])) {
            $admin_html = $admin->index();
        } else {
            $admin_html = $admin->noadmin();
        }

        $final_html = Core_View_ViewDriver::replaceShivs($admin_html, $body_html);
        return $final_html;
    }
}