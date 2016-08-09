<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 14:25
 */
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
    }

    public function index()
    {
        $data =array(
            'title' => 'this is a title1',
            'brief' => 'this is a brief',
            'content' => 'this is a content',
        );
        $this->Article_model->insert_update($data);
        $this->load->view('home/index');
    }

    public function del(){
        $this->Article_model->delete(array('id' => array('1', '2')));
    }
}