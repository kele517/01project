<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/9
 * Time: 14:21
 */

$config['url'] = array(
    'base_site_path' => 'http://www.mygithub.com',
    'front_style_path' => 'http://www.mygithub.com/www/home',
    'admin_style_path' => 'http://www.mygithub.com/www/admin',
);
define('BASE_SITE_PATH', $config['url']['base_site_path']);
define('FRONT_STYLE_PATH', $config['url']['front_style_path']);
define('ADMIN_STYLE_PATH', $config['url']['admin_style_path']);