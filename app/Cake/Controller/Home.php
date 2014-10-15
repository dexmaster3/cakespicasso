<?php

class Cake_Controller_Home extends Core_Controller_BaseController
{
    public function index($query)
    {
        $employees = new Cake_Model_Employees();
        $this->data->employees = $employees->getAll();

        if (isset($query['city'])) {
            $this->data->city = $query['city'];
        }
        return $this->render();
    }
    public function seedUsers()
    {
        $employees = new Cake_Model_Employees();
        $employees->dropTable();
        $employees->createTable();
        $employees->addRow(array('name' => 'Dex', 'title' => 'PHP Pro', 'rank' => 'Specialist'));
        $employees->addRow(array('name' => 'Thomas', 'title' => 'PHP Beginner', 'rank' => 'Private'));
        $this->data->employees = $employees->getAll();

        return $this->render();
    }

    public function deleteUsers()
    {
        $employee = new Cake_Model_Employees();
        $employee->dropTable();
        $employee->createTable();
        $this->data->employees = $employee->getAll();

        return $this->render();
    }

    public function deleteUser($query)
    {
        $employee = new Cake_Model_Employees();
        $employee->deleteById($query['id']);
        $this->data->employees = $employee->getAll();

        return $this->render();
    }

    public function newUser($query)
    {
        $employee = new Cake_Model_Employees();
        if (isset($query['name']) && isset($query['title']) && isset($query['rank'])) {
            $employee->addRow(array(
                'title' => $query['title'],
                'rank' => $query['rank'],
                'name' => $query['name']
            ));
        }
        $this->data->employees = $employee->getAll();
        return $this->render();
    }

    public function addUser()
    {
        return $this->render();
    }
}