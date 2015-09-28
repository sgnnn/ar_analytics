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

	$("#analytics").click(function() 	{window.location.href = './analytics' + param; loadingView(true);});
	$("#information").click(function() 	{window.location.href = './information' + param;});
	$("#recent").click(function()	 	{window.location.href = './recent' + param;});
	$("#current").click(function() 		{window.location.href = './current' + param;});
	$("#holding").click(function() 		{window.location.href = './holding' + param;});
	$("#season").click(function() 		{window.location.href = './season' + param;});
	$("#before").click(function() 		{window.location.href = './before' + param;});
	$("#grade").click(function() 		{window.location.href = './grade' + param;});

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

		if(selectAction == "analytics")
			loadingView(true);
	});

});