/*
 * Author: Adian E Putra
 * Date: 11 Aug 2014
 * Description: load data from database for dashboard
 * 
 **/

$(function() {
	var todoListData = '';
	var x='';
	//jQuery load todo list
	//$(".todo-list").append(base_url+"dashboard/todoList/read");
	$.get(base_url+"dashboard/todoList/read", function (response) {
		$.each(response.data, function(i,item){
			todoListData +='<li id="todolist_'+item.id+'">  <!-- drag handle -->  <span class="handle">  <i class="fa fa-ellipsis-v"></i>  <i class="fa fa-ellipsis-v"></i>  </span> <!-- checkbox -->  <input type="checkbox" value="" name="">  <!-- todo text -->  <span class="text">'+item.text+'</span>  <!-- Emphasis label -->  <small class="label label-info"><i class="fa fa-clock-o"></i> 16 hours</small>  <!-- General tools such as edit or delete-->  <div class="tools">  <i class="fa fa-edit"></i>  <i class="fa fa-trash-o"></i>  </div>  </li> ';
		});
		//$(".todo-list").append(todoListData);
		//return todoListData;
		//console.log(todoListData);
		//x =todoListData.text();
	}, "json");
	//$(".todo-list").append(todoListData);
});
