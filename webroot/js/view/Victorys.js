$(document).ready(function(){

	var hovers = 	".category_select a";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});

	$("#more").click(function() {
		var gradeOnly = $("#gradeOnly").val();
		var moreStart = $("#moreStart").val();
		execGet("Victorys/findRacesMore", {gradeOnly: gradeOnly, moreStart: moreStart},
			{success : function(response){
				if(response.status) {
					var victorys = response.victorys;
					for(var i=0; i<victorys.length; i++){
						var victory = victorys[i];
						var victoryData = $('<div/>').addClass("victory_data");
						var victoryRacer = $('<div/>').addClass("victory_racer");
						var victorySeries = $('<div/>').addClass("victory_series");

						victoryRacer.append($('<p/>').text(victory["racerName"]));
						victoryRacer.append($('<p/>').text(victory["rankNew"]));
						victoryRacer.append($('<p/>').text(victory["racerLgName"]));
						victoryRacer.append($('<p/>').text(victory["ki"] + "期"));

						victorySeries.append($('<p/>').text(victory["lgName"]));
						victorySeries.append($('<p/>').text(victory["seRankName"]));
						victorySeries.append($('<p/>').text(victory["seTitle"]));

						victoryData.append(victoryRacer);
						victoryData.append(victorySeries);
						$(".victory_datas").append(victoryData);
					}

					if(victorys.length > 0)
						$("#moreStart").val(victorys[victorys.length-1]["seStartYmd"]);
					else
						$("#more").text("ここで終わりです");
	        	}
			}
		});
	});

});