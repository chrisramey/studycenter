$(function(){
	$('#form-validate-id').submit(function(e){
		e.preventDefault();
		var form = $(this);
		
		var url = ajax_url($(this).attr('action'));
		
		$('#checkin-result').fadeOut(100,function(){
			// Send an AJAX post request
			$.post(url,form.serialize(),function(data){
				$('#checkin-result').html(data).fadeIn(100);
				$('#student_number').val('');
			});
		});
	});
	
	$('[data-action=remove]').live('click',function() {
		var sel = $(this).attr('data-target');
		var elm = $(this).closest(sel);
		elm.slideUp(function(){elm.remove();});
	});
});

/**
 * AJAXify the given url
 */
function ajax_url(url) {
	return url + (url.indexOf('?') < 0 ? '?' : '&') + 'ajax=true';
}