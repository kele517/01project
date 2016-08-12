<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller//MY_Admin_Controller
{

    public function index()
    {
        $this->lang->load('admin_layout');

        $this->getNav('', $top_nav, $left_nav, $map_nav);
        $admin_info = "";
        //$admin_info = $this->getAdminInfo();

        $result = array(
            'output' => array(
                'html_title' => lang('login_index_title_02'),
                'map_nav' => $map_nav,
                'admin_info' => $admin_info,
                'top_nav' => $top_nav,
                'left_nav' => $left_nav,
            )
        );

        $this->load->view('admin/home', $result);
    }

    public function tmp_send()
    {
        $this->load->service('Message_service');
        $this->message_service->tmp_send();
    }


    /**
     * 取得后台菜单
     *
     * @param string $permission
     * @return
     */
    protected final function getNav($permission = '', &$top_nav, &$left_nav, &$map_nav)
    {

        $act = $this->input->get_post('act');
        $op = $this->input->get_post('op');

        /*$admin_info = $this->getAdminInfo();

        $this->load->model('Admin_role_model');
        if ($this->admin_info['is_super'] != 1 && empty($this->permission)) {

            $gadmin = $this->Admin_role_model->get_by_id($this->admin_info['role_id']);
            $permission = $this->encrypt->decode($gadmin['limits']);
            $this->permission = $permission = explode('|', $permission);
        }*/

        $this->lang->load('common');
        //Language::read('common');
        $array = $this->get_menu();

        $array = $this->parseMenu($array);
        //管理地图
        $map_nav = $array['left'];
        unset($map_nav[0]);

        $model_nav = "<li><a class=\"link actived\" id=\"nav__nav_\" href=\"javascript:;\" onclick=\"openItem('_args_');\"><span>_text_</span></a></li>\n";
        $top_nav = '';

        //顶部菜单
        foreach ($array['top'] as $k => $v) {
            $v['nav'] = $v['args'];
            $top_nav .= str_ireplace(array('_args_', '_text_', '_nav_'), $v, $model_nav);
        }
        $top_nav = str_ireplace("\n<li><a class=\"link actived\"", "\n<li><a class=\"link\"", $top_nav);

        //左侧菜单
        $model_nav = "
          <ul id=\"sort__nav_\">
            <li>
              <dl>
                <dd>
                  <ol>
                    list_body
                  </ol>
                </dd>
              </dl>
            </li>
          </ul>\n";
        $left_nav = '';
        foreach ($array['left'] as $k => $v) {
            $left_nav .= str_ireplace(array('_nav_'), array($v['nav']), $model_nav);
            $model_list = "<li nc_type='_pkey_'><a href=\"JavaScript:void(0);\" name=\"item__opact_\" id=\"item__opact_\" onclick=\"openItem('_args_');\">_text_</a></li>";
            $tmp_list = '';

            $current_parent = '';//当前父级key

            foreach ($v['list'] as $key => $value) {
                $model_list_parent = '';
                $args = explode(',', $value['args']);
                /*if ($admin_info['is_super'] != 1) {
                    if (!@in_array($args[1], $permission)) {
                        //continue;
                    }
                }*/

                if (!empty($value['parent'])) {
                    if (empty($current_parent) || $current_parent != $value['parent']) {
                        $model_list_parent = "<li nc_type='parentli' dataparam='{$value['parent']}'><dt>{$value['parenttext']}</dt><dd style='display:block;'></dd></li>";
                    }
                    $current_parent = $value['parent'];
                }

                $value['op'] = $args[0];
                $value['act'] = $args[1];
                //$tmp_list .= str_ireplace(array('_args_','_text_','_op_'),$value,$model_list);
                $tmp_list .= str_ireplace(array('_args_', '_text_', '_opact_', '_pkey_'), array($value['args'], $value['text'], $value['op'] . $value['act'], !empty($value['parent']) ? $value['parent'] : 0), $model_list_parent . $model_list);
            }

            $left_nav = str_replace('list_body', $tmp_list, $left_nav);

        }
    }


    public function get_menu()
    {
        $this->lang->load('common');

        $menuList = array(
            'top' => array(
                0 => array(
                    'args' => 'dashboard',
                    'text' => '控制台'),
                1 => array(
                    'args' => 'setting',
                    'text' => '设置'),
                2 => array(
                    'args' => 'medicine',
                    'text' => '药品'),
                3 => array(
                    'args' => 'user',
                    'text' => '患者'),
                4 => array(
                    'args' => 'doctor',
                    'text' => '医生'),
                5 => array(
                    'args' => 'hospital',
                    'text' => '医院'),
                6 => array(
                    'args' => 'operation',
                    'text' => '运营'),
            ),
            'left' => array(
                0 => array(
                    'nav' => 'dashboard',
                    'text' => lang('nc_normal_handle'),
                    'list' => array(
                        array('args' => 'welcome,dashboard,dashboard', 'text' => '欢迎页面'),
                        array('args' => ',user,dashboard', 'text' => '用户管理'),

                    )
                ),
                1 => array(
                    'nav' => 'setting',
                    'text' => '设置',
                    'list' => array(
                        array('args' => ',admin,setting', 'text' => '权限设置'),
                    )
                ),
                2 => array(
                    'nav' => 'medicine',
                    'text' => '药品',
                    'list' => array(
                        array('args' => 'catelist,productCate,medicine', 'text' => '药品分类'),
                        array('args' => 'lists,product,medicine', 'text' => '药品管理'),
                        array('args' => 'index,prescription,medicine',      'text' => '下药单管理'),
                    )
                ),
                3 => array(
                    'nav' => 'user',
                    'text' => '患者',
                    'list' => array(
                        array('args' => 'index,user,user',  'text' => '患者管理'),
                        array('args' => 'index,inquiry_list,user',  'text' => '问诊单管理'),
                        array('args' => 'index,user_register,user', 'text' => '挂号单管理'),
                        array('args' => 'index,emergency_suffer,user', 'text' => '紧急患者'),
                    )
                ),
                4 => array(
                    'nav' => 'doctor',
                    'text' => '医生',
                    'list' => array(
                        array('args' => 'index,doctor,doctor', 'text' => '医生管理'),
                        array('args' => ',article,doctor', 'text' => '文章管理'),
                    )
                ),
                5 => array(
                    'nav' => 'hospital',
                    'text' => '医院',
                    'list' => array(
                        array('args' => 'index,hospital_list,hospital', 'text' => '医院管理'),
                        array('args' => 'index,department_list,hospital', 'text' => '科室管理'),
                        array('args' => 'cancel_insurance,hospital_list,hospital',   'text' => '退保管理'),
                        array('args' => 'index,referral,hospital',   'text' => '医院转诊'),
                    )
                ),
                6 => array(
                    'nav' => 'operation',
                    'text' => lang('nc_operation'),
                    'list' => array(
                        // array('args' => ',operation,operation', 'text' => '基本设置'),
                        array('args' => ',homeManage,operation',     'text' => '首页管理'),
                        array('args' => 'index,user_recharge,operation', 'text' => '充值记录'),
                        array('args' => 'cash_list,cash,operation',   'text' => '提现管理'),
                        array('args' => 'index,account,operation',  'text' => '账户明细'),
                        array('args' => ',comment,operation','text' => '评价管理'),
                        array('args' => ',area,operation','text' => '地区管理'),
                        array('args' => ',message,operation',       'text' => '消息推送'),
                    )
                ),
            ),
        );

        return $menuList;
    }

    /**
     * 过滤掉无权查看的菜单
     *
     * @param array $menu
     * @return array
     */
    private final function parseMenu($menu = array())
    {
        //if ($this->admin_info['is_super'] == 1) return $menu;
        foreach ($menu['left'] as $k => $v) {
            foreach ($v['list'] as $xk => $xv) {
                $tmp = explode(',', $xv['args']);
                //以下几项不需要验证
                $except = array('index', 'dashboard', 'login', 'common');
                if (in_array($tmp[1], $except)) continue;
//                if (!in_array($tmp[1], $this->permission) && !in_array($tmp[1] . '.' . $tmp[0], $this->permission)) {
//                    unset($menu['left'][$k]['list'][$xk]);
//                }
            }
            if (empty($menu['left'][$k]['list'])) {
                unset($menu['top'][$k]);
                unset($menu['left'][$k]);
            }
        }
        return $menu;
    }

}
