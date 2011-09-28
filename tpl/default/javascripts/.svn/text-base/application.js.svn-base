infoFade();
prevnextFade();
thumbzoomFade();
reboundzoomFade();
multizoomFade();
initFollowPrompts();

// hide/show Search value on focus/blur

$('#search-text').focus(function() {
	if($(this).val()=="Search"){
		$(this).val("");
	}
    }).blur(function(){
		if($(this).val()==""){
		$(this).val("Search");
	}
});

/* Drop-down menus on hover */
$('#nav li').hover(
	function() { $(this).find('ul.tabs').show(); },
	function() { $(this).find('ul.tabs').hide(); }
);

/*
 * jQuery extensions
 */

// Shows the current element(s) and hides the element(s) passed or specified by selector.
jQuery.fn.showAndHide = function(elemToHide) {
	$(elemToHide).hide();
	return this.show();
}

// Returns model id parsed from element id w/ format "prefix-<id>"
jQuery.fn.modelId = function() {
	var id = $(this).attr('id');
	if (id == null) return null; // Just in case; browsers tested return empty string for missing id.

	var idParts = id.split(/[-_]/g); // Split on hyphens and underscores
	return (idParts.length > 1) ? idParts[idParts.length-1] : null;
}

/*
 * Custom libs
 */

Notify = {
	success: function(message) {
		Notify.notify('success', message);
	}, 
	error: function(message) {
		Notify.notify('error', message);
	},
	notify: function(typeOfNoticeClass, message) {
		$('.notice').hide();
		$('#ajax-message').text(message);
		$('.notice').
			removeClass().
			addClass('notice').
			addClass(typeOfNoticeClass).
			show();
	}
}

ShowAndHideControl = function(options) {
	var elemToShowAndHide = $(options['target']);
	var showTriggers = $(options['showControl']);
	var hideTriggers = $(options['hideControl']);
	
	showTriggers.
		click(function() {
			elemToShowAndHide.showAndHide(showTriggers);
			return false;
		});

	hideTriggers.
		click(function() {
			elemToShowAndHide.hide();
			showTriggers.show();
			return false;
		});
}

/*
 * Converts a number to its value in thousands (K), e.g. 12,000 => 12
 */
function toK(num) {
	return num / 1000;
}

function formatK(num) {
	return toK(num) + 'K';
}

// show screenshot info on hover
function infoFade() {	
	$('ol.dribbbles li div.dribbble-img').hover(
		function () {
        	$(this).find('a.dribbble-over').stop().fadeTo('fast', 1);
        	},
        function () {
        	$(this).find('a.dribbble-over').stop().fadeTo('fast', 0);
      	}
	);
}

// show prev/next arrows on hover
function prevnextFade() {	
	$('ol.prevnext li a').hover(
		function () {
        	$(this).find('strong').stop().fadeTo('fast', 1);
        	},
        function () {
        	$(this).find('strong').stop().fadeTo('fast', 0);
      	}
	);
}

// show zoom icon on thumbnail hover
function thumbzoomFade() {	
	$('ol.activity li div.act-shot a').hover(
		function () {
        	$(this).find('strong').stop().fadeTo('fast', 1);
        	},
        function () {
        	$(this).find('strong').stop().fadeTo('fast', 0);
      	}
	);
}

// show zoom icon on thumbnail hover
function reboundzoomFade() {	
	$('div.the-rebound div.dribbble-img').hover(
		function () {
        	$(this).find('a.dribbble-over').stop().fadeTo('fast', 1);
        	},
        function () {
        	$(this).find('a.dribbble-over').stop().fadeTo('fast', 0);
      	}
	);
}

// show zoom icon on multi thumb hover
function multizoomFade() {	
	$('ol.multi-grid li a').hover(
		function () {
        	$(this).find('strong').stop().fadeTo('fast', 1);
        	},
        function () {
        	$(this).find('strong').stop().fadeTo('fast', 0);
      	}
	);
}

function attachPlayerTooltipsToGroupShots() {
	$('ol.multi-grid li a.zoom').each(function() {
		var link = $(this);
		link.tipsy({
			gravity: 'n',
			html: true,
			title: function() { return link.closest('li').find('div.tipsy-player').html(); }
		});
	});
}

// show/hide pixel useage help
$('#pixels-help-a').click(function() {
	$('#pixels-help').slideToggle("normal");
	return false;
})

$('[rel=tipsy]').tipsy({fade: true, gravity: 's'});

/*
 * Attaches to behavior to any follow/unfollow link on the page.
 */
function initFollowPrompts() {
	$('.follow-prompt a').live('click', function() {
		var $link = $(this);
		var followPrompt = $link.closest('.follow-prompt');
		var originalHtml = followPrompt.html();
		
		$link.closest('.follow-prompt form').ajaxSubmit({
			beforeSend: function() {
				$link.addClass('processing');
				$link.find('span').text('Wait...');
			},
			success: function(responseHtml) {
				// Update to refect follow status
				$link.closest('.follow-prompt').html(responseHtml);
			},
			error: function(request) {
				followPrompt.html(originalHtml);
				alert(request.responseText);
			}
		});
		return false;
	});
}