function deleteData(url){
	bootbox.confirm("Are you sure?", function(result) {
		if(result==true){
			window.location.replace(url);
		}
	});
}
