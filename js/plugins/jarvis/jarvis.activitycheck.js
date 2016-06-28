function nowTime() {
	return new Date().getTime();
}
function check_activity(){
	var interval=10*60*1000;
	$.get(base_url+"check_activity", function (response) {
		$.each(response.data, function(i,item){
			//console.log(item.last_activity);
			var timeActivity=item.last_time_activity;
			var avtivityDuration=nowTime()-timeActivity;
			if(avtivityDuration>interval){
				window.location.replace(base_url+"lock_screen");
			}else{
				console.log('Masih aktif Gan');
			}
		});
	}, "json");
}
setInterval('check_activity()', 1*60*1000);
