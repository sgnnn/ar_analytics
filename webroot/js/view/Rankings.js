$(document).ready(function(){

	var hovers = 	"  .category_select a" +
					", .racer_rank_select a" +
					", .period_select a";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});

});

function setCategory(category){
	$("#category").val(category);
	execLocation();
}

function setRacerRank(racerRank){
	$("#racerRank").val(racerRank);
	execLocation();
}

function setPeriod(period){
	$("#period").val(period);
	execLocation();
}

function execLocation(){
	var category  = $("#category").val();
	var racerRank = $("#racerRank").val();
	var period    = $("#period").val();
	var param = "?category=" + category + "&racerRank=" + racerRank + "&period=" + period;
	window.location.href = './Rankings' + param;
}