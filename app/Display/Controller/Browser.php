<?php

class Display_Controller_Browser extends Core_Controller_BaseController
{
    public function index()
    {
        $pages_model = new Pages_Model_Page();
        $this->data->pages = $pages_model->getAll();
        return $this->render();
    }
}