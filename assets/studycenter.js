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
				$('input[name=course_name]').typeahead({source:course_names,updater:course_updater});
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
	 	var course_name = get_course_name(li.attr('data-course-id'));
	 	show_checkout_form(session_id,student_id,student_name,course_name);
	});

	// Capture grade button click
	$('ul.students button.grade').click(function(){
		// Get student info
		var li = $(this).closest('li');
	 	var session_id = li.attr('data-session-id');
	 	var student_id = li.attr('data-student-id');
	 	var student_name = li.attr('data-student-name');
	 	var course_id = li.attr('data-course-id');
	 	var course_name = get_course_name(course_id);
	 	show_grade_form(session_id,student_id,student_name,course_id,course_name);
	});

	// Capture the enter key in forms
	$('.modal form').live('keypress', function(e) {
	    if (e.keyCode == 13 && e.target.type != "textarea") {
	    	$(this).submit();
	    	e.preventDefault();
	    }
	});

	// Activate tooltips
	$('[data-toggle=tooltip]').tooltip();
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
 function show_checkout_form(session_id,student_id,student_name,course_name) {
 	var form = 	'<div class="modal hide fade">';
 	form +=			'<div class="modal-header">';
 	form +=			'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
 	form +=				'<h3>' + student_name + '<span>Checkout</span></h3>';
 	form +=			'</div>';
 	form +=			'<div class="modal-body">';
	form +=				'<form id="form-checkout" class="form" action="./?action=checkout" method="post">';
	form +=					'<input type="hidden" name="student_id" value="' + student_id + '"/>';
	form +=					'<input type="hidden" name="session_id" value="' + session_id + '"/>';
	form +=					'<input type="hidden" name="student_name" value="' + student_name + '"/>';
	form +=					'<input type="text" name="teacher_name" placeholder="TEACHER" autocomplete="off"/>';
	form +=					'<input type="hidden" name="teacher_id"/>';
	form +=					'<div class="pull-right course-name">' + course_name + '</div>';
	form +=					'<textarea rows="4" name="session_notes" placeholder="NOTES"></textarea>';
	form +=				'</form>';
	form +=			'</div>';
	form +=			'<div class="modal-footer">';
	form +=				'<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
    form +=				'<button type="submit" class="btn btn-primary">Checkout</button>';
	form +=			'</div>';
	form +=		'</div>';

	var modal = $(form);
	$('body').append(modal);
	modal.find('input[name=course_name]').typeahead({source:course_names,updater:course_updater});
	modal.find('input[name=teacher_name]').typeahead({source:teacher_names,updater:teacher_updater});
	modal.modal();
	
	modal.on('hidden',function(){
		$(this).remove();
	});

	// Force checkout button to submit form
	modal.find('button[type=submit]').click(function(){
		$('#form-checkout').submit();
	});

	// Capture form submission
	modal.find('form').submit(function(){
		// Validate course, teacher & notes
		if( $(this).find('input[name=course_name]').val() == '' || 
			$(this).find('input[name=teacher_name]').val() == '' || 
			$(this).find('input[name=course_id]').val() == '' || 
			$(this).find('input[name=teacher_id]').val() == '' || 
			$(this).find('textarea[name=session_notes]').val() == '') {
			return false;
		} else {
			return true;
		}
	});
}

/**
 * Display a grade modal with the given student data
 */
 function show_grade_form(session_id,student_id,student_name,course_id,course_name) {
 	var form = 	'<div class="modal hide fade">';
 	form +=			'<div class="modal-header">';
 	form +=				'<button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
 	form +=				'<h3>' + student_name + '<span>Enter Grade</span></h3>';
 	form +=			'</div>';
 	form +=			'<form action="./?action=add_grade" method="post">';
 	form +=				'<div class="modal-body">';
	form +=					'<input type="hidden" name="student_id" value="' + student_id + '"/>';
	form +=					'<input type="hidden" name="student_name" value="' + student_name + '"/>';
	form +=					'<input type="hidden" name="course_id" value="' + course_id + '"/>';
	form +=					'<input type="hidden" name="session_id" value="' + session_id + '"/>';
	form +=					'<input type="number" name="grade_percent" step="any" placeholder="grade percent" autocomplete="off"/>';
	form +=					'<div class="pull-right course-name">' + course_name + '</div>';
	form +=				'</div>';
	form +=					'<div class="modal-footer">';
	form +=					'<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
    form +=					'<input type="submit" class="btn btn-primary" value="Enter grade" />';
	form +=				'</div>';
	form +=			'</form>';
	form +=		'</div>';

	var modal = $(form);
	$('body').append(modal);
	modal.modal();
	
	modal.on('hidden',function(){
		$(this).remove();
	});

	// Capture form submission
	modal.find('form').submit(function(){
		// Validate course, teacher & notes
		if( $(this).find('input[name=student_id]').val() == '' || 
			$(this).find('input[name=session_id]').val() == '' || 
			$(this).find('input[name=grade_percent]').val() == '' || isNaN($(this).find('input[name=grade_percent]').val())) {
			return false;
		} else {
			return true;
		}
	});
}

/**
 * Function to call upon choosing a typeahead suggestion for the course name
 */
function course_updater(item) {
	$('input[name=course_name]').val(item);
	$('input[name=course_id]').val(course_ids[course_names.indexOf(item)]);
	return item;
}

/**
 * Function to call upon choosing a typeahead suggestion for the teacher name
 */
function teacher_updater(item) {	
	$('input[name=teacher_name]').val(item);
	$('input[name=teacher_id]').val(teacher_ids[teacher_names.indexOf(item)]);
	return item;
}

function get_course_name(id) {
	var index = -1;
	for(var i = 0; i < course_ids.length; i++) {
		if(course_ids[i] == id) {
			index = i;
			break;
		}
	}
	return course_names[index];
}