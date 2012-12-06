$(function(){
	$('#form-validate-id').submit(function(e){
		e.preventDefault();
		var form = $(this);
		
		var url = ajax_url($(this).attr('action'));
		
		// Search for student by ID
		$('#checkin-result').fadeOut(100,function(){
			// Send an AJAX post request
			$.post(url,form.serialize(),function(data){
				$('#checkin-result').html(data).slideDown(100);
				$('#student_number').val('');
				$('[name=student_firstname]').focus();
			});
		});
	});
	
	// Capture click of remove buttons
	$('[data-action=remove]').live('click',function() {
		var sel = $(this).attr('data-target');
		var elm = $(this).closest(sel);
		elm.slideUp(function(){elm.remove();});
	});

	// Capture hover over student
	$('ul.students li a').hover(
		function(){$(this).addClass('hover');},
		function(){$(this).removeClass('hover');}
	);

	// Capture checkout button click
	$('ul.students button.checkout').click(function(){
		// Get student info
		var li = $(this).closest('li');
	 	var session_id = li.attr('data-session-id');
	 	var student_id = li.attr('data-student-id');
	 	var student_name = li.attr('data-student-name');
	 	show_checkout_form(session_id,student_id,student_name);
	});
});

/**
 * AJAXify the given url
 */
function ajax_url(url) {
	return url + (url.indexOf('?') < 0 ? '?' : '&') + 'ajax=true';
}

/**
 * Display a checkout modal with the given student data
 */
 function show_checkout_form(session_id,student_id,student_name) {
 	var form = 	'<div class="modal hide fade">';
 	form +=			'<div class="modal-header">';
 	form +=			'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
 	form +=				'<h3>Checkout ' + student_name + '</h3>';
 	form +=			'</div>';
 	form +=			'<div class="modal-body">';
	form +=				'<form class="form" action="./?action=checkout" method="post">';
	form +=					'<input type="hidden" name="student_id" value="' + student_id + '"/>';
	form +=					'<input type="hidden" name="session_id" value="' + session_id + '"/>';
	form +=					'<label for="session_notes">Notes</label>';
	form +=					'<textarea rows="3" cols="83" name="session_notes"></textarea>';
	form +=					'<label for="teacher_id">Teacher</label>';
	form +=					'<select name="teacher_id">';

	form +=					'</select>';
	form +=				'</form>';
	form +=			'</div>';
	form +=			'<div class="modal-footer">';
	form +=				'<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
    form +=				'<button class="btn btn-primary">Checkout</button>';
	form +=			'</div>';
	form +=		'</div>';

	var modal = $(form);
	modal.on('hidden',function(){$(this).remove();});
	$('body').append(modal);
	modal.modal();
	modal.on('hidden',function(){
		$(this).remove();
	});
 }