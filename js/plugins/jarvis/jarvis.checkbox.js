/*
 * Author: Adian E Putra
 * Date: 24 Aug 2015
 * 
 **/
$(function () {
    var checkAll = $('input.checkAll');
    var checkboxes = $('input.checkValue');	
    var checkToggleEdit = $('input.toggleEdit');	
    checkAll.on('ifChecked ifUnchecked', function(event) {  
		var checkboxes = $('input.checkValue');      
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
        alwaysCheck(checkAll,checkboxes);
    });
    
    /*Start for registrasi form*/
    checkToggleEdit.on('ifChecked ifUnchecked', function(event) {  
		var formEle = $('.formReg');      
        if (event.type == 'ifChecked') {
            formEle.removeAttr('disabled');
        } else {
            formEle.attr('disabled',true);
        }
    });
    /*End for registrasi form*/
});

function alwaysCheck(checkAll,checkboxes){
	checkboxes.on('ifChanged', function(event){
		if(checkboxes.filter(':checked').length == checkboxes.length) {
			checkAll.prop('checked', 'checked');
		} else {
			checkAll.prop('checked', false);
		}
		checkAll.iCheck('update');
	});
} 
