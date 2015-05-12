<?php

class Controller_News extends Controller
{

    function __construct()
    {
        $this->model = new Model_News();
        $this->view = new View();

        $view_type = null;
    }

    function action_index()
    {
        if(isset($_POST['add_news'])) $this->model->add_news($_POST);

        $data = $this->model->get_data();
        $cms_list = $this->model->get_cms();

        if(isset($_GET['feed_id'])) {
            $all_news = $this->model->get_all($_GET['feed_id']);
            $data = array_merge($data, $all_news);
        }

        $data = array_merge($data, $this->model->get_sites());

        $this->view->generate('news_view.tpl', $data, $cms_list, $this->model->get_view_type());
    }

    function action_feed()
    {
        if(isset($_POST['add_news'])) $this->model->add_news($_POST);

        if(isset($_POST['save_xpath'])) $this->model->change_rule($_POST);

        $data = $this->model->feed($_GET);
        $data = array_merge($data, $this->model->get_sites());

        if(isset($_POST['add_news'])) $this->model->add_news($_POST);

        $this->view->generate('news_view.tpl', $data, null, $this->model->get_view_type());
    }

    function action_cats()
    {

        $this->model->get_cats($_POST);
    }
}

?>