<?php

class Display_Controller_Browser extends Core_Controller_BaseController
{
    public function index()
    {
        $pages_model = new Pages_Model_Page();
        $admin = new Admin_Controller_Admin();

        if (isset($_SESSION['user']) && $_SESSION['user']['id'] > 0) {
            $this->data->admin = $_SESSION['user']['id'];
            $admin_html = $admin->index();
        } else {
            $this->data->admin = false;
            $admin_html = $admin->noadmin();
        }

        $this->data->pages = $pages_model->getAll();
        $body_html = $this->render();

        $final_html = Core_View_ViewDriver::replaceShivs($admin_html, $body_html);
        return $final_html;
    }
}