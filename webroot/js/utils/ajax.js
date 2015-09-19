function execGet(action, datas, arg){
	$base = {
        url: action,
        type: "GET",
        dataType: "json",
        data: datas,
        beforeSend: function(){

        },
        success : function(response){
        	if(response.status) {
        		alert("success");
        	} else{
        		alert(response.error['message']);
        	}
        },
        error: function(){
            alert('通信処理に失敗しました');
        },
        complete: function(){

        }
    };

	var opt = $.extend({}, $base, arg);

	return $.ajax(opt);
}
