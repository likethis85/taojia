<?php
class auth extends spController{
	function index()
	{
		
		$this->display("default/auth/index.html");
	}
	/*
	 * 未认证时去新浪进行认证
	 */
	function go_to_sina_oauth()
	{
		session_start();

		$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );

		$keys = $o->getRequestToken();
	    $callback = "http://taojia.sinaapp.com/index.php?c=auth&a=come_from_sina_oauth";
	
		$this->aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );

        $_SESSION['keys'] = $keys;
        $this->display("default/auth/go_to_sina_oauth.html");
        
        
		
	}
	function go_to_sina_login_to_recom()
	{
		session_start();
		
		$o = new WeiboOAuth( WB_AKEY , WB_SKEY  );
		
		$keys = $o->getRequestToken();
		$callback = "http://taojia.sinaapp.com/index.php?c=auth&a=come_from_sina_oauth_rec&url=".urlencode($_GET["url"]);
		
		$this->aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback );
		
		$_SESSION['keys'] = $keys;
		$this->display("default/auth/go_to_sina_login_to_recom.html");
		
	}
	/*
	* 从新浪认证回来
	*/
	function come_from_sina_oauth()
	{
		$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );
		
		$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
		
		$_SESSION['last_key'] = $last_key;
		$this->jump(spUrl("auth","get_sina_user_info"));
		//$this->display("default/auth/come_from_sina_oauth.html");
		
	}
	function come_from_sina_oauth_rec()
	{
		
		$url=$_GET["url"];
		$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );
		
		$last_key = $o->getAccessToken( $_REQUEST['oauth_verifier'] ) ;
				
		$_SESSION['last_key'] = $last_key;
		$this->jump(spUrl("auth","get_sina_user_info",array("url"=>$url)));
		
	}
	function clear_s()
	{
		$_SESSION["UserName"]=null;
		$this->jump("http://taojia.sinaapp.com");
	}
	function set_setting_sina()
	{
		$this->display("default/auth/setting-sina.html");
	}
	function set_setting_sina_save()
	{
		$arg=spClass("spArgs");
		$k=$arg->get('SinaKey');
		$s=$arg->get('SinaSecret');
		// 获取参数
		$row=array('SinaKey'=>$k,
							'SinaSecret'=>$s);
		$t=spClass("lib_System");
		$condtion=array();
		// 更新
		$t->update($condtion, $row);
	}
	//  设置淘宝数据信息
	function set_setting_taobao()
	{
		$t=spClass("lib_System");
		$c=array("ID"=>'taojia');
		$result=$t->find($c);
		$this->taobaokey=$result["TaobaoKey"];
		$this->taobaosecret=$result["TaobaoSecret"];
		$this->display("default/auth/setting-taobao.html");
	}
	function set_setting_taobao_save()
	{
		$arg=spClass("spArgs");
		$k=$arg->get('TaobaoKey');
		$s=$arg->get('TaobaoSecret');
		// 获取参数
		$row=array('TaobaoKey'=>$k,
					'TaobaoSecret'=>$s);
		$t=spClass("lib_System");
		$condtion=array('ID'=>'taojia');
		// 更新
		$t->update($condtion, $row);
		$this->jump(spUrl("auth","set_setting_taobao"));
	}
	function is_user_exists($user)
	{
		$t=spClass("lib_User");
		$c=array("UserName"=>$user);
		$result=$t->findAll($c);
		if(count($result)>=1)return true;
		return false;
	}
	// 跳转到用户信息界面
	function get_sina_user_info()
	{
		$c = new WeiboClient( WB_AKEY , WB_SKEY , $_SESSION['last_key']['oauth_token'] , $_SESSION['last_key']['oauth_token_secret']  );
		$result  = $c->verify_credentials();
		$this->user_name=$result["screen_name"];
		$_SESSION["UserName"]=$result["screen_name"];
		
		// fix 必须要使用this
		if($this->is_user_exists($result["name"]))
		{
			setcookie("Taojia-UserName",$result["name"]);
		}
		else {
			// 保存数据到数据库
			$t=spClass("lib_User");
			$row=array("SinaToken"=> $_SESSION['last_key']['oauth_token'] ,
							"SinaSecret"=>$_SESSION['last_key']['oauth_token_secret'],
							"UserName"=>$result["screen_name"],
							"InTime"=>date("Y-m-d H:i:s")
			);
			setcookie("Taojia-UserName",$result["name"]);
			setcookie("Taojia-UserName-taobao", $result["name"], time()+36000,"/",".taobao.com");
			$t->create($row);
		
		}
		if($_GET["url"]==null)
		{
		
		$this->jump(spUrl("auth","go_to_user_manage_page"));
		}
		else {
			
			$iid=$this->get_iid2();
			$_SESSION["iid"]=$iid;
			$this->jump(spUrl("item","recommend",array("url"=>$_GET["url"])));
		}
	}
function get_iid2()
	{
		
		$url=$_GET["url"];
		 $url=str_replace(":", "", $url);
		 $url=str_replace("/", "", $url);
		 $url=str_replace("?", "", $url);
			parse_str(urldecode($url));
			
			return $iid=$httpitem_tmall_comitem_htmid!=null?$httpitem_tmall_comitem_htmid:$httpitem_taobao_comitem_htmid;
	}
	function go_to_user_manage_page()
	{
		$user=$_SESSION["UserName"];
		// 获取商品链接表
		$sql="select * from lib_Link,lib_Check where lib_Link.ItemIid=lib_Check.ItemIid and lib_Link.UserName='".$user."'";
		$x=new spModel();
		$result=$x->findSql($sql);
		$this->username=$user;
		// $this->result=$result;
		$this->display("default/auth/go_to_user_manage.php");
		
	}
	function get_user_items()
	{			
		$user=$_SESSION["UserName"];
		// 获取商品链接表
		$sql="select * from lib_Link,lib_Check where lib_Link.ItemIid=lib_Check.ItemIid and lib_Link.UserName='".$user."'";
		$x=new spModel();
		$result=$x->findSql($sql);
		$x=array("aaData"=>$result);
		echo json_encode($result);
	}
	/*
	 * 判断用户是否存在
	 */

	/*
	 * 去taobao认证
	 */
	function go_to_taobao_oauth()
	{
		/*
		 * 跳转到授权页面
		 */
		$this->jump("http://container.open.taobao.com/container?appkey=12360471");
		
	}
	function inner_login_check()
	{
		$this->display("default/auth/inner_login_check.html");
	}
	/*
	 * 从授权页面回来
	 */
	function come_from_taobao_oauth()
	{
		$arg=spClass("spArgs");
		$session=$arg->get("top_session");
		echo $session;
		$t=nspClass("lib_System");
		$condtion=array();
		$row=array("TaobaoSession"=>$session);
		$t->update($condtion, $row);
	}
}