$(document).ready(function(e) {
	$(".submenu > a").click(function(){
		if(!$(this).parent("li").hasClass("active")){
			$(".subNav").slideUp(300);
			$(".submenu a").parent("li").removeClass("active");
			$(this).next().slideDown(300);
			$(this).parent("li").addClass("active");
		}
		else{
			$(this).next().slideUp(300);
			$(this).parent("li").removeClass("active");
			}
		});
	if($(window).width() < 768){
		$(".toggle").click(function(){
			$(".navLeft").slideToggle(250);	
		});	
	}
	
	$(".detailstabs a").click(function(){
		var ind = $(this).index() + 1;
		$(".detailstabs a").removeClass("actv");
		$(this).addClass("actv");
		$(".tab").hide();
		$("#tab" + ind).show();
	});

	$(".close").click(function(){
		$(".prodPopOverlay").fadeOut(250);
		$("body").css("overflow","auto");
	});
});

/* $(window).resize(function(e) {
if($(window).width() < 768){
		$(".toggle").click(function(){
			$(".navLeft").slideToggle();	
		});	
	}
});	*/