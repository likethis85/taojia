<?php 
print <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>淘价313</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=1000" />
    <link rel="shortcut icon" href="http://5.taojia.sinaapp.com/tpl/images/hg_dog.ico" type="image/x-icon"> 
    <!--[if gte IE 7]><!-->
    <link href="http://5.taojia.sinaapp.com/tpl/default/stylesheets/master.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <link href="http://5.taojia.sinaapp.com/tpl/default/stylesheets/jquery.Jcrop.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <!-- <![endif]-->
    <link href="http://5.taojia.sinaapp.com/tpl/default/stylesheets/print.css" media="print" rel="stylesheet" type="text/css" />
</head>
<body id="details">
    <div id="header" class="group">
        <div id="header-inner" class="group">
            <div id="logo">
                <a href="/">
</a>
            </div>
            <div id="dashboard">
              
            </div>
            <ul id="nav">
           
                <li id="t-signin">
                {$username}
                </li>
                <li id="t-signin">
                <a href="http://taojia.sinaapp.com/index.php?c=auth&a=clear_s">退出</a>
                </li>
           
                
             
                <li id="t-about"><a href="http://taojia.sinaapp.com/index.php?c=main&a=about">关于</a></li>
            </ul>
        </div>
    </div>
    <!-- /header -->
    <hr />
    <div class="notice hide">
        <h2 id="ajax-message">
        </h2>
    </div>
  
    <div id="wrap">
        <div id="wrap-inner">
            <div id="content" class="group">
				<div class="group">
					<div class="announce-btn announce-featured">
						<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://taojia.sinaapp.com/index.php?c=item&a=recommend&url='+e(d.location.href)+'&title='+e(d.title)+'&sel='+e(s)+'&v=1',x=function(){if(!window.open(r,'taojia','toolbar=0,resizable=1,scrollbars=yes,status=1,width=400,height=180'))location.href=r+'&r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()">
									
									<strong class="title">	淘价313</strong> 

							</a>
					</div>
				</div>
                <div id="main">
                  <ul class="tabs">
</ul>

<table class="data users-table" cellspacing="0">
	<tr>
		<th class="list-title">商品</th>
		
		<th class="num">最新价格</th>	
		
	</tr>

       <div id="result"></div>
          
				
			
    
    </table>

    <div class="page">
   
</div>
                </div>
                <!-- /main -->
                 <div id="secondary">
                	<div class="ad-top-wrap">
    					<div class="ad last group">
       						 <a href="#" class="flag">Tips!!!</a> <a href="#">
          					 
           					 <h3><strong>使用方式</strong></h3><em>把上边的淘价313拖到书签工具栏上，就可以快速关注淘宝商品，第一时间得到降价通知。</em> </a>
    						</div>
   						 </div>
   						 <div class="ad ">
       						 <a href="#">
          					 
           					 <h3><strong>更新</strong></h3><em>2011/9/17 版本号升级。</em> </a>
    						</div>
   						 </div>
                </div>
                <!-- /secondary -->
            </div>
            <!-- /content -->
        </div>
    </div>
    <!-- /wrap -->
    <hr />
    <div id="footer">
        <div id="footer-inner">
            <h4 id="pixels-total" class="group">
              
            </h4>
            <p id="footer-nav">
                 <a href="/blog/to/i">
                    Blog</a> |
                <a href="/site/terms">Terms</a> | <a href="/site/privacy">Privacy</a> | <a href="/site/api">
                    API</a> 
            </p>
            <p>
                Copyright &copy; 2009-2011  &copy; 
                <br />
             </p>
            <p>
              </p>
        </div>
    </div>
    <!-- /footer -->
    <!-- c(~) -->
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/jquery-1.5.1.js"></script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/jquery.Jcrop.js" type="text/javascript"></script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/jquery.form.js" type="text/javascript"></script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/jquery.tipsy.js" type="text/javascript"></script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/application.js" type="text/javascript"></script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/screenshot.js" type="text/javascript"></script>
    <script>
        $('#share-form-url').click(function () {
            this.select();
        });
    </script>
    <script>
        $('#add-tag-link').click(showTagForm);
        $('#cancel-tag-link').click(hideTagForm);
        $('.delete-tag').click(deleteTag);
        ajaxifyTagForm();

        function ajaxifyTagForm() {
            $('#add-tag-form').ajaxForm({
                dataType: 'html',
                success: function (html) {
                    $('#tags').html(html);
                    $('#screenshot_tag_list').val('').focus();
                    $('.delete-tag').click(deleteTag); // Re-apply delete behavior
                }
            });
        }

        function showTagForm() {
            $('#add-tag-form').fadeIn();
            $('#screenshot_tag_list').focus();
            $(this).hide();
            return false;
        }

        function hideTagForm() {
            $('#add-tag-form').hide();
            $('#add-tag-link').fadeIn();
            return false;
        }

        function deleteTag() {
            var screenshotId = $(this).modelId();
            $.post(this.href, { _method: 'delete' }, function (message, statusText) {
                if (statusText == 'success') {
                    $('#tag-li-' + screenshotId).fadeOut();
                }
            });
            return false;
        }
function GetData() {
    $.ajax({
      type: "post", 
      url: "http://taojia.sinaapp.com/index.php?c=auth&a=get_user_items",
      contentType: "application/json;charset=utf-8", 
      dataType: "json", 
      success: function (result) {
        data =result;
        
        t = " ";
        
     $(data).each(function(){
    		 
    		 t += " <tr class='user-26356'><td class='user'><h4 class='vcard'><a href='"+this.ItemUrl+"' class='url' rel='contact' title='"+this.ItemName+"'><img alt='Nb_avatar' class='photo fn' src='http://taojia.sinaapp.com/tpl/images/hp_dog.png' /> "+this.ItemName+"</a>";
             t += "<span class='user-meta'></span></h4></td><td> </td><td class='num followers'>"+this.ItemPrice+"</td></tr>";
            

             }
     );
       
        t += "";
        $("#result").html(t);
      },
      error: function (result) { alert(result.responseText); }
    });
    
    
  }
$(document).ready(function(){
	GetData();
	$("#data-table").dataTable();
	
});
</script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/jquery.jeditable.js" type="text/javascript"></script>
    <script src="http://5.taojia.sinaapp.com/tpl/default/javascripts/comments.js" type="text/javascript"></script>
    <script>
        makeCommentsDeleteable(false);
    </script>
</body>
</html>
EOT;
?>