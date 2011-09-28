<?php

class main extends spController
{
	function index(){
		session_start();
		
		$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );
		
		$keys = $o->getRequestToken();
		$callback = "http://taojia.sinaapp.com/index.php?c=auth&a=come_from_sina_oauth";
		
		$this->aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );
		
		$_SESSION['keys'] = $keys;
		$this->display("default/index.php");
	}
	function home(){
		$this->display("default/home.html");
	}
	function about(){
		$this->display("default/about.html");
	}
	
}
