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
    'style_path' => 'http://www.mygithub.com/www',
);

$config['cfg_path'] = array(
    'css' => $config['url']['style_path'].'/home/stylesheets/css/',
    'js' => $config['url']['style_path'].'/home/javascripts/js/',
    'images' => $config['url']['style_path'].'/home/images/',
    'font' => $config['url']['style_path'].'/font/',
    'admin' => $config['url']['style_path'].'/admin/',
    'admin_css' => $config['url']['style_path'].'/admin/assets/css/',
    'admin_js' => $config['url']['style_path'].'/admin/assets/js/',
    'admin_images' => $config['url']['style_path'].'/admin/assets/images/',
    'admin_font' => $config['url']['style_path'].'/admin/assets/fonts/',
);


define('BASE_SITE_PATH', $config['url']['base_site_path']);
define('FRONT_STYLE_PATH', $config['url']['front_style_path']);
define('ADMIN_STYLE_PATH', $config['url']['admin_style_path']);
define('STYLE_PATH', $config['url']['style_path']);
define('TPL_ADMIN_NAME', 'templates/default/');
define('ADMIN_SITE_URL', $config['url']['admin_site_path']);


define('CHARSET', 'utf-8');