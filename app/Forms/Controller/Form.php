<?php

class Forms_Controller_Form extends Users_Controller_BaseAuth
{
    protected function index()
    {
        return $this->render();
    }

    protected function create()
    {
        $this->data->page = null;
        return $this->render();
    }
}