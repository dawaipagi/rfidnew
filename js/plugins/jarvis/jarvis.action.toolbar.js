function deleteDataForm(url,tabel,key,redirect){
	var blkstr = [];
	var checkValue=$('input.checkValue:checked');
	var checkedVal=checkValue.serialize();
	if(checkedVal==''){
		bootbox.alert('Pilih dahulu!');
	}else{
		bootbox.confirm("Apakah anda yakin menghapus data ini?", function(result) {
			if(result==true){
				checkValue.each(function() {
					blkstr.push(this.value)
				});
				$.post( url, { checkedVal: blkstr.join(","), tabelDef:tabel, pk:key }, function( response ) {
					if(response.success=='true'){
						window.location.replace(redirect);
					}else{
						bootbox.alert(response.message);
					}
				}, "json");
			}		
		});
	}
}
function updateDataForm(url){
	var checkedVal=$('input.checkValue:checked').serialize();
	var checkedCount=$('input.checkValue:checked').length;
	if(checkedVal==''){
		bootbox.alert('Pilih dahulu!');
	}else if(checkedCount>1){
		bootbox.alert('Pilih salah satu saja!');
	}else{
		var valEdit = $('input.checkValue:checked')[0].value;
		window.location.replace(url+valEdit);
	}
}
function revisiDataForm(url){
	var blkstr = [];
	var checkValue=$('input.checkValue:checked');
	var checkedVal=checkValue.serialize();
	if(checkedVal==''){
		bootbox.alert('Pilih dahulu!');
	}else{
		bootbox.confirm("Apakah anda yakin merevisi data ini?", function(result) {
			if(result==true){
				checkValue.each(function() {
					blkstr.push(this.value)
				});
				$.post( url, { checkedVal: blkstr.join(",") }, function( response ) {
					if(response.success=='true'){
						window.location.replace(response.url);
					}else{
						bootbox.alert(response.message);
					}
				}, "json");
			}		
		});
	}
}
function revisiDataForm(url){
	var blkstr = [];
	var checkValue=$('input.checkValue:checked');
	var checkedVal=checkValue.serialize();
	if(checkedVal==''){
		bootbox.alert('Pilih dahulu!');
	}else{
		bootbox.confirm("Apakah anda yakin memproses data ini?", function(result) {
			if(result==true){
				checkValue.each(function() {
					blkstr.push(this.value)
				});
				$.post( url, { checkedVal: blkstr.join(",") }, function( response ) {
					if(response.success=='true'){
						window.location.replace(response.url);
					}else{
						bootbox.alert(response.message);
					}
				}, "json");
			}		
		});
	}
}
function moveExcelData(url){
	var blkstr = [];
	var checkValue=$('input.checkValue:checked');
	var checkedVal=checkValue.serialize();
	if(checkedVal==''){
		bootbox.alert('Pilih dahulu!');
	}else{
		bootbox.confirm("Apakah anda yakin memproses data ini?", function(result) {
			if(result==true){
				checkValue.each(function() {
					blkstr.push(this.value)
				});
				$.post( url, { checkedVal: blkstr.join(",") }, function( response ) {
					if(response.success=='true'){
						window.location.replace(response.url);
					}else{
						bootbox.alert(response.message);
					}
				}, "json");
			}		
		});
	}
}
