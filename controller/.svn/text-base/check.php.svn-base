<?php
class check extends spController
{
	function check_it()
	{
		// 检查所有物品栏目
		$this->check_all_item();
		// 将更新的放入更新数据表中
		$this->send_all_notify();
		// 从link表中读取用户数据发送信息
	}

	function check_all_item()
	{
		
		$ss=spClass("lib_Send");
		$ss->delete();
		$t=spClass("lib_Check");
		// 获取所有的商品
	   $sql="select * from lib_Check as a where not exists(select * from lib_Check as b where a.ItemIid=b.ItemIid and a.CheckTime<b.CheckTime)" ;
	   $result=$t->findSql($sql);
	   // 对于每一个商品
		foreach($result as $x)
		{
			////($x);
			if($this->check_if_updates($x["ItemIid"]))
			{
				// insert into temp
				$s=spClass("lib_Send");
				$r=array("ItemIid"=>$x["ItemIid"]);
				$s->create($r);
				//($r);
			}
		}
	}
	function  send_all_notify()
	{
		$t=spClass("lib_Send");
		$result=$t->findAll();
		foreach($result as $x)
		{
			$this->notify_all_sinas($x["ItemIid"]);
		}
	}
	// 检查是否需要更新
function check_if_updates($iid)
{
	// 获取上次的更新数据
	$latest=$this->get_item_last_price($iid);
	// 获取最新的商品价格
	$now=$this->get_item_now_price($iid);
	
	return $this->need_notify(floatval($now),floatval($latest));
}
function get_item_now_price($iid)
{
	
	//获取原来的商品价格 以及数据
	$at=spClass("lib_Check");
	$asql="select * from lib_Check as a where not exists(select * from lib_Check as b where a.ItemIid=b.ItemIid and a.CheckTime<b.CheckTime".") and a.ItemIid=".$iid." ";
	////($aspl);
	$aresult=$at->findSql($asql);
	//($aresult);
	$client=spClass("TopClient");
	$client->appkey=get_taobao_key();
	$client->secretKey=get_taobao_secret();
	$request=spClass("ItemGetRequest");
	$request->setNumIid($iid);
	$fields="detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual";
	$request->setFields($fields);
	$result=$client->execute($request,get_session_taobao());
	// 获取淘宝的访问数据
	////($result);
	////($result);
	// fix
	$tt=spClass("lib_Check");
	//$ax=floatval($aresult[0]["ItemPrice"])-floatval($result->item->price);
	if(floatval($aresult[0]["ItemPrice"])-floatval($result->item->price)!=0&&$result->item->price!=null)
	{
		
	     $row=array("ItemPrice"=>$result->item->price,
							"CheckTime"=>date("Y-m-d H:i:s"),
							"ItemUrl"=>$aresult[0]["ItemUrl"],
							"ItemIid"=>$aresult[0]["ItemIid"],
							"ItemName"=>$aresult[0]["ItemName"],
							"ItemPic"=>$aresult[0]["ItemPic"]
	);
	
	$tt->create($row);
	return $result->item->price;
	}
	else
	{
		return floatval($aresult[0]["ItemPrice"]);
	}

	
		
}
function get_item_last_price($iid)
{
	// 获取原来的商品价格
	$at=spClass("lib_Check");
	$asql="select * from lib_Check as a where not exists(select * from lib_Check as b where a.ItemIid=b.ItemIid and a.CheckTime<b.CheckTime".") and a.ItemIid=".$iid." ";
	////($aspl);
	$aresult=$at->findSql($asql);
	$re=$aresult[0]["ItemPrice"];
	//($re);
	return  $re;
}
function need_notify($now,$last)
{
	//($now);
	//($last);
	if($now<$last)
	return true;
	else
	 return false;
}
function get_item_notify_sinas($iid)
{
	$t=spClass("lib_Link");
	$c=array("ItemIid"=>$iid);
	$result=$t->findAll($c);
	//($result);
	return $result;
}
function get_item_notify($iid)
{
	$t=spClass("lib_Check");
	$c=array("ItemIid"=>$iid);
	$result=$t->findAll($c);
	//($result);
	return $result;
}
function notify_all_sinas($iid)
{
	$item=$this->get_item_notify($iid);
	foreach($this->get_item_notify_sinas($iid) as $x)
	{
		$this->notify_one_sina($item, $x["UserName"]);
	}
}
function notify_one_sina($item,$user)
{
	$u=$this->get_one_sina_tokens($user);
		$o = new WeiboClient( WB_AKEY , WB_SKEY ,$u["SinaToken"],$u["SinaSecret"]);
		// 价格降低
		$status="@".$user." 你好，".$item[0]["ItemName"]."降价啦，去看看吧".$item[0]["ItemUrl"];
		$re=$o->update($status);
		dump($re);
}
function get_one_sina_tokens($iid)
{
	$t=spClass("lib_User");
	$c=array("UserName"=>"myDoTask");
	$result=$t->find($c);
	return array("SinaToken"=>$result["SinaToken"],
				"SinaSecret"=>$result["SinaSecret"]);
	
}
}
