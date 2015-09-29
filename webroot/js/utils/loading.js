function loadingView(flag) {
	$('#loading-view').remove();
	if(!flag) return;
	$('<div id="loading-view" />').appendTo('body');
}
