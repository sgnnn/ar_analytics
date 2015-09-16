
function createChartAnalytics1(){
	var charJSPersonnalDefaultOptions = { decimalSeparator : "," , thousandSeparator : ".", roundNumber : "none", graphTitleFontSize: 2 };

	var datas = [
	             	{ "win": "5" },
	             	{ "win": "8" },
	             	{ "win": "12" },
	             	{ "win": "13" },
	             	{ "win": "15" },
	             	{ "win": "20" },
	             	{ "win": "25" },
	             	{ "win": "40" }
	             ]

	var mydata2 = [
	       		{ value : datas[0].win, color: "#DCDCDC", title : "1号車" },
	    		{ value : datas[1].win, color: "#000000", title : "2号車" },
	    		{ value : datas[2].win, color: "#FF0000", title : "3号車" },
	    		{ value : datas[3].win, color: "#0000FF", title : "4号車" },
	    		{ value : datas[4].win, color: "#FFFF00", title : "5号車" },
	    		{ value : datas[5].win, color: "#7FFF00", title : "6号車" },
	    		{ value : datas[6].win, color: "#FF8C00", title : "7号車" },
	    		{ value : datas[7].win, color: "#FF69B4", title : "8号車" }
	];

	var startWithDataset =1;
	var startWithData =1;

	var opt1 = {
		animationStartWithDataset : startWithDataset,
		animationStartWithData : startWithData,
		animateRotate : true,
		animateScale : true,
		animationByData : true,
		animationSteps : 30,
		legend : true,
		inGraphDataShow : true,
		animationEasing: "linear",
		annotateDisplay : true,
		spaceBetweenBar : 5,
		inGraphDataTmpl: "<%=v2%>(<%=v6%>%)",
		inGraphDataAnglePosition : 2,
		inGraphDataRadiusPosition: 3,
		inGraphDataPaddingRadius : -8,
		inGraphDataRotate : "inRadiusAxisRotateLabels",
		inGraphDataFontSize : 16,
		inGraphDataAlign : "to-center",
		inGraphDataVAlign : "to-center",
		graphTitleSpaceAfter : 0,
		footNoteSpaceBefore : 0,
		inGraphDataFontFamily: "Meiryo",
		inGraphDataFontStyle: "bold"
	}

	$("#inline-analytics").children("#canvas_analytics").remove();
	$("#inline-analytics").append("<canvas id=\"canvas_analytics\" height=\"400\" width=\"800\"></canvas>");
	var myPie = new Chart(document.getElementById("canvas_analytics").getContext("2d")).Pie(mydata2,opt1);
}

function createChartAnalytics2(){
	var charJSPersonnalDefaultOptions = { decimalSeparator : "," , thousandSeparator : ".", roundNumber : "none", graphTitleFontSize: 2 };

	var datas = [
	             	{ "win": "5" },
	             	{ "win": "8" },
	             	{ "win": "12" },
	             	{ "win": "13" },
	             	{ "win": "15" },
	             	{ "win": "20" },
	             	{ "win": "25" },
	             	{ "win": "40" }
	             ]

	var mydata2 = [
	       		{ value : datas[0].win, color: "#DCDCDC", title : "1号車" },
	    		{ value : datas[1].win, color: "#000000", title : "2号車" },
	    		{ value : datas[2].win, color: "#FF0000", title : "3号車" },
	    		{ value : datas[3].win, color: "#0000FF", title : "4号車" },
	    		{ value : datas[4].win, color: "#FFFF00", title : "5号車" },
	    		{ value : datas[5].win, color: "#7FFF00", title : "6号車" },
	    		{ value : datas[6].win, color: "#FF8C00", title : "7号車" },
	    		{ value : datas[7].win, color: "#FF69B4", title : "8号車" }
	];

	var startWithDataset =1;
	var startWithData =1;

	var opt1 = {
		animationStartWithDataset : startWithDataset,
		animationStartWithData : startWithData,
		animateRotate : true,
		animateScale : true,
		animationByData : true,
		animationSteps : 30,
		legend : true,
		inGraphDataShow : true,
		animationEasing: "linear",
		annotateDisplay : true,
		spaceBetweenBar : 5,
		inGraphDataTmpl: "<%=v2%>(<%=v6%>%)",
		inGraphDataAnglePosition : 2,
		inGraphDataRadiusPosition: 3  ,
		inGraphDataPaddingRadius : -8,
		inGraphDataRotate : "inRadiusAxisRotateLabels",
		inGraphDataFontSize : 16,
		inGraphDataAlign : "to-center",
		inGraphDataVAlign : "to-center",
		graphTitleSpaceAfter : 0,
		footNoteSpaceBefore : 0,
		inGraphDataFontFamily: "Meiryo",
		inGraphDataFontStyle: "bold"
	}

	$("#inline-analytics").children("#canvas_analytics").remove();
	$("#inline-analytics").append("<canvas id=\"canvas_analytics\" height=\"400\" width=\"800\"></canvas>");
	var myPie = new Chart(document.getElementById("canvas_analytics").getContext("2d")).Pie(mydata2,opt1);
}

function createChartAnalytics3(){
	var charJSPersonnalDefaultOptions = { decimalSeparator : "," , thousandSeparator : ".", roundNumber : "none", graphTitleFontSize: 2 };

	var datas = [
	             	{ "win": "20" },
	             	{ "win": "15" }
	             ]

	var mydata2 = [
	       		{ value : datas[0].win, color: "#DCDCDC", title : "通常" },
	    		{ value : datas[1].win, color: "#000000", title : "高配当" }
	];

	var startWithDataset =1;
	var startWithData =1;

	var opt1 = {
		animationStartWithDataset : startWithDataset,
		animationStartWithData : startWithData,
		animateRotate : true,
		animateScale : true,
		animationByData : true,
		animationSteps : 30,
		legend : true,
		inGraphDataShow : true,
		animationEasing: "linear",
		annotateDisplay : true,
		spaceBetweenBar : 5,
		inGraphDataTmpl: "<%=v2%>(<%=v6%>%)",
		inGraphDataAnglePosition : 2,
		inGraphDataRadiusPosition: 3  ,
		inGraphDataPaddingRadius : -8,
		inGraphDataRotate : "inRadiusAxisRotateLabels",
		inGraphDataFontSize : 16,
		inGraphDataAlign : "to-center",
		inGraphDataVAlign : "to-center",
		graphTitleSpaceAfter : 0,
		footNoteSpaceBefore : 0,
		inGraphDataFontFamily: "Meiryo",
		inGraphDataFontStyle: "bold"
	}

	$("#inline-analytics").children("#canvas_analytics").remove();
	$("#inline-analytics").append("<canvas id=\"canvas_analytics\" height=\"400\" width=\"800\"></canvas>");
	var myPie = new Chart(document.getElementById("canvas_analytics").getContext("2d")).Pie(mydata2,opt1);
}