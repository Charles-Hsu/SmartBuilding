<?php
$dirName=dirname(__FILE__);
$fileNameArray=explode('\\',$dirName);
$fileName=array_pop($fileNameArray);
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$webContainer = substr($url,0,strrpos($url,$fileName));

$defaultName='/smartbuilding';
$httpName='http://';
$urlName=$httpName.$_SERVER['HTTP_HOST'].$defaultName;

define('Document_root',dirname(__FILE__));
