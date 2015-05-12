<?php

class Controller_Feeds extends Controller
{

    function __construct()
    {
        $this->model = new Model_Feeds();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();

        $this->view->generate('feeds_view.tpl', $data);
    }

    function action_add()
    {
        echo $this->model->add_feed($_POST);
    }

    function action_del()
    {
        echo $this->model->del_feed($_POST);
    }


    function action_edit_get()
    {
        echo $this->model->edit_feed_get($_POST);
    }


    function action_edit_put()
    {
        echo $this->model->edit_feed_put($_POST);
    }
}

?>