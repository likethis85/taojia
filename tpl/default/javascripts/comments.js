ajaxifyCommentForm();
makeCommentsEditable();
makeCommentFansViewable();
initCommentsHelp();

function initCommentsHelp() {
	$('#view-comments-help-a').live('click', function() {
	  $('#comments-help').slideToggle("normal");
	  return false;
	});
}

function ajaxifyCommentForm() {
	$('#add-comment').ajaxForm({
		dataType: 'json', 
		beforeSend: function() {
			$('#post-comment-btn').attr('disabled','true').attr('value', 'Processing, please wait...');
			$('#post-comment-btn').addClass('processing');
		}, 
		success: function(json) {
			if (json.redirect_to) {
				window.location = json.redirect_to;
			}
			else {
			   $('#comments').append(json.comment);
			   $('#comments-section .count').html(json.header).show();
			   $('#add-comment textarea').val(''); // Clear the form
			   $('#post-comment-btn').attr('disabled','').attr('value', 'Post Comment');
			   $('#post-comment-btn').removeClass('processing');
			   // Not pretty, but attaches editable behavior to new comment
			   makeCommentEditable('#comment-' + json.id + ' .comment-body');
			}
		}
	});
}

function makeCommentsEditable() {
	// For each comment body, make it editable, grabbing the comment id to build urls along the way.
	$('.comment.current-user .comment-body').each(function() {
		makeCommentEditable(this);
	});

	// Launch edit mode from edit links
	$('.comment.current-user a.edit').live('click', function() { 
		$(this).closest('.comment').find('.comment-body').trigger('programmaticEvent.editable');
		return false;
	});
}

function makeCommentEditable(commentBody) {
	var jComment = $(commentBody);
	var id = jComment.closest('.comment').modelId();
	var editPath = jComment.closest('.comment').find('a.edit').attr('href');
	var updatePath = jComment.closest('.comment').find('a.delete').attr('href'); // Update path same as delete
	
	jComment.editable(updatePath, {
		loadurl: editPath, 
		type: 'textarea',
		width: 'none',
		height: 'none',
		name: 'text', 
		method : 'PUT', 
		cssclass: 'comment group', 
		id: null, 
		submit: 'Save', 
		cancel: 'Cancel', 
		tooltip: 'Click to edit.', 
		indicator: '<span class="processing">Saving...</span>',
		// Non-browser event chosen so field is not editable by clicking inline; it is only made editable programmatically (by edit link).
		event: 'programmaticEvent.editable',
		onblur: 'ignore'
	});
}

// Called by template and ps
function makeCommentsDeleteable(isShotOwner) {
	// Shot owner can delete any comment. Comment owners can delete their own.
	var commentSelectorPrefix = isShotOwner ? '.comment' : '.comment.current-user';
	$(commentSelectorPrefix + ' a.delete').live('click', function() {
		var confirmed = confirm('You are about to delete this comment. Continue?');
		if (!confirmed) return false;
		
		var jlink = $(this);
		$.post(this.href, {_method: 'delete'}, function(json) {
			var header = $('#comments-section .count');
			if (json.count == 0) { header.hide(); }
			header.html(json.header);
			jlink.closest('.comment').remove();
		}, 'json');
		return false;
	});
}

function makeCommentFansViewable() {
	$('.comment .likes-list').live('click', function() {
		$commentContainer = $(this).closest('.comment');
		$likesContainer = $commentContainer.find('.comment-likes');
		
		if ($likesContainer.length) {
			// Likes are already displayed, so toggle them off.
			$likesContainer.remove();
		}
		else { // Show likes
			$.get(this.href, function(html) {
				$commentContainer.append(html);
			});
		}
		
		return false;
	});
}
