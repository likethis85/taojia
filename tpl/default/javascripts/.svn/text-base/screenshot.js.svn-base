// Flag screenshot as inappropriate
$(".admin a.flag").click(flag);
function flag() {
	var link = $(this);
	var screenshotId = link.modelId();
	if(!confirm("Are you sure you want to flag this shot?"))
		return false;

	$.ajax({
		type: 'POST', 
		url: this.href, 
		data: {
			screenshot_id: screenshotId
		}, 
		success: function(responseHtml) {
			$('#flag-section').html(responseHtml);
			$(".admin a.unflag").click(unflag);
		}
	});
	
	return false;
}

$(".admin a.unflag").click(unflag);
function unflag() {
	var link = $(this);
	var screenshotId = link.modelId();
	$.ajax({
		type: 'POST', 
		url: this.href, 
		data: {
			_method: 'delete', 
			screenshot_id: screenshotId
		}, 
		success: function(responseHtml) {
			$('#flag-section').html(responseHtml);
			$(".admin a.flag").click(flag);
		}
	});
	
	return false;
}

// Like or unlike a screenshot
$(".fav a.fav-toggle").live('click', toggleLike);
function toggleLike() {
	var link = $(".fav a.fav-toggle");
	var screenshotId = $('.fav a.fav-toggle').modelId();
	var heart = $("#screenshot-" + screenshotId + " .fav");
	$.ajax({
		type: 'POST', 
		url: $('.fav a.fav-toggle').attr('href'), 
		data: {
			screenshot_id: screenshotId
		}, 
		beforeSend: function() {
			$('.fav-toggle').addClass('processing');
			link.text('Wait...');
		}, 
		success: function(responseHtml) {
			$('#like-section').replaceWith(responseHtml);
		}
	});
	
	return false;
}

// Keyboard shortcut for faving screenshot
$(document).keydown(handleKey);
function handleKey(e){
	var f_key = 70;
	var l_key = 76;
	var left_arrow = 37;
	var right_arrow = 39;

	if (e.target.localName == 'body' || e.target.localName == 'html') {
		if (!e.ctrlKey && !e.altKey && !e.shiftKey && !e.metaKey) {
			var code = e.which;
			if (code == f_key || code == l_key){
        if($('.logged-in').length > 0)
				  toggleLike();
      } else if (code == left_arrow){
				prevShot();
      } else if (code == right_arrow){
				nextShot();
      }
		}
	}
}

function nextShot() {
	var href = $('#secondary .prevnext:first .next a').attr('href');
	if (href && href != document.location)
		document.location = href;
}

function prevShot() {
	var href = $('#secondary .prevnext:first .prev a').attr('href');
	if (href && href != document.location)
		document.location = href;
}

// Like or unlike a comment
$(".comment a.likes").live('click', function() {
	var $link = $(this);
	var data = $link.hasClass('liked-by-current-user') ? {_method: 'delete'} : null;
	$.ajax({
		type: 'POST',
		url: this.href,
		data: data,
		success: function(responseHtml) {
			$link.closest('.comment').replaceWith(responseHtml);
		}
	});
	
	return false;
});
