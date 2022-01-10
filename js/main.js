$(document).ready(function(){
	

/****************************************Forms********************************/
$("form.ajax").on("submit",function(){
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
			// errace teaxtarea after message is sent
			$("textarea").val("");
			// this script will remove the plus button and add request sent in the add friend page


			// we are parsing this to access php arrays
			var resp = JSON.parse(response);
			$("#err1").html(resp["user"]);
			$("#err2").html(resp["email"]);
			$("#err3").html(resp["pass"]);
			$("#err4").html(resp["count"]);
			$("#err5").html(resp["gender"]);
			$(".success").html(resp["success"]);

			// next selectorss are for login page
			$(".error").html(resp["fail"]);
			var success = $(".success").text();
			if (success == "Registration Successful!") {
				// clear inputs
				$("input").val("");
				// redirect
				setInterval(function(){
					window.location.href ="login.php";	
				}, 2000)
			} 
			else if(success == "Login Successful!"){
				// clear inputs
				$("input").val("");
				$(".error").html("");
				// redirect
				setInterval(function(){
					window.location.href ="addfriends.php";	
				}, 2000);
			} 

	
			


			// end of success
		}
	});

	return false;


	});

	// disable and enable send button
	/*$("button[name = 'send']").attr("disabled", true);
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
	}*/

	/*+++++++++++++++++++++++++=search++++++++++++++++++++++++*/
		// $("search").keyup(function(){
		// 	var value = $(this).val();
		// })



	
})

