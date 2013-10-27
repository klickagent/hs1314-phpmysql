$(document).ready(function(){
	$('#state').css({'display':'none'}).fadeIn().delay(2000).fadeOut();
	
	//to debug without html5 reguired tag uncomment the following line:
	//$('input,textarea').removeAttr('required');
	
	//debug without javascript validation uncomment the following line:
	//JS_VALIDATION = false;
});
function validateValues(){
	if( !JS_VALIDATION ) return true;
	
	$('input.failedValidation').removeClass('failedValidation');
	
	var failedObjs = [];
	$('input,textarea').each( function(){
		var type = $(this).attr('type');
		if( this.value == '' ) {
			failedObjs.push(this);
		}
	});
	
	for ( var i in failedObjs ) {
		$(failedObjs[i]).addClass('failedValidation');
	}
	
	if( failedObjs.length > 0 ) return false;
	
	return true;
};