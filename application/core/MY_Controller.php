<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package        CodeIgniter
 * @author        ExpressionEngine Dev Team
 * @copyright    Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license        http://codeigniter.com/user_guide/license.html
 * @link        http://codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package        CodeIgniter
 * @subpackage    Libraries
 * @category    Libraries
 * @author        ExpressionEngine Dev Team
 * @link        http://codeigniter.com/user_guide/general/controllers.html
 */
class MY_Controller extends CI_Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
}

// END Controller class
/* End of file Controller.php */
/* Location: ./system/core/Controller.php */

/**
 * 管理员
 */
class MY_Admin_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->admin_info = $this->systemLogin();
        if (empty($this->admin_info['admin_id']) || !$this->checkPermission()) {
            // 验证权限
            redirect(ADMIN_SITE_URL . '/login');
        }
    }

    /**
     * 取得当前管理员信息
     *
     * @param
     * @return 数组类型的返回结果
     */
    final protected function getAdminInfo()
    {
        return $this->admin_info;
    }

    /**
     * 验证当前管理员权限是否可以进行操作
     */
    function checkPermission($link_nav = null)
    {
        if ($this->admin_info['is_super'] == 1) return true;
        $act = $this->router->fetch_class();
        $op = $this->router->fetch_method();

        if (empty($this->permission)) {
            $this->load->model('Admin_role_model');

            $gadmin = $this->Admin_role_model->get_by_id($this->admin_info['role_id']);
            $permission = $this->encrypt->decode($gadmin['limits']);
            $this->permission = $permission = explode('|', $permission);
        } else {
            $permission = $this->permission;
        }
        //显示隐藏小导航，成功与否都直接返回
        if (is_array($link_nav)) {
            if (!in_array("{$link_nav['act']}.{$link_nav['op']}", $permission) && !in_array($link_nav['act'], $permission)) {
                return false;
            } else {
                return true;
            }
        }

        //以下几项不需要验证
        $tmp = array('index', 'dashboard', 'login', 'common', 'home');
        if (in_array($act, $tmp)) return true;
        if (in_array($act, $permission) || in_array("$act.$op", $permission)) {
            return true;
        } else {
            $extlimit = array('ajax', 'export_step1');
            if (in_array($op, $extlimit) && (in_array($act, $permission) || strpos(serialize($permission), '"' . $act . '.'))) {
                return true;
            }
            $bResult = false;
            //带前缀的都通过
            foreach ($permission as $v) {
                if (!empty($v) && strpos("$act.$op", $v . '_') !== false) {
                    $bResult = true;
                    break;
                }
            }
            return $bResult;
        }
        return false;
    }

    /**
     * 系统后台登录验证
     *
     * @param
     * @return array 数组类型的返回结果
     */
    function systemLogin()
    {
        //取得cookie内容，解密，和系统匹配
        $user = unserialize($this->encrypt->decode($this->session->userdata('sys_key'), C('basic_info.MD5_KEY')));
        if (!key_exists('role_id', (array)$user) || !isset($user['is_super']) || (empty($user['admin_name']) || empty($user['admin_id']))) {
            @header('Location: ' . ADMIN_SITE_URL . '/login');
            exit;
        } else {
            $this->systemSetKey($user);
        }
        return $user;
    }

    /**
     * 系统后台 会员登录后 将会员验证内容写入对应cookie中
     *
     * @param string $name 用户名
     * @param int $id 用户ID
     * @return bool 布尔类型的返回结果
     */
    protected final function systemSetKey($user)
    {
        $this->session->set_userdata('sys_key', $this->encrypt->encode(serialize($user), C('basic_info.MD5_KEY')), 36000);
        //$this->input->set_cookie('sys_key',$this->encrypt->encode(serialize($user),C('basic_info.MD5_KEY')),3600,'',null);
    }

    /**
     * 取得所有权限项
     *
     * @return array
     */
    public function permission()
    {

        $limit = array(
            array('name' => '设置', 'child' => array(
                array('name' => '权限设置', 'op' => null, 'act' => 'admin'),
            )),
            array('name' => '药品', 'child' => array(
                array('name' => '药品分类', 'op' => null, 'act' => 'category'),
                array('name' => '药品管理', 'op' => null, 'act' => 'goods'),
            )),

            array('name' => '患者', 'child' => array(
                array('name' => '患者管理', 'op' => null, 'act' => 'user'),
                array('name' => '问诊单管理', 'op' => null, 'act' => 'inquery'),
                array('name' => '挂号单管理', 'op' => null, 'act' => 'register'),
                array('name' => '紧急患者', 'op' => null, 'act' => 'emergency'),
            )),
            array('name' => '医生', 'child' => array(
                array('name' => '医生管理', 'op' => null, 'act' => 'doctor'),
                array('name' => '文章管理', 'op' => null, 'act' => 'article'),
                array('name' => '提现管理', 'op' => null, 'act' => 'cash'),
            )),
            array('name' => '医院', 'child' => array(
                array('name' => '医院管理', 'op' => 'null', 'act' => 'hospital'),
                array('name' => '科室管理', 'op' => 'null', 'act' => 'department'),
                array('name' => '提现管理', 'op' => 'null', 'act' => 'cash'),
            )),
            array('name' => '运营', 'child' => array(
                array('name' => '首页管理', 'op' => null, 'act' => 'homemanage'),
                array('name' => '充值记录', 'op' => null, 'act' => 'recharge'),
                array('name' => '账户明细', 'op' => null, 'act' => 'ammount'),
                array('name' => '评价管理', 'op' => null, 'act' => 'comment'),
                array('name' => '地区管理', 'op' => null, 'act' => 'area'),
                array('name' => '消息推送', 'op' => null, 'act' => 'message'),
            )),
        );

        if (is_array($limit)) {
            foreach ($limit as $k => $v) {

                if (is_array($v['child'])) {
                    $tmp = array();
                    foreach ($v['child'] as $key => $value) {
                        $act = (!empty($value['act'])) ? $value['act'] : '';
                        if (strpos($act, '|') == false) {//act参数不带|
                            $op = empty($value['op']) ? '' : $value['op'];
                            $limit[$k]['child'][$key]['op'] = rtrim($act . '.' . str_replace('|', '|' . $act . '.', $op), '.');
                        } else {//act参数带|
                            $tmp_str = '';
                            if (empty($value['op'])) {
                                $limit[$k]['child'][$key]['op'] = $act;
                            } elseif (strpos($value['op'], '|') == false) {//op参数不带|
                                foreach (explode('|', $act) as $v1) {
                                    $tmp_str .= "$v1.{$value['op']}|";
                                }
                                $limit[$k]['child'][$key]['op'] = rtrim($tmp_str, '|');
                            } elseif (strpos($value['op'], '|') != false && strpos($act, '|') != false) {//op,act都带|，交差权限
                                foreach (explode('|', $act) as $v1) {
                                    foreach (explode('|', $value['op']) as $v2) {
                                        $tmp_str .= "$v1.$v2|";
                                    }
                                }
                                $limit[$k]['child'][$key]['op'] = rtrim($tmp_str, '|');
                            }
                        }
                    }
                }
            }

            return $limit;
        } else {
            return array();
        }
    }
}

