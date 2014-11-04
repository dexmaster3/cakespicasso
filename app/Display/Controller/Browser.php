<?php

class Display_Controller_Browser extends Core_Controller_BaseController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            $pages_model = new Pages_Model_Page();
            $this->data->pages = $pages_model->getAll();
            $body_html = $this->render();
            $admin = new Admin_Controller_Admin();
            $admin_html = $admin->index();
            $final_html = Core_View_ViewDriver::replaceShivs($admin_html, $body_html);
            return $final_html;
        } else {
            $pages_model = new Pages_Model_Page();
            $this->data->pages = $pages_model->getAll();
            $body_html = $this->render();
            $admin = new Admin_Controller_Admin();
            $admin_html = $admin->noadmin();
            $final_html = Core_View_ViewDriver::replaceShivs($admin_html, $body_html);
            return $final_html;
        }
    }
}