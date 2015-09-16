function convertLgName(lgCd){
	switch(lgCd){
	case "1":
		return "伊勢崎";
	case "2":
		return "川口";
	case "3":
		return "船橋";
	case "4":
		return "浜松";
	case "5":
		return "山陽";
	case "6":
		return "飯塚";
	}
}

function convertSeRankName(seRankCd){
	switch(seRankCd){
	case "2":
		return "GⅡ";
	case "3":
		return "GⅠ";
	case "4":
		return "SG";
	default:
		return "普通";
	}
}

function convertDistance(distance){
	switch(distance){
	case "3100":
		return "3100M (6周)";
	case "4100":
		return "4100M (8周)";
	case "5100":
		return "5100M (10周)";
	case "3600":
		return "3600M (7周)";
	}
}

function convertRunwayName(runwayCd){
	switch(runwayCd){
	case "1":
		return "良";
	case "2":
		return "風";
	case "3":
		return "斑";
	case "4":
		return "湿";
	}
}