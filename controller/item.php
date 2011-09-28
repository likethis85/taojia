<?php
class item extends spController{
	/*
	 * 添加新的用户产品检查链接表
	*/
	function add()
	{
		try {

			$arg=spClass("spArgs");
			 $user=$_SESSION["UserName"];
			 $iid=$arg->get("ItemIid");
			if($this->is_link_exists($user, $iid))
			{
				$json = '{"message":"exists"}';
				echo json_decode($json);
			}
			else
			{
				$time=date("Y-m-d H:i:s");
				$price=$arg->get("WantPrice","-313");

				$t=spClass("lib_Link");
				$row=array(
		"ItemIid"=>$iid,
		"UserName"=>$user,
		"InTime"=>$time,
		"WantPrice"=>floatval($price)
				);

				$t->create($row);
				$this->add_to_check($iid);


				$json = '{"message":"ok"}';
				echo json_decode($json);
			}
		}
		catch(Exception $e)
		{
			$json = '{"message":"fail"}';
			echo json_decode($json);

		}

	}
	function is_taobao()
	{
		
		return count(explode("taobao",$_GET["url"]))>1||count(explode("tmall",$_GET["url"]))>1;
	}
	function recommend()
	{
		if(!$this->is_taobao())
		{
			$this->display("default/item/not_taobao.html");
			return;
		}
		if($_SESSION["UserName"]==null)
		{
			$url=spUrl("auth","go_to_sina_login_to_recom",array("url"=>$_GET["url"]));
			$this->jump($url);
		}
		else
		{
			
			
			$this->iid=$this->get_iid2();
			//dump($this->iid);
			$_SESSION["iid"]=$this->iid;
			$this->display("default/item/recommend.php");
			
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
	function recommend_save()
	{
		try {
		
			$arg=spClass("spArgs");
		
			$iid=$_SESSION["iid"];
			$user=$_SESSION["UserName"];
			if($this->is_link_exists($user, $iid))
			{
				$this->add_to_check($iid);
				$this->display("default/item/ok.html");
				
			}
			else
			{
				$time=date("Y-m-d H:i:s");
				$price=$arg->get("WantPrice","-313");
		
				$t=spClass("lib_Link");
				$row=array(
				"ItemIid"=>$iid,
				"UserName"=>$user,
				"InTime"=>$time,
				"WantPrice"=>floatval($price)
				);
		
				$t->create($row);
				$this->add_to_check($iid);
		
		$this->display("default/item/ok.html");
			}
		}
		catch(Exception $e)
		{
		$this->display("default/item/ok.html");
		
		}
	}
	
	function add2()
	{
		try {
	
			$arg=spClass("spArgs");
			$user=$arg->get("UserName");
			$iid=$arg->get("ItemIid");
			if($this->is_link_exists($user, $iid))
			{
				$json = '{"message":"exists"}';
				echo json_decode($json);
			}
			else
			{
				$time=date("Y-m-d H:i:s");
				$price=$arg->get("WantPrice","-313");
	
				$t=spClass("lib_Link");
				$row=array(
			"ItemIid"=>$iid,
			"UserName"=>$user,
			"InTime"=>$time,
			"WantPrice"=>floatval($price)
				);
	
				$t->create($row);
				$this->add_to_check($iid);
	
	
				$json = '{"message":"ok"}';
				echo json_decode($json);
			}
		}
		catch(Exception $e)
		{
			$json = '{"message":"fail"}';
			echo json_decode($json);
	
		}
	
	}
	// 添加商品到数据库
	function add_to_check($iid)
	{
		if(!$this->is_item_exists($iid)){
			$tt=spClass("lib_Check");
			$client=spClass("TopClient");
			$client->appkey=get_taobao_key();
			$client->secretKey=get_taobao_secret();
			$request=spClass("ItemGetRequest");
			$request->setNumIid($iid);
			$fields="detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual";
			$request->setFields($fields);
			$result=$client->execute($request,get_session_taobao());
			//dump($result);
			// fix
			$row=array("ItemIid"=>$iid,
					"ItemName"=>$result->item->title,
					"ItemPrice"=>$result->item->price,
					"CheckTime"=>date("Y-m-d H:i:s"),
					"ItemUrl"=>$result->item->detail_url,
					"ItemPic"=>$result->item->pic_url);
			$tt->create($row);
		}
		else{
		

		}
	}
	function is_link_exists($user,$iid)
	{
		$t=spClass("lib_Link");
		$c=array("UserName"=>$user,"ItemIid"=>$iid);
		$result=$t->findAll($c);
		if(count($result)>=1)return true;
		return false;
	}
	function is_item_exists($iid)
	{
		$t=spClass("lib_Check");
		$c=array("ItemIid"=>$iid);
		$result=$t->findAll($c);
		if(count($result)>=1)return true;return false;
	}
	// 获取商品信息
	function get_info()
	{

		try {
			$arg=spClass("spArgs");
			$iid=$arg->get("ItemIid");
			$client=new TopClient();
			$request=new ItemGetRequest();
			$request->setNumIid($iid);
			$fields="detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual";
		
		$request->setFields($fields);
		$result=$client->execute($request,get_session_taobao());
		
		$json =array("message"=>"ok","url"=>$result["detail_url"]);
		        echo json_decode($json);
		
		}
		catch(Exception $e)
		{
		$json = '{"message":"fail"}';
		        echo json_decode($json);
		
		}
	}
	function add_test()
	{
		$this->display("default/item/add_test.html");
	}
	
	function delete_post()
	{
		try {
			$arg=spClass("spArgs");
			$iid=$arg->get("ItemIid");
			$user=$arg->get("UserName");
			
			$t=spClass("lib_Link");
			$row=array(
				"ItemIid"=>$iid,
				"UserName"=>$user
				
			);
		
			$t->delete($row);
			$json=array("message"=>"ok");
			echo json_decode($json);
		}
		catch(Exception $e)
		{
			$json = '{"message":"fail"}';
		        echo json_decode($json);
		}
	}
}