/**
 * 医院后台控制器
 */
class MY_Hospital_Controller extends TokenApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hospital_model');
        $hospitalInfo =  $this->Hospital_model->get_by_where("user_id=".$this->loginUser['user_id'],"id as hosp_id,weight,weight_price,retreat_num,name,icon,level,province,province_name,city,city_name,area,area_name,address,tel_phone,status");
        if(empty($hospitalInfo)){
            output_error(-104,'这不是个医院端用户！');
        }
        $this->loginUser = array_merge($this->loginUser,$hospitalInfo);
    }
}

/**
 * 医院后台控制器
 */
class MY_Admin_Hospital_Controller extends CI_Controller
{
    public $loginUser = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->loginUser = $this->hospitalLogin();
        //print_r($this->loginUser);exit();
    }

    /**
     * 系统后台登录验证
     *
     * @param
     * @return array 数组类型的返回结果
     */
    function hospitalLogin()
    {
        //取得cookie内容，解密，和系统匹配
        $user = unserialize($this->encrypt->decode($this->session->userdata('hospital_key'), C('basic_info.MD5_KEY')));
        if ( !isset($user['user_name']) || (empty($user['hospital_user_id']) || empty($user['hospital_id']) || empty($user['hospital_name']))) {
            @header('Location: ' . ADMIN_HOSPITAL_SITE_URL.'/login');
            exit;
        } else {
            return $user;
        }    
    }

}

/**
 * 医生后台控制器
 */
