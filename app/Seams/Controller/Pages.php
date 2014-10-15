<?php

class Seams_Controller_Pages extends Core_Controller_BaseController
{
    public function index()
    {
        $pages = new Seams_Model_Pages();
        $this->data->pages = $pages->getAll();
        return $this->render();
    }
    public function show($params)
    {
        $pages = new Seams_Model_Pages();
        $this->data->page = $pages->findById($params['id']);
        return $this->render($this->data->page['page_html']);
    }
    public function create()
    {
        return $this->render();
    }
    public function createPage($params)
    {
        $pages = new Seams_Model_Pages();
        $routes = new Core_Model_CustomRoutes();
        $page_id = $pages->addRow($params);
        $routes->addRow(array(
            'url' => $params['page_url'],
            'module' => 'Seams',
            'controller' => 'Pages',
            'action' => 'show',
            'remote_id' => $page_id
        ));
        $this->data->pages = $pages->getAll();
        return $this->render();
    }
    //ToDo: get the remote ids set for the routes to find through thier renderer
}