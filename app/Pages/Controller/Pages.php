<?php

class Pages_Controller_Pages extends Users_Controller_BaseAuth
{
    protected function index()
    {
        if (Core_Request::getRequest()->method === "POST") {
            $pages = new Pages_Model_Pages();
            $routes = new DB_Model_CustomRoutes();
            $_POST['page_html'] = htmlentities($_POST['page_html']);
            if (!$_POST['id'] > 0) {
                $page_id = $pages->addRow($_POST);
                $routes->addRow(array(
                    'url' => $_POST['page_url'],
                    'module' => 'Pages',
                    'controller' => 'Pages',
                    'action' => 'show',
                    'remote_id' => $page_id
                ));
            } else {
                $pages->updateById($_POST['id'], $_POST);
                $routes->updateById($_POST['id'], array(
                    'url' => $_POST['page_url'],
                    'module' => 'Pages',
                    'controller' => 'Pages',
                    'action' => 'show',
                    'remote_id' => $_POST['id']
                ));
            }
            $this->data->pages = $pages->getAll();
            return $this->render();
        } else {
            $pages = new Pages_Model_Pages();
            $this->data->pages = $pages->getAll();
            return $this->render();
        }
    }

    protected function show($params)
    {
        $pages = new Pages_Model_Pages();
        $this->data->page = $pages->findById($params['id']);
        return $this->renderString($this->data->page['page_html']);
    }

    protected function create()
    {
        return $this->render();
    }

    protected function edit($params)
    {
        $pages = new Pages_Model_Pages();
        $this->data->page = $pages->findById($params['id']);
        return $this->render();
    }

    protected function delete($params)
    {
        $pages = new Pages_Model_Pages();
        $pages->deleteById($params['id']);
        $cust_routes = new DB_Model_CustomRoutes();
        $cust_routes->deleteAllByColumnValue('remote_id', $params['id']);
        return $this->index();
    }
}