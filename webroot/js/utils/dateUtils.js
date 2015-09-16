function addDay(dateStr,days){
	try{
		var format = dateStr.substring(0,4) + "/" + dateStr.substring(4,6) + "/" + dateStr.substring(6,8);
		var date = new Date(format);
		date.setDate( date.getDate() + Number(days) );
		var yyyy = date.getFullYear();
		var mm = (date.getMonth() + 1).toString();
		if(mm.length == 1) { mm = '0'+mm; }

		var dd = date.getDate().toString();
		if(dd.length == 1) { dd = '0'+dd; }

		if( isNaN(yyyy) || isNaN(mm) || isNaN(dd) ){  throw new Error(); }
		var formattedDate = mm + "/" + dd;
		return formattedDate;
	}catch(e){
		return '';
	}
}

function convertStringDate(dateStr){
	return dateStr.substring(0,4) + "年 " + Number(dateStr.substring(4,6)) + "月 " + Number(dateStr.substring(6,8)) + "日";
}