$(document).ready(function(){
	var obj = $('.slider').bxSlider({
		auto: true,
		infiniteLoop: true,
		responsive: false,
		speed: 2000,
		displaySlideQty: 1,
		pager: true,
		slideWidth: 710,
		minSlides: 1,
		maxSlides: 1,
		moveSlides: 1,
		slideMargin: 30,
		pause: 7000,
		onSlideAfter: function() {
			obj.startAuto();
		}
	});

});