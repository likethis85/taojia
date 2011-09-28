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
<body id="details" >
    <div id="header" class="group">
        <div id="header-inner" class="group">
            <div id="logo">
                <a href="/">
                    <img alt="dribbble" src="@Href("http://5.taojia.sinaapp.com/tpl/default/images/logo-bw.gif")" /></a>
            </div>
            <div id="dashboard">
                 <li id="t-signin"><a href="{$aurl}" title="登录以后可以看到自己收藏的商品，更多功能陆续推出！"><img src="http://www.sinaimg.cn/blog/developer/wiki/32.png"/></a></li>
           
            </div>
            <ul id="nav">
           
              
                
             
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
						<a href="javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://taojia.sinaapp.com/index.php?c=item&a=recommend&url='+e(d.location.href)+'&title='+e(d.title)+'&sel='+e(s)+'&v=1',x=function(){if(!window.open(r,'taojia','toolbar=0,resizable=1,scrollbars=yes,status=1,width=850,height=450'))location.href=r+'&r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()">
									
									<strong class="title">	淘价313</strong>

							</a> 
					</div>
				</div>
                <div id="main">
                   <iframe src="http://www.screenr.com/embed/dcAs" width="650" height="396" frameborder="0"></iframe>
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
                <p>Support by <a href="http://weibo.com/magicshui">@magicshui</a>|Running On <a href="http://sae.sina.com.cn" target="_blank"><img src="http://sae.sina.com.cn/static/image/poweredby/117X12px.gif" title="Powered by Sina App Engine" /></a>|<a href="http://taojia.sinaapp.com/index.php?c=main&a=about">关于</a></p>
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