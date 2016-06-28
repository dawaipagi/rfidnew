/*
 * Author: Adian E Putra
 * Date: 11 Aug 2014
 * Description: load data from database for dashboard
 * 
 **/

$(function() {
	// DATE PICKER
	$('.jarvisdatepicker').datepicker();
	// DATE MASK
	//$("#datemask").inputmask("dd/mm/yyyy");
	//$("[data-mask]").inputmask();
	// Red color scheme for iCheck
	$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	});
});
