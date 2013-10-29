$(document).ready(function(){
	$('#state').css({'display':'none'}).fadeIn().delay(2000).fadeOut();
	
	$('.autosaveOnChange').change(function(){
		$(this).parent().submit();
	});
	$('.hideWhenJSavailable').hide();
	
	
	$('.editTodoLink>span').click(function(){
		$(this).parent().toggle();
		$(this).parent().parent().children('.editTodo').toggle();
	});
});