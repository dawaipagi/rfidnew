/*
 * Author: Adian E Putra
 * Date: 18 Aug 2015
 * 
 **/

$(function() {
	$("#ser_op").on("change", function() {
		$("#ser_code").val($(this).find("option:selected").attr("value"));
	});
	$("#example1").dataTable({
		"bPaginate": true,
		"bLengthChange": true,
		"bFilter": false,
		"bSort": true,
		"bInfo": true,
		"bAutoWidth": true
	});
});
