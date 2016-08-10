<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 14:21
 */

$config['url'] = array(
    'base_site_path' => 'http://www.mygithub.com',
    'admin_site_path'=> 'http://www.mygithub.com/admin',
    'front_style_path' => 'http://www.mygithub.com/www/home',
    'admin_style_path' => 'http://www.mygithub.com/www/admin',
);

$config['cfg_path'] = array(
    'css' => '/front/css/',
    'js' => '/front/js/',
    'images' => '/front/images/',
    'font' => '/font/',
    'lib' => '/lib/',
    'admin' => '/admin/',
    'admin_css' => '/admin/css/',
    'admin_js' => '/admin/js/',
    'admin_js_fileupload' => '/admin/js/fileupload/',
    'admin_images' => '/admin/images/',
    'seller' => '/seller/',
    'seller_css' => '/seller/css/',
    'seller_js' => '/seller/js/',
    'seller_images' => '/seller/images/',
);


define('BASE_SITE_PATH', $config['url']['base_site_path']);
define('FRONT_STYLE_PATH', $config['url']['front_style_path']);
define('ADMIN_STYLE_PATH', $config['url']['admin_style_path']);
define('TPL_ADMIN_NAME', 'templates/default/');
define('ADMIN_SITE_URL', $config['url']['admin_site_path']);