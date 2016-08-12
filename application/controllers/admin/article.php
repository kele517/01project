<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/10
 * Time: 15:42
 */
class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
        $this->lang->load('admin_layout');
    }

    public function index(){
        $page = _get_page();
        $pagesize = $this->input->get_post('pagesize') ? (int)$this->input->get_post('pagesize') : 10;
        $data = $this->Article_model->fetch_page($page, $pagesize, 'status <> -1');
        if(empty($data['rows'])){
            $data['msg'] = "啊哦，没有文章记录，<a href='add'>去发布</a>";
        }
        $config['base_url'] = BASE_SITE_PATH.'/admin/article/index';
        $config['total_rows'] = $data['count'];
        $config['pagesize'] = $pagesize;

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        get_admin_view('admin/article/index', $data);
    }

    public function add(){
        $title = $this->input->post('title');
        $content = $this->input->post('content');

        if($this->input->is_post()){
            $config = array(
                array(
                    'field' => 'title',
                    'label' => 'Title',
                    'rules' => 'required|max_length[20]|is_unique['.$this->db->dbprefix.'article]'
                ),
                array(
                    'field' => 'content',
                    'label' => 'Content',
                    'rules' => 'required|min_length[100]'
                ),
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('admin/article/add');
            } else {
                $data =array(
                    'title' => $title,
                    'brief' => mb_strcut($content, 0, 70)."...",
                    'content' => $content,
                    'createtime' => time(),
                );
                $flag = $this->Article_model->insert_update($data);
                if($flag)
                    ;//弹窗提示添加成功
                else
                    ;//弹窗提示添加失败
            }
        }

        $this->load->view('admin/article/add');
    }
}