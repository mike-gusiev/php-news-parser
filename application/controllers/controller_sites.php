<?php

class Controller_Sites extends Controller
{

    function __construct()
    {
        $this->model = new Model_Sites();
        $this->view = new View();
    }


    function action_index()
    {
        $data = $this->model->get_data();
        $cms_list = $this->model->get_cms();

        $this->view->generate('sites_view.tpl', $data, $cms_list);
    }

    function action_add()
    {
        echo $this->model->add_site($_POST);
    }


    function action_del()
    {
        echo $this->model->del_site($_POST);
    }


    function action_edit_get()
    {
        echo $this->model->edit_site_get($_POST);
    }


    function action_edit_put()
    {
        echo $this->model->edit_site_put($_POST);
    }

    function action_check()
    {
        echo $this->model->check_site($_POST);
    }
}

?>