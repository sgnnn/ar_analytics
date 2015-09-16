$(document).ready(function(){

	$(".analytics_select td > p").addClass("select_color");

	var selectAction = $("#selectAction").val();

	$(".analytics_select td > p").each(function(){
		 if($(this).attr("id") == selectAction)
			 $(this).addClass("active_color");
    });

	$("#analytics").click(function() 	{window.location.href = './analytics';});
	$("#information").click(function() 	{window.location.href = './information';});
	$("#recent").click(function()	 	{window.location.href = './recent';});
	$("#current").click(function() 		{window.location.href = './current';});
	$("#holding").click(function() 		{window.location.href = './holding';});
	$("#season").click(function() 		{window.location.href = './season';});
	$("#before").click(function() 		{window.location.href = './before';});
	$("#grade").click(function() 		{window.location.href = './grade';});

	var hovers =	"  .full" +
					", .divide";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});



});