$(document).ready(function(){
	

/****************************************Forms********************************/
$("form.request").on("submit",function(){
	var that = $(this),
		url = that.attr("action"),
		type = that.attr("method"),
		data = {};
	that.find('[name]').each(function(index, value){
		var that = $(this),
			name = that.attr('name'),
			value = that.val();
			data[name] = value;
	});

	$.ajax({
		url: url,
		type: type,
		data: data,
		success: function(response){
			if (response == "Your request has been sent.") {
				alert(response);
			}
			else if(response == "You have a pending request with this user"){
				alert(response);
			} else if(response == "you are already a friend with this user"){
				alert(response);
			}			
			else if (response == "Friendship Accepted") {
				alert(response);
				window.location.href = "comfirm_request.php";
			}	

			 
		}
	});

	return false;


	});



/*+++++++++++++++++++++++manipulates the send button+++++++++++++++++++*/
 $("a[ name = reject]").click(function(){
 	alert("request has been removed");
 });

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