class MY_Admin_Doctor_Controller extends CI_Controller
{
    public $loginUser = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->loginUser = $this->doctorLogin();
    }

    /**
     * 系统后台登录验证
     *
     * @param
     * @return array 数组类型的返回结果
     */
    function doctorLogin()
    {
        //取得cookie内容，解密，和系统匹配
        $user = unserialize($this->encrypt->decode($this->session->userdata('doctor_key'), C('basic_info.MD5_KEY')));
        if ( !isset($user['user_name']) || (empty($user['doctor_user_id']) || empty($user['doctor_id']))) {
            @header('Location: ' . ADMIN_DOCTOR_SITE_URL.'/login');
            exit;
        } else {
            return $user;
        }    
    }
}


/**
 * 无需登录token的Api父类
 */
class ApiController extends CI_Controller
{
    const APPKEY = 'yibobo@!$';

    public function __construct()
    {
        parent::__construct();

        //$flag = 0;
        $flag = 1;

        //验证签名是否正确
        $get_sign = $this->input->post('sign');
        $timestamp = $this->input->post('timestamp');
        $post = $_POST;

        $post = _request_format($post);
        ksort($post);
        unset($post['timestamp']);
        unset($post['sign']);
        foreach ($post as $key => $value) {
            $post[$key] = $key . '=' . $value;
        }
        $str = implode('&', $post);
        if (empty($post)) {
            $str = 'appkey=' . self::APPKEY . '&timestamp=' . $timestamp;
        } else {
            $str .= '&appkey=' . self::APPKEY . '&timestamp=' . $timestamp;
        }

        $sign = md5(urlencode($str));
        if ($flag == 1) {
            if ($sign != $get_sign) {
                output_error(-100, '签名出错-' . $sign);
                exit;
            }
        }

    }

}

/**
 * 需要登录token信息的Api父类
 */
class TokenApiController extends ApiController
{
    public $tokenUser = array();
    public $loginUser = array();
    public $doctorId;
    public function __construct()
    {
        parent::__construct();

        //验证token信息是否正确
        $this->load->model('User_token_model');

        $token = $this->input->post('token');
        $where['token'] = "'$token'";
        $where['status'] = 1;
        $this->tokenUser = $this->User_token_model->get_by_where($where);
        if (empty($this->tokenUser)) {
            output_error(-101, '请先登录');
        }
        if ($this->tokenUser['status'] == -2) {
            output_error(-102, '登录已失效，请重新登陆');
        }

        $this->load->model('userinfo_model');
        $this->loginUser = $this->userinfo_model->get_by_id($this->tokenUser['user_id'],'id,type,rongytoken,portrait,card_id,real_name,username,twid,balance,status,follow_num,paypsw');

        $this->loginUser['user_id'] = $this->loginUser['id'];
        $this->loginUser['user_name'] = $this->loginUser['username'];
        $this->loginUser['user_type'] = $this->loginUser['type'];
        $this->loginUser['token'] = $this->tokenUser['token'];

        if ($this->loginUser['type']==2) {//医生
            $this->load->model('doctor_model');
            $doctorInfo = $this->doctor_model->get_by_where(array('user_id'=>$this->loginUser['id']),'portrait,real_name,doctor_title');
            $this->loginUser['doctor_portrait'] = $doctorInfo['portrait'];
            $this->loginUser['doctor_real_name'] = $doctorInfo['real_name'];
            $this->loginUser['doctor_title'] = $doctorInfo['doctor_title'];
            $this->set_doctor_id();
        }

        /*$this->loginUser['user_id'] = $aUser['id'];
        $this->loginUser['user_type'] = $aUser['type'];
        $this->loginUser['user_name'] = $aUser['username'];
        $this->loginUser['real_name'] = $aUser['real_name'];
        $this->loginUser['card_id'] = $aUser['card_id'];
        $this->loginUser['twid'] = $aUser['card_id'];*/
        //加入验证开始
        /*$this->load->service('user_service');
        if ($this->loginUser['user_type'] ==1) {//患者
            $is_info = $this->user_service->get_user_receiver_info($this->loginUser['user_id']);
            //print_r($is_info);exit();
            if ($is_info['code']==1) {
               $arrRes['is_status'] = 2;
            }else{
                $arrRes['is_status'] = 0;
            }
        }else{//医生或者医院
            $is_info = $this->user_service->get_user_status($this->loginUser['user_type'],$this->loginUser['user_id']);
            if ($is_info['code']==1) {
                $arrRes['is_status'] = 1;
            }elseif ($is_info['code']==2) {
                $arrRes['is_status'] = 2;
            }elseif($is_info['code']==3){
                $arrRes['is_status'] = 3;
            }else{
                $arrRes['is_status'] = 0;
            }
        }

        if ($arrRes['is_status']==0) {
            output_error(-3000, '未完善信息，请先完善信息');
        }elseif ($arrRes['is_status']==1) {
            output_error(-3001, '未审核通过');
        }*/
        //加入验证结束
        //print_r($arrRes);exit();
        if (empty($this->loginUser) || $this->loginUser['status'] != 1) {
            output_error(-103, '无效账户，账户被锁定或已删除');
        }
    }

