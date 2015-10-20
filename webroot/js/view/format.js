$(document).ready(function(){
	$(".logo_autorace").children().addBack().contents().each(function(){
		if (this.nodeType == 3) {
		 var $this = $(this);
		 $this.replaceWith($this.text().replace(/(\S)/g, "<span>$&</span>"));
		}
	});

	$(".logo").hover(function() {
		$(".logo_analytics").stop().animate({ color: "#FF69B4" }, 'normal');
		$(".logo_sub span").slideDown("slow");
	},function() {
		$(".logo_analytics").stop().animate({ color: "#696969" }, 'normal');
		$(".logo_sub span").hide();
	});

	$(".logo").click(function() {
		window.location.href = $('#url').val() + 'Homes';
	});

	var hovers = 	"#entry," +
					"#login," +
					"#update," +
					"#logout";

	$(hovers).hover(function() {
		$(this).stop().animate({ opacity: "0.5" }, 200);
	},function() {
		$(this).stop().animate({ opacity: "1.0" }, 1000);
	});
/*
	var colorboxs = 	"#entry," +
						"#login," +
						"#update," +
						"#logout";

	$(colorboxs).colorbox({
		inline:true,
		maxWidth:"90%",
		maxHeight:"90%",
		opacity: 0.7
	});
*/
});
