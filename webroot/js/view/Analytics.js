$(document).ready(function(){

	$(".analytics_select td > p").addClass("select_color");

	var selectAction = $("#selectAction").val();

	$(".analytics_select td > p").each(function(){
		 if($(this).attr("id") == selectAction)
			 $(this).addClass("active_color");
    });

	var seCd = $("#seCd").val();
	var seDay = $("#seDay").val();
	var rcNum = $("#rcNum").val();
	var param = "?seCd=" + seCd + "&seDay=" + seDay + "&rcNum=" + rcNum;

	$("#analytics").click(function() 	{analyticsLocation('analytics', param);});
	$("#information").click(function() 	{analyticsLocation('information', param);});
	$("#recent").click(function()	 	{analyticsLocation('recent', param);});
	$("#current").click(function() 		{analyticsLocation('current', param);});
	$("#season").click(function() 		{analyticsLocation('season', param);});
	$("#before").click(function() 		{analyticsLocation('before', param);});

	var hovers =	"  .full" +
					", .divide" +
					", .race_numbers p";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});

	$(".race_numbers p").click(function() {
		var selectAction = $("#selectAction").val();
		var selectRcNum = $(this).attr("id");
		var param = "?seCd=" + seCd + "&seDay=" + seDay + "&rcNum=" + selectRcNum;
		window.location.href = './' + selectAction + param;

		loadingView(true);
	});

});

function analyticsLocation(action, param){
	window.location.href = './' + action + param;
	loadingView(true);
}
