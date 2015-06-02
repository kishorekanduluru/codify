<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<title>NetApp Login Page</title>
<meta content="width=device-width, initial-scale=1" name="viewport">
{{ HTML::style('css/fonts.css') }}
{{ HTML::style('css/login.css') }}
{{ HTML::style('css/imageslider.css') }}






<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
    $(function(){
    $('.fadein img:gt(0)').hide();
    setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 3000);
    });
    </script>
		
		
    </head>
    <body class="login" action="/LoginAction" role="document" onload="checkReferrer();">
	<div class="loginBox">
		<div class="container1 wireBlock">
			<div class="wrapper">
				<header>
					<div class="logo">
						{{ HTML::image('images/horizontal-logo.png') }}
					</div>
				</header>
				<section>
					<h1 class="loginTitle" style="margin: 0; display: inline-block;">
						Login to <span class="highlight">Continue</span>
					</h1>
					<p>Cookies must be enabled.</p>
				</section>
				
			</div>
			
		</div>

		<div class="container2 wireBlock">
			<div class="wrapper">
				<div class="loginForm">
					<div class="error" id="loginfailed" style="display: none">
						<p>Incorrect Username or Password</p>
					</div>
					<form action="login" id="Login" method="post"
						name="Login" role="form">
						<input name="action" type="hidden" value="login">
						<div class="formGroup">
							<label for="user">Username:</label> <input autofocus
								class="formControl" id="user" type="text" name="username"
								style="border: 1px solid #c3c3c3">
						</div>
						<div class="formGroup">
							<label for="password">Password:</label> <input
								class="formControl" id="password" type="password"
								name="password" style="border: 1px solid #c3c3c3">
						</div>
						<div>
							<input id="remUID" name="remUID" type="checkbox" value="1"
								onclick="rememberUser();"> <label for="remUID">Remember username</label>
							<p style="line-height: 10px">
						
						</div>
						<input name="postpreservationdata" type="hidden" value> 
						<input class="button" type="submit" value="Login">
						<div class="loginHelp">
							<p style="padding-bottom: 10px"></p>
							<p>
								Forgot your password? <a
									href="https://mysupport.netapp.com/eservice/public/webreg/RemindMePassword.jsp">
									Click here </a>
							</p>
							<p>
								Not registered <a
									href="https://mysupport.netapp.com/eservice/public/now.do">
									Sign up now! </a>
							</p>
						</div>
					</form>
				</div>
				<noscript>
					<div class="alertWarning">
						<p>JavaScript is disabled in your browser currently. Please enable
							JavaScript in your browser and try again.</p>
					</div>
				</noscript>
			</div>
		</div>
	</div>
	<script src="./js/jquery.min.js"></script>
	<script src="./js/omniture.js"></script>
	<script src="./js/s_code.js"></script>
	<script>
      $(function () { 
        $('input[type="checkbox"]:not(:checked)').click(function() {
          $(this).toggleClass("checked", this.checked);
        }); 
      });
    </script>
	<script language=JavaScript type="text/javascript">
function checkReferrer(){
			if ( document.referrer == "https://signin.netapp.com/oamext/login.html" )
				{
					document.getElementById("loginfailed").style.display="block";
				}
}

</script>

	<script>
      //google analytics
	  
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','../oam10g/js/analytics.js','ga');
      
      if(location.host=="signin.netapp.com") {
          ga('create', 'UA-3177638-5', 'auto');
      }
      else {
          ga('create', 'UA-49436032-1', 'auto');
      }
      ga('send', 'pageview'); 

//OLD CODE 
			autoFill = false;
			defaultFocus();

	function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure )
		{
			var cookie_string = name + "=" + escape ( value );
			if ( exp_y )
			{
				var expires = new Date ( exp_y, exp_m, exp_d );
				cookie_string += "; expires=" + expires.toGMTString();
			}
			if ( path )
				cookie_string += "; path=" + escape ( path );
			if ( domain )
				cookie_string += "; domain=" + escape ( domain );
			if ( secure )
				cookie_string += "; secure";
			document.cookie = cookie_string;
}

function get_cookie ( cookie_name )
{
    var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
}
	
function del_cookie(name)
{
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
	function rememberUser()
    {
        var codeElmnt = document.getElementById('user');
        var uname = codeElmnt.value;
        autoFill = document.getElementById("remUID").checked;
        if (autoFill==true)
			{
                set_cookie ( "alwaysRemember", uname, 2022, 12, 25, "", "", "" );
                set_cookie ( "rememberFlag", 1, "", "", "", "", "", "" );
				
			}

        else
            {
                var rem_flag = get_cookie ( "rememberFlag" );
                  if (rem_flag!=null)
                        {
                                del_cookie("rememberFlag");
                        }
                        var per_uid = get_cookie ( "alwaysRemember" );
                        if (per_uid!=null)
                        {
                                del_cookie("alwaysRemember");
                        }
                }
    }



	function defaultFocus()
                {
                        var persistUname = get_cookie ( "alwaysRemember" );
                        if (persistUname!=null)
                        {
							document.getElementById("remUID").checked = true;
							var codeElem = document.getElementById('user');
							codeElem.value = persistUname;
							document.forms[0].password.focus();
                        }
                        else
                        {
							document.forms[0].user.focus();
                        }
                        
                }

    </script>

       
    </body>
</html>