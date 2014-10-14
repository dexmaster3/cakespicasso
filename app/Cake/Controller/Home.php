<?php

class Cake_Controller_Home extends Core_Controller_BaseController
{
    public function index($query)
    {
        $employees = new Cake_Model_Employees();
        $employees->dropTable();
        $employees->createTable();
        $employees->addRow(array( 'name' => 'Dex','title' => 'PHP Pro', 'rank' => 'Specialist'));
        $employees->addRow(array( 'name' => 'Thomas','title' => 'PHP Beginner', 'rank' => 'Private'));
        $this->data->employees = $employees->getAll();
        //TODO: Change the controller so it doesn't have to be URL capitalized, and finish the view part

        if(isset($query['city'])) {
            $this->data->city = $query['city'];
        }
        return $this->render($this->data);
    }
    public function stuff($query)
    {
        //Todo: PDO data fetching here?
        if (strtolower($query['user']) === "french") {
            $data = array(
                'London' => 'CAKES',
                'United' => 'PICASSO'
            );
        }
        else {
            $data = array(
                'London' => "AMERICAN",
                'Kingdom' => "AMERICA"
            );
        }
        return $this->render($data);
    }
}