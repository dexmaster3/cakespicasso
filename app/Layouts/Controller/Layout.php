<?php

class Layouts_Controller_Layout extends Core_Controller_BaseController
{
    public function index($query)
    {
        if (Core_Request::getRequest()->method === "POST") {
            $layouts = new Layouts_Model_Layout();
            $_POST['layout_content'] = htmlentities($_POST['layout_content']);
            if (!$_POST['id'] > 0) {
                $layouts->addRow($_POST);
            } else{
                $layouts->updateById($_POST['id'], $_POST);
            }
            $this->data->layouts = $layouts->getAll();
            return $this->render();
        } else {
            $layouts = new Layouts_Model_Layout();
            $this->data->layouts = $layouts->getAll();
            return $this->render();
        }
    }
    public function edit($params)
    {
        $layout = new Layouts_Model_Layout();
        $this->data->page = $layout->findById($params['id']);
        return $this->render();
    }
    public function create($query)
    {
        return $this->render();
    }
    public function blank($query)
    {
        return $this->render();
    }
    public function dropandseedeverything()
    {
        $dbseeder = new Core_DatabaseSeeder();
        $dbseeder->seedDatabase();
    }
}