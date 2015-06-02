
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>nLAB</title>
		
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<style type="text/css" media="screen">
.page{
height:100%;
width:100%;
background:red;
}
.page-container {	
	width: 100%;
	
	
}
.container{
height:100%;
width:100%;
}


.left-pane {
	float:left;
	width: 25%;
}

.central-pane {
	float: left;
 	width: 50%;
}

.right-pane {
	float: left;
	
	width: 25%;
}

.clear {
	height: 0;
	font-size: 1px;
	margin: 0;
	padding: 0;
	line-height: 0;
	clear: both;
}
 .link {
 	padding: 10px 0px;
 	font-style: italic;
 }
 
body {
/* 	background-color:#e9eaed; */
}
</style>
</head>
<body>
<div class="page">

	<div>
		@include('layouts/header')
	</div>
	<div class="page-container">
		<div class="left-pane">
		
		</div>
		</div>
		<div class="central-pane">
		@yield('central_pane')
	
		</div>
		<div class="right-pane">
		
		</div>
	</div>
	<div class="clear"></div>
	<div>
		@include('layouts/footer')
	</div>
</div>
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    
</body>
</html>