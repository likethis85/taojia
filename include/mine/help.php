<?php
function get_taobao_key(){
	return "12360471";
}
function get_taobao_secret(){
	return "aac545420c6a69eec1d7ff48188bd633";
}
function set_lib_system_init()
{
	$t=new lib_System();
	$t->SinaKey="";
	$t->SinaSecret="";
	$t->TaobaoKey="";
	$t->TaobaoSecret="";
	$t->TaobaoSession="";
	
	$t->create($t);
}
function get_session_taobao()
{
	$t=spClass("lib_System");
	$c=array("ID"=>'taojia');
	$result=$t->find($c);
	return $result["TaobaoSession"];
}