<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Emonix Home Automation</title>

	<link href='http://fonts.googleapis.com/css?family=Buenard:700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">

    <script src="https://apis.google.com/js/client:platform.js" async defer></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	<!-- Warming Up -->
	<link href='http://fonts.googleapis.com/css?family=Buenard:700' rel='stylesheet' type='text/css'>
	<script src="http://pupunzi.com/mb.components/mb.YTPlayer/demo/inc/jquery.mb.YTPlayer.js"></script>
	
	<script src="http://pupunzi.com/mb.components/mb.YTPlayer/demo/inc/jquery.mb.YTPlayer.js"></script>

	<script>

	function checkUserLoginStatus() {
		var glogin_authResult = localStorage.getItem('glogin_authResult');
		
		if (glogin_authResult != null) {
			glogin_authResult = JSON.parse(glogin_authResult);
			if ( glogin_authResult['status']['signed_in'] ) {
				localStorage.setItem('signOutRequest','1');
				document.getElementById('login_link').innerHTML = "<a href=\"/login.html\">Logout</a>";
				return true;
			} else {
				document.getElementById('login_link').innerHTML = "<a href=\"/login.html\">Login</a>";
			}
		}
		return false;
	}

	function checkNestRegistration() {
		var authResult = localStorage.getItem('glogin_authResult');

		if (authResult != null) {
		    authResult = JSON.parse(authResult);
			gapi.client.load("oauth2", "v2", function(){
	    	  	gapi.client.oauth2.tokeninfo( {'access_token' : authResult.access_token} ).execute( function(innerResp){
					var user_email = innerResp.email;
	
					var xmlhttp;
					if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
					  	xmlhttp=new XMLHttpRequest();
					} else { // code for IE6, IE5
					  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange=function() {
						if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							var serverResponse = xmlhttp.responseText;
							if (serverResponse == 'true') {
								document.getElementById('request_login_section').style.display='none';
								document.getElementById('nest_linking_section').style.display='none';
								document.getElementById('bill_analysis_section').style.display='block';
							}
					    }
					}
					xmlhttp.open("POST","checkNestRegistration.php",true);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlhttp.send("user_email="+user_email);
				});
	   		});
		}
	    return false;
	}
	
	function nvFileClick(){
		document.getElementById('blankconfig').style.display='none';
	}
	function operationsOnLoad() {
		var userLoginStatus = checkUserLoginStatus();
	
		if (userLoginStatus == true) {
			 document.getElementById('blankconfig').style.display='block';
			var nestRegistrationStatus = checkNestRegistration();
			if (nestRegistrationStatus == true) {
				document.getElementById('bill_analysis_section').style.display='block';
			} else {
				document.getElementById('bill_analysis_section').style.display='none';
			}
		} else {
			document.getElementById('request_login_section').style.display='block';
			document.getElementById('nest_linking_section').style.display='none';
			document.getElementById('bill_analysis_section').style.display='none';
		}
	}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

	if (window.addEventListener) {
	    window.addEventListener("load", operationsOnLoad, false);
	} else if (window.attachEvent) {
	    window.attachEvent("onload", operationsOnLoad);
	} else {
		window.onload = operationsOnLoad;
	}
	
	</script>
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62214230-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- End Google Analytics -->

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<!-- Preloader -->

	<div id="preloader">
	  <div id="load"></div>
	</div>

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                    <h1>EMONIX</h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/index.html">Home</a></li>
	<li id="login_link"><a href="/login.html">Login</a></li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


	<!-- Section: Devices -->
	<br />
    <section id="app" class="home-section text-center">
		<div class="heading-about">
			<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<div class="wow bounceInDown" data-wow-delay="0.4s">
					<div class="section-heading">
					<h2>Emonix Device Details</h2>
					<i class="fa fa-2x fa-angle-down"></i>
					</div>
					</div>
				<?php
				echo "<h3>Device: 0x", $_GET['devid'], "</h3><br>\n";
				?>
<!--	<form id="nvparamform" class="form-horizontal" role="form" action="devinfo.php"> -->

	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-8">
              <input type="hidden" name="devid" value=<?php echo "\"", $_GET['devid'], "\""; ?>/>

	      <button type="submit" class="btn btn-default" onclick="nfFileClick">Download Blank NV Param File</button>
              <div id="blankconfig">
<?php
echo "<h4>S1131C0000000000", $_GET['devid'], "000000000000000068</h4>";
?>
              </div>
	    </div>
	  </div>
<!--        </form> -->
				</div>
			</div>
			</div>
		</div>
		<div id="appcontainer" class="container">
		</div>
<!-- End section Devices -->

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">

					<p>&copy;Copyright 2015 - Emonix.</p>
				</div>
			</div>	
		</div>
	</footer>

    <!-- Core JavaScript Files -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/lib/jquery.easing.min.js"></script>	
	<script src="js/lib/jquery.scrollTo.js"></script>
	<script src="js/lib/wow.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/lib/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="bower_components/angular/angular.min.js"></script>
    <!-- TODO angularify this-->
       <script type="text/javascript">


function sendEmail(){
// create a variable for the API call parameters
// Send the email!
var from = document.getElementById("email").value;
console.log(from);
var name = document.getElementById("name").value;
console.log(name);
var subject = document.getElementById("subject").value;
console.log(subject);
var message = document.getElementById("message").value;
console.log(message);

   var xmlHttp = null;

    xmlHttp = new XMLHttpRequest();
//    xmlHttp.open( "GET", 'http://127.0.0.1:8000/email/'+message+ '/from/'+ from +'/name/' + name +'/sub/'+subject, false );
    xmlHttp.open( "POST", 'http://www.emonix.io/cgi-bin/getintouch.cgi', true );
    xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlHttp.send( "email="+from+"&name="+name+"&subject="+subject+"&message="+message );
    console.log(xmlHttp.responseText)
}

    </script>
</body>

</html>
