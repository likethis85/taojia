<?php 
print <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Qridddle</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=1000" />
    <link rel="shortcut icon" href="http://5.taojia.sinaapp.com/tpl/default/images/favicon.ico")" type="image/x-icon"> 
    <!--[if gte IE 7]><!-->
    <link href="http://5.taojia.sinaapp.com/tpl/default/stylesheets/master.css")" media="screen, projection" rel="stylesheet" type="text/css" />
    <link href="http://5.taojia.sinaapp.com/tpl/default/stylesheets/jquery.Jcrop.css")" media="screen, projection" rel="stylesheet" type="text/css" />
    <!-- <![endif]-->

</head>
<body id="details">
    <div id="header" class="group">
        <div id="header-inner" class="group">
            <div id="logo">
                <a href="/">
                    <img alt="dribbble" src="@Href("http://5.taojia.sinaapp.com/tpl/default/images/logo-bw.gif")" /></a>
            </div>
            <div id="dashboard">
                <form id="search" action="/search">
                <input id="search-text" type="text" name="q" value="Search" />
                <input id="search-btn" type="image" src="@Href("http://5.taojia.sinaapp.com/tpl/default/images/btn-search-go.gif")" alt="Go" />
                </form>
            </div>
            <ul id="nav">
           
                <li id="t-signin">
                {$username}
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

<div id="result"> 

</div>

    <div class="page">
    <div class="pagination"><a href=""class = "next_page">pre</a>
	<a class = "next_page">next</a></div>
    <!--<div class="pagination"> <a href="#'" tppabs="#" class="next_page" rel="next">Older &raquo;</a></div>-->
</div>
                </div>
                <!-- /main -->
                <div id="secondary">
                	<div class="ad-top-wrap">
    					<div class="ad last group">
       						 <a href="/site/advertise" class="flag">Ads by Qridddle</a> <a href="@Model.Url">
          					  <img alt="advertisement" src="@Href("~/Ads/")@Model.Image" />
           					 <strong>@Model.Description</strong><em>@Model.Description</em> </a>
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
                <img alt="illustration" src="/Content/images/ball-46.png" />
                <strong>11,488,781,187</strong> pixels qridddle
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
      url: "http://5.taojia.sinaapp.com/index.php?c=auth&a=get_user_items",
      contentType: "application/json;charset=utf-8", 
      dataType: "json", 
      success: function (result) {
        data =result;
        
        t = " <ol class='dribbbles group'>";
        
     $(data).each(function(){
    		 
    		 t += "<li id='screenshot-142699' class='group third'> <div class='dribbble'><div class='dribbble-shot'><div class='dribbble-img'><a href='";
             t += this.ItemPic + "' class='dribbble-link'><img alt=";
             t += this.ItemName +"src='"+this.ItemPic;
             t+= " '/></a> <a href='' class='dribbble-over'><strong>";
             t+="</strong> <span class='dim'>400 &#215; 300</span>";
             t += "<td>" + this.ItemPrice + "</td>";
             t += "<td>" + this.ItemUrl+ "</td> (120,000 pixels) <em>@item.CreatedTime</em> </a></div>";
             t += "</div><div class='extras'></div></div><h2><a href='/bandito_design_co' class='url' rel='contact' title='Ryan Brinkerhoff'><img alt='' class='photo fn' src='";
             t+=this.ItemPic+"' /></a></h2><ol>";

             }
     );
       
        t += " </ol>";
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