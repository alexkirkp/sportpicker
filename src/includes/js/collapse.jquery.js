$(function (){

	$('.toggle').removeClass("hidden");
	$('.sortSection div').addClass("hidden");
	$('#update').addClass('hidden');

	$('.sortSection h4').click(function (){
		$(this).next().slideToggle();
	});

	$('.toggle').click(function (e){
		var $attribute = $(this).data("column");
		e.preventDefault();

		$('.' + $attribute).fadeToggle();

		if($(this).html() === 'Hide'){
			$(this).html('Show');
		} else {
			$(this).html('Hide');
		}
	});

	$('input[type="radio"]').change(function() {
		$(this).parents('form:first').submit();
	});
	$('#categories').change(function() {
		$(this).parents('form:first').submit();
	});

});