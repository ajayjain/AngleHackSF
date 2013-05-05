<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" data-app-id="Jb6mFMu5mXSF0P3fEn5D3Q" src="https://assets.yammer.com/platform/yam.js"></script>
<script type="text/javascript" src="js/json2.js"></script>

<script type="text/javascript" src="js/app.js"></script>
</head>
<body>
	<span id="yammer-login"></span>
	<script type="text/javascript"> 
		yam.connect.loginButton("#yammer-login", function (resp) {
			if (resp.authResponse) {
				document.getElementById("yammer-login").innerHTML = "Welcome to Yammer!";
				console.log(resp);
				$(".fulname").text("asd");
			} 
		});
		$(document).ready(function(){
			/*$("#userSearch").bind("change paste keyup", function() {
				console.log($("#userSearch").val());
		  	})*;*/
			$("#userSearch").bind("change paste keyup", function() {
				yam.getLoginStatus(
				  function(response) {
				    if (response.authResponse) {
				      console.log("logged in");
				      yam.request({
					        url: "https://www.yammer.com/api/v1/autocomplete/ranked",     //this is one of many REST endpoints that are available
					        method: "GET",
					        data: {
					        	prefix: $("#userSearch").val(),
					            models: 'user:' + '5'
						    },
					        success: function (user) {
					          //console.log(JSON.stringify(user));
					          
					          arr = JSON.parse(JSON.stringify(user)).user;
							  $("#searchUsersList").empty();
					          $.each(arr, function(i, v){
					        	  $("#searchUsersList").append('<span class="sUser" data-uid="'+(v.id)+'">'+(v.full_name)+'</span>');
						      });
					        }
					      });
				    }
				    else {
				      alert("not logged in")
				    }
				  }
				);
			});		
			$(".sUser").click(function(){
				console.log($(this).data("uid"));
			});
		});	
	</script>
	<div id="after-login" class="hide">
		<textarea id="user-message" rows="3" cols="30"></textarea>
		<button class="send-msg">Send</button>
		<pre id="console">
		</pre>
		<a href="#" class="btn logout">Logout</a>
	</div>
	<div>
		<span class="fulname"></span>
		<input id="userSearch" type="text" value=""/>
		<div id="searchUsersList"></div>
	</div>
</body>
</html>
