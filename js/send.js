$(document).ready(function(){
	// disable and enable send button
	$("button[name = 'send']").attr("disabled", true);
	$("textarea").keyup(function(){
		text()	
	})
	function text(){
		var text = $("textarea").val() ;
		if (text != "") {
			$("button[name = 'send']").removeAttr("disabled");
		} else{
			$("button[name = 'send']").attr("disabled", true);
		}
	}

})