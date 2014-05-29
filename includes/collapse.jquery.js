$(function (){

	var $div = $('.sortSection div');

	$div.addClass("hidden");

	$('.sortSection h4').click(function (){
		$(this).next().slideToggle();
	});

})();