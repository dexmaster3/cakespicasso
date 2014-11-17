<?php

class Pages_Controller_Page extends Users_Controller_BaseAuth
{
    protected function index()
    {
            $pages = new Pages_Model_Page();
            $this->data->pages = $pages->findAllByColumnValue('author_id', $_SESSION['user']['id']);
            return $this->render();
    }

    protected function save($query = null)
    {
        $post = Core_Request::getRequest()->post;
        $pages = new Pages_Model_Page();
        $routes = new DB_Model_CustomRoutes();
        $save_data = new stdClass();

        //This should update or add
        $post['author_id'] = $_SESSION['user']['id'];
        $page_id = $pages->addRow($post);
        if ($page_id > 0) {
            $found_route = $routes->findAllByColumnValue('remote_id', $page_id);
            if (empty($found_route)) {
                $found_route[0]['id'] = null;
            }
            $route_id = $routes->addRow(array(
                'id' => $found_route[0]['id'],
                'url' => $post['page_url'],
                'module' => 'Display',
                'controller' => 'Display',
                'action' => 'content',
                'remote_id' => $page_id
            ));
            if ($page_id > 0 && $route_id > 0) {
                $save_data->success = true;
                $save_data->type = "success";
                $save_data->message = "Content Page ".$page_id." added!";
                $save_data->redirect = "/Pages/Page";
                $activity_model = new DB_Model_ActivityLog();
                $activity = array(
                    "name" => "Content Added",
                    "type" => "fa fa-fw fa-file-text-o",
                    "description" => $_SESSION['user']['username'] . " added a content page",
                    "author_id" => $_SESSION['user']['id'],
                    "note" => "Form ID: ".$page_id
                );
                $activity_model->addRow($activity);
            }
        } else {
            $save_data->success = false;
            $save_data->type = "error";
            $save_data->message = "Could not save content page";
        }
        return $this->returnJson($save_data);
    }

    protected function show($params = null)
    {
        $display_controller = new Display_Controller_Display();
        return $display_controller->content($params['id']);
    }

    protected function create()
    {
        $this->data->page = null;
        return $this->render();
    }

    protected function edit($params = null)
    {
        $pages = new Pages_Model_Page();
        $this->data->page = $pages->findById($params['id']);
        return $this->render();
    }

    protected function delete($params = null)
    {
        $delete_data = new stdClass();
        if ($params['id'] > 0) {
            $pages = new Pages_Model_Page();
            $deleted_rows = $pages->deleteById($params['id']);
            $cust_routes = new DB_Model_CustomRoutes();
            $cust_routes->deleteAllByColumnValue('remote_id', $params['id']);
            if ($deleted_rows > 0) {
                $delete_data->success = true;
                $delete_data->type = "success";
                $delete_data->message = "Content Page: " . $params['id'] . " deleted";
            } else {
                $delete_data->success = false;
                $delete_data->type = "error";
                $delete_data->message = "Content Page: " . $params['id'] . " not found";
            }
        } else {
            $delete_data->success = false;
            $delete_data->type = "error";
            $delete_data->message = "No Content Page ID set";
        }
        return $this->returnJson($delete_data);
    }
}