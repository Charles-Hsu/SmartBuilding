<?php
require_once('sqlin.php');
$conf['debug']['level']=5;

/*		数据库配置		*/
//$conf['db']['dsn']='mysql:host=127.0.0.1;dbname=newmedia';
$conf['db']['dsn']='mysql:host=127.0.0.1;dbname=smartbuilding';
$conf['host']='127.0.0.1';
$conf['port']='3306';
$conf['db']['user']='root';
$conf['sysname']='智慧建築標章物業管理系統';
$conf['apartment']='';
/*$conf['db']['password']='1qaz@WSX';*/
$conf['db']['password']='';
$conf['db']['charset']='utf8';
$conf['db']['prename']='ssc_';
define('PASSWORD_KEY','Yb&W@3(g$%*p!--'); // md5 key
//$conf['safepass']='123456';     //后台登陆安全码

//define('Document_root',dirname(__FILE__));

$conf['cache']['expire']=0;
$conf['cache']['dir']='_cache_$98ER29@fw!d#s4fef/';
$conf['cache']['dirqiantai']='C:\\Users\\Administrator\\Desktop\\dsn\\web\\_cache_$98sER9@fw!d#s4fef\\'; //C:\\Users\\Administrator\\Desktop\\dsn\\admin
$conf['cache']['dirwap']='C:\\Users\\Administrator\\Desktop\\dsn\\m\\_cache_$98sER9@fw!d#s4fef\\'; //此处设置手机站前台缓存目录,请写绝对路径
$conf['url_modal']=2;
$conf['action']['template']='wjinc/admin/';
$conf['action']['modals']='wjaction/admin/';
$conf['member']['sessionTime']=30*60;	// 用户有效时长
$conf['node']['access']='http://127.0.0.1:8080';	// node访问基本路径

error_reporting(E_ERROR & ~E_NOTICE);
ini_set('date.timezone', 'asia/shanghai');
ini_set('display_errors', 'Off');
