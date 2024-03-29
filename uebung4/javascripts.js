$(document).ready(function(){
	$('#state').css({'display':'none'}).fadeIn().delay(2000).fadeOut();
	
	//to debug without html5 reguired tag uncomment the following line:
	//$('input,textarea').removeAttr('required');
	
	//debug without javascript validation uncomment the following line:
	//JS_VALIDATION = false;
});

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

function validateValues(){
	if( !JS_VALIDATION ) return true;
	
	$('input.failedValidation').removeClass('failedValidation');
	
	var failedObjs = [];
	$('input,textarea').each( function(){
		var type = $(this).attr('type');
		if( type === 'email' ) {
			if( this.value == '' || !validateEmail( this.value) ) {
				failedObjs.push(this);
			}
		} else if( type !== 'file' ){
			if( this.value == '' ) {
				failedObjs.push(this);
			}
		}
	});
	
	for ( var i in failedObjs ) {
		$(failedObjs[i]).addClass('failedValidation');
	}
	
	if( failedObjs.length > 0 ) return false;
	
	return true;
};