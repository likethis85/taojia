<?php 
!defined("TOP_SDK_WORK_DIR") && define("TOP_SDK_WORK_DIR", "/tmp/");
/**
* 是否处于开发模式
* 在你自己电脑上开发程序的时候千万不要设为false，以免缓存造成你的代码修改了不生效
* 部署到生产环境正式运营后，如果性能压力大，可以把此常量设定为false，能提高运行速度（对应的代价就是你下次升级程序时要清一下缓存）
*/
!defined("TOP_SDK_DEV_MODE") && define("TOP_SDK_DEV_MODE", true);
/**
* 定义常量结束
*/
$api_home = dirname(__FILE__) . DIRECTORY_SEPARATOR;
function __autoload($name) {
//echo "Want to load $name.\n";
global $api_home;
try{
include($api_home.'top/request/'.$name.'.php');
}catch(Exception $e) {
echo $e->getMessage(), "\n";
//throw new Exception("Unable to load $name.");
}
}
include $api_home."top/TopClient.php";