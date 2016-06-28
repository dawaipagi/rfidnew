/*
 * Author: Adian E Putra
 * Date: 1 Aug 2014
 * Description:
 *      This is a demo file used only for the main dashboard.
 **/

$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    
    /*
	 * plugins for todo list
	 * start
	 * 
	 * */
		
		//jQuery UI sortable for the todo list
		$(".todo-list").sortable({
			update : function(){
				var order = $('.todo-list').sortable('toArray'); 
				alert("Moving todolist");
				$.post(base_url+"dashboard/todoList/move", { orders: order } );
			},
			placeholder: "sort-highlight",
			handle: ".handle",
			forcePlaceholderSize: true,
			zIndex: 999999
		}).disableSelection();;
		
		//jQuery slide toggle for todo list
		$("#jarvis-btn-todolist").click(function(){
			$("#jarvis-input-todolist").slideToggle("fast");
		});
		
		/* The todo list plugin */
		$(".todo-list").todolist({
			onCheck: function(ele) {
				var sList = "";
				$('ul.todo-list input[type=checkbox]').each(function () {
					sList += $(this).val() + "-" + (this.checked ? "true" : "false") + ",";
				});
				$.post(base_url+"dashboard/todoList/clear", { todoList: sList } );
			},
			onUncheck: function(ele) {
				var sList = "";
				$('ul.todo-list input[type=checkbox]').each(function () {
					sList += $(this).val() + "-" + (this.checked ? "true" : "false") + ",";
				});
				$.post(base_url+"dashboard/todoList/clear", { todoList: sList } );
			}
		});
	/*
	 * plugins for todo list
	 * end
	 * 
	 * */	
});
