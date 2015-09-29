$(document).ready(function(){

	$(".select_day").text(convertStringDate($(".select_day").text()));

	var hovers =	"#analytics_start," +
					".select_lg .lg_color_1," +
					".select_lg .lg_color_2," +
					".select_lg .lg_color_3," +
					".select_lg .lg_color_4," +
					".select_lg .lg_color_5," +
					".select_lg .lg_color_6";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});

	var lgs = 	".select_lg .lg_color_1," +
				".select_lg .lg_color_2," +
				".select_lg .lg_color_3," +
				".select_lg .lg_color_4," +
				".select_lg .lg_color_5," +
				".select_lg .lg_color_6";

	$(lgs).click(function() {
		$(".series_days p ").remove();
		$(".race_numbers p ").remove();
		$(".select_race_please").hide();
		$(".series_data").hide();
		$(".race_data").hide();
		$(".select_please").slideDown();

		var seCd = $(this).attr("id");

		execGet("Todays/selectSeries", {seCd: seCd},
			{success : function(response){
				if(response.status) {
	        		var RSeries = response.RSeries;
	        		$(".series_lg").text(convertLgName(RSeries['LG_CD']));
	        		$(".series_rank").text(convertSeRankName(RSeries['SE_RANK_CD']));
	        		$(".series_name").text(RSeries['SE_TITLE']);

	        		for(var i=0; i<RSeries['SE_DAYS']; i++){
	        			if(i == RSeries['END_DAYS'])
	        				$(".series_days").append($("<p/>").addClass("today").text(addDay(RSeries['SE_START_YMD'], i)));
	        			else
	        				$(".series_days").append($("<p/>").text(addDay(RSeries['SE_START_YMD'], i)));
	        		}

	        		var seDay = eval(RSeries['END_DAYS']) + 1;

	        		for(var i=1; i<=response.rcCount; i++){
	        			$(".race_numbers").append($("<p/>").attr("id", RSeries['SE_CD']+seDay+i).text(i+"R"));
	        			if(i == 6)
	        				$(".race_numbers").append($("<div/>"));
	        		}

	        		$(".select_please").hide();
		    		$(".series_data").slideDown("slow");
		    		$(".select_race_please").slideDown("slow");
	        	}
			}
		});
	});

	$("#analytics_start").click(function() {
		var seCd = $("#seCd").val();
		var seDay = $("#seDay").val();
		var rcNum = $("#rcNum").val();
		window.location.href = "./Analytics/analytics?seCd=" + seCd + "&seDay=" + seDay + "&rcNum=" + rcNum;
		loadingView(true);
	});

});

$(document).on('click', '.race_numbers p',function(){
	$(".select_race_please").hide();
	$(".race_numbers p").removeClass("select");
	$(this).addClass("select");
	$(".race_data").hide();

	$(".recers div").remove();

	var id = $(this).attr("id");
	var seCd = id.substring(0,7);
	var seDay = id.substring(7,8);
	var rcNum = id.substring(8)

	execGet("Todays/selectRaceAndRecodes", {seCd: seCd, seDay: seDay, rcNum: rcNum},
		{success : function(response){
			if(response.status) {
				var RRace = response.RRace;
	    		$(".race_type").text(RRace['RC_TYPE_NM']);
	    		$(".distance").text(convertDistance(RRace['DISTANCE']));

	    		var RRecodes = response.RRecodes;
	    		for (var i in RRecodes) {
	    			var RRecode = RRecodes[i]["R_RECODE"];
	    			var RRecer = RRecodes[i]["R_RACER"];

	    			var rank = RRecer['RANK_NEW'].substring(0,1);

	    			var recer = $('<div/>').addClass("recer");
	    			recer.append($('<div/>').addClass("waku_color_" + RRecode["WAKU_NUM"]).text(RRecode["WAKU_NUM"]));
	    			recer.append($('<div/>').text(RRecode["HANDE"]));
	    			recer.append($('<div/>').text(RRecer["RR_NM"]));
	    			recer.append($('<div/>').addClass(rank+"_class").text(RRecer['RANK_NEW']));
	    			recer.append($('<div/>').addClass("lg_color_"+RRecer['LG_CD']).text(convertLgName(RRecer['LG_CD'])));
	    			recer.append($('<div/>').text(RRecer['KI']+"期"));

	    			$('.recers').append(recer);
	    		}

	    		$('.recer').colorbox({
	    			inline:true,
	    			maxWidth:"90%",
	    			maxHeight:"90%",
	    			opacity: 0.7,
	    			href:"#inline-racer"
	    		});

	    		$(".race_data").slideDown("slow");
	    	}
		}
	});

	$("#seCd").val(seCd);
	$("#seDay").val(seDay);
	$("#rcNum").val(rcNum);
});

$(document).on({
	"mouseenter": function(){$(this).stop().animate({ opacity: "0.5" }, 200);},
	"mouseleave": function(){$(this).stop().animate({ opacity: "1.0" }, 500);}
}, ".recers div, .race_numbers p");
