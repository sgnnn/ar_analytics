$(document).ready(function(){

	var hovers = 	"  .race_select" +
				 	", .race_analytics a";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});

	$(".race_select").click(function() {
		var race_area = $(this).parent(".race_area");
		var day_selects = race_area.children(".day_selects");
		var select_days_please = race_area.children(".select_days_please");
		var race_datas = race_area.children(".race_datas");

		var seCd = $(this).attr("id");

		if(day_selects.css('display') == 'none'){
			$(day_selects.children("a")).remove();

			execGet("Todays/selectSeries", {seCd: seCd},
				{success : function(response){
					if(response.status) {
						var RSeries = response.RSeries;
		        		for(i = 1; i <= RSeries["END_DAYS"]; i++){
		        			if(RSeries["END_DAYS"] == 0)
		        				continue;

		    				var date = addDay(RSeries["SE_START_YMD"], i-1);
		    				day_selects.append($('<a/>').attr("id", RSeries["SE_CD"] + i).text(date));

		    				$(select_days_please).slideDown("slow");
		    				$(day_selects).slideDown("slow");
		    			}
		        	}
				}
			});
		} else{
			$(race_datas).hide("slow");
			$(select_days_please).hide("slow");
			$(day_selects).hide("slow");
		}
	});

	$('.race_analytics a').colorbox({
		inline:true,
		maxWidth:"90%",
		maxHeight:"90%",
		opacity: 0.7
	});

	$("#analytics1").click(function() {
		createChartAnalytics1();
	});

	$("#analytics2").click(function() {
		createChartAnalytics2();
	});

	$("#analytics3").click(function() {
		createChartAnalytics3();
	});
});

$(document).on('click', '.day_selects a',function(){
	$('.day_selects a').css({"background-color":"#CCCCCC"});
	$(this).css({"background-color":"#000000"});

	var day_selects = $(this).parent(".day_selects");
	var race_area = day_selects.parent(".race_area");
	var race_datas = race_area.children(".race_datas");
	var select_days_please = race_area.children(".select_days_please");

	var id = $(this).attr("id");
	var seCd = id.substring(0,7);
	var seDay = id.substring(7,8);

	race_datas.children(".race_list").remove();

	var list = $('<div/>').addClass("race_list");

	execGet("RecentRaces/findRacesAnd3rdRacers", {seCd: seCd, seDay: seDay},
		{success : function(response){
			if(response.status) {
				var RRaces = response.RRaces;

        		for(var i=0; i<RRaces.length; i++){
        			var RRace = RRaces[i];

        			var manken = "1" == RRace["MANKEN_K"] ? "高配当" : "";

        			var recode = $('<div/>').addClass("race_recode").attr("id", id + addZero(RRace["RC_NUM"]));
        			recode.append($('<div/>').text(RRace["RC_NUM"]+"R"));
        			recode.append($('<div/>').text(convertRunwayName(RRace["RUNWAY_K"])));
        			recode.append($('<div/>').text(RRace["RUNWAY_HEAT"]+"℃"));
        			recode.append($('<div/>').addClass("waku_color_" + RRace["RANK1_WAKU_NUM"]).text(RRace["RANK1_WAKU_NUM"]));
        			recode.append($('<div/>').text(RRace["RANK1_RR_NM"]));
        			recode.append($('<div/>').addClass("waku_color_" + RRace["RANK2_WAKU_NUM"]).text(RRace["RANK2_WAKU_NUM"]));
        			recode.append($('<div/>').text(RRace["RANK2_RR_NM"]));
        			recode.append($('<div/>').addClass("waku_color_" + RRace["RANK3_WAKU_NUM"]).text(RRace["RANK3_WAKU_NUM"]));
        			recode.append($('<div/>').text(RRace["RANK3_RR_NM"]));

        			if(manken == "")
        				recode.append($('<div/>').text(manken).css({"display":"none"}));
        			else
        				recode.append($('<div/>').text(manken));

        			list.append(recode);
        		}

        		race_datas.append(list);

        		$('.race_recode').colorbox({
        			inline:true,
        			maxWidth:"90%",
        			maxHeight:"90%",
        			opacity: 0.7,
        			href:"#inline-race"
        		});

        		select_days_please.hide();
        		race_datas.hide();

        		race_datas.slideDown("slow");
        	}
		}
	});
});

$(document).on('click', '.race_recode',function(){
	var id = $(this).attr("id");
	var seCd = id.substring(0,7);
	var day = id.substring(7,8);
	var rcNum = id.substring(8);

	var series = { "seCd": "1150903", "lgCd": "1", "lgName": "伊勢崎", "rank": "SG", "name": "グランプリ", "start": "20150903", "days": "5"};

	$('.series_lg').text(series.lgName);
	$('.series_rank').text(series.rank);
	$('.series_name').text(series.name);
	$('.race_date').text(addDay(series.start, day-1));
	$('.race_day').text(day);

	var race = { "name": "一般戦", "kyori" : "3100M(6周)", "runway": "良", "heat": "30" };

	$('.race_name').text(race.name);
	$('.race_kyori').text(race.kyori);
	$('.race_runway').text(race.runway + "走路");
	$('.race_heat').text(race.heat + "℃");

	var recodes = [
	               	{ "rcNum": "1", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "2", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "3", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "4", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "5", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "6", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "7", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" },
	               	{ "rcNum": "8", "hande": "0", "name": "XXXXXXXX", "sisou": "3.30", "agari": "3.400", "st": "05" }
	               ]


});

$(document).on({
	"mouseenter": function(){$(this).stop().animate({ opacity: "0.5" }, 200);},
	"mouseleave": function(){$(this).stop().animate({ opacity: "1.0" }, 500);}
}, ".day_selects a");

$(document).on({
	"mouseenter": function(){$(this).stop().animate({ opacity: "0.5" }, 200);},
	"mouseleave": function(){$(this).stop().animate({ opacity: "1.0" }, 500);}
}, ".race_numbers p");

$(document).on({
	"mouseenter": function(){$(this).stop().animate({ opacity: "0.5" }, 200);},
	"mouseleave": function(){$(this).stop().animate({ opacity: "1.0" }, 500);}
}, ".race_recode");
