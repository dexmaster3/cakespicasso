<?php

class Forms_Controller_Form extends Users_Controller_BaseAuth
{
    protected function index()
    {

    }

    protected function create()
    {
        $this->data->page = null;
        return $this->render();
    }
}