    private function set_doctor_id()
    {
        $this->load->model('Doctor_model');
        $doctor = $this->Doctor_model->fetch_row('user_id = ' . $this->loginUser['user_id'], 'id,status', 'id desc');
        if ($doctor) {
            if ($doctor['status'] == 1){
                $this->doctorId = $doctor['id'];
            }
        }    
    }

    public function verify_doctor($item_id, $type = 0)
    {
        if (!$item_id)
            return false;
        $doctor_id = 0;
        if ($type == 1) {
            $this->load->model("User_inquiry_model");
            $doctor_id = $this->User_inquiry_model->fetch_field('id=' . $item_id, 'doctor_id');
        } else if ($type == 2) {
            $this->load->model("User_register_model");
            $doctor_id = $this->User_register_model->fetch_field('id='.$item_id,'last_doctor_id');
        }
        if ($this->doctorId == $doctor_id) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 店铺 control新父类
 *
 */
class BaseSellerController extends CI_Controller
{

    //店铺信息
    protected $store_info = array();
    //店铺等级
    protected $store_grade = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Shop_model');

        $user_id = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        if (!empty($user_id)) {
            $this->loginUser = array('shop_id' => $_SESSION['shop_id'], 'user_id' => $_SESSION['user_id'], 'user_name' => $_SESSION['user_name'], 'user_logo' => $_SESSION['user_logo'], 'name' => $_SESSION['name'], 'shop_name' => $_SESSION['shop_name']);

        } else {
            redirect(SELLER_SITE_URL . '/login');
        }

        //$this->load->lang(array('common','shop_layout','member_layout'));
        //if(!C('site_status')) halt(C('closed_reason'));
        Tpl::setDir('seller');
        Tpl::setLayout('seller_layout');
    }

    protected function getSellerMenuList($is_admin, $limits)
    {
        $seller_menu = array();
        if (intval($is_admin) !== 1) {
            $menu_list = $this->_getMenuList();
            foreach ($menu_list as $key => $value) {
                foreach ($value['child'] as $child_key => $child_value) {
                    if (!in_array($child_value['act'], $limits)) {
                        unset($menu_list[$key]['child'][$child_key]);
                    }
                }

                if (count($menu_list[$key]['child']) > 0) {
                    $seller_menu[$key] = $menu_list[$key];
                }
            }
        } else {
            $seller_menu = $this->_getMenuList();
        }
        $seller_function_list = $this->_getSellerFunctionList($seller_menu);
        return array('seller_menu' => $seller_menu, 'seller_function_list' => $seller_function_list);
    }

    private function _getCurrentMenu($seller_function_list)
    {
        $current_menu = $seller_function_list[$_GET['act']];
        if (empty($current_menu)) {
            $current_menu = array(
                'model' => 'index',
                'model_name' => '首页',
            );
        }
        return $current_menu;
    }

    private function _getSellerFunctionList($menu_list)
    {
        $format_menu = array();
        foreach ($menu_list as $key => $menu_value) {
            foreach ($menu_value['child'] as $submenu_value) {
                $format_menu[$submenu_value['act']] = array(
                    'model' => $key,
                    'model_name' => $menu_value['name'],
                    'name' => $submenu_value['name'],
                    'act' => $submenu_value['act'],
                    'op' => $submenu_value['op'],
                );
            }
        }
        return $format_menu;
    }

}

/**
 * 需要登录token信息的Api父类
 */
class TokenDeliverApiController extends CI_Controller
{
    public $loginUser = array();

    public function __construct()
    {
        parent::__construct();

        //验证token信息是否正确
        $this->load->model('Deliver_user_pwd_model');

        $token = $this->input->post('token');

        $where['token'] = "'$token'";
        $this->loginUser = $this->Deliver_user_pwd_model->get_by_where($where);

        if (empty($this->loginUser)) {
            $arrRes = array('data' => new \stdClass, 'code' => '-1', 'msg' => 'USER_NOT_EXIST');
            echo json_encode($arrRes);
            exit;
        }
    }
}
