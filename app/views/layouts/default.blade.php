
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>nLAB</title>
 <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="/nlab/css/bootstrap.min.css" rel="stylesheet">
	<link href="/nlab/css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
 
  
	<script type="text/javascript" src="/nlab/js/jquery.min.js"></script>
	<script type="text/javascript" src="/nlab/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/nlab/js/scripts.js"></script>		
<!-- Bootstrap -->
<!-- <link href="css/bootstrap.css" rel="stylesheet"> -->

<style type="text/css" media="screen">
.page{
overflow:auto;
position:absolute;
height: 100%;
width: 100%;

}
.page-container {	
position:relative;
width: 100%;
height:69%;
}
.container{
height:100%;
width:100%;
}
.left-pane {
	height:100%;
	float:left;
	width: 25%;
	position: relative;
}

.central-pane {
	
	position:relative;
	float: left;
 	width: 50%;
	height:100%;
}

   
.right-pane {
	float: left;
	height:100%;
	position:relative;
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
 .outerbody{
 height:100%;
 width:100%;
 }
.header{
position:relative;
height:20%;
width:100%;
}
.footer{
	
background-color: #f5f5f5;
height:8%;
position:relative
width:100%;

}
.menu{
position:relative;
height:5%;
width:100%;	
}
.row clearfix .btn{
	position : relative;
	background-color:red;
}
body {
/* 	background-color:#e9eaed; */
}
.navbar-fixed-bottom{
	
	height:8%;
}

</style>
</head>
<body>
<div class="page">
       
		@include('layouts/header')
		
		
		@include('layouts/menuHolder')
		
	<div class="page-container">
		<div class="left-pane">
		@include('layouts/left')
		
		</div>
		<div class="central-pane">
		@yield('central_pane')
	     
		</div>
		<div class="right-pane">
			@include('layouts/right')
		</div>
		
	</div>
		
	
	
	
  <div class="navbar-fixed-bottom" role="navigation">
    <div class="container footer1">
      @include('layouts/footer')
    </div>
    
    
  </div>
	
</div>
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<!--     <script src="js/bootstrap.js"></script> -->
    
</body>
<style>
.footer1{
	padding-right: 0px;
	
  padding-left: 0px;
  margin-right: auto;
  margin-left: auto;
}
#FORM_25 {
    color: rgb(69, 69, 69);
    height: 1622.296875px;
    width: 1583px;
    perspective-origin: 791.5px 811.140625px;
    transform-origin: 791.5px 811.140625px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    margin: 0px;
    outline: rgb(69, 69, 69) none 0px;
}/*#FORM_25*/

#DIV_1 {
    color: rgb(69, 69, 69);
    height: 1px;
    width: 100%;
    bottom:0px;
    float:right;
    margin-top :-10px;
    margin-left:-10px;
   	position:absolute;
    perspective-origin: 791.5px 32px;
    transform-origin: 791.5px 32px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_1*/

#DIV_2 {
    background-position: 0px 0px;
    color: rgb(69, 69, 69);
  
    width: auto;
    perspective-origin: 791.5px 18px;
    transform-origin: 791.5px 18px;
    background: rgba(0, 0, 0, 0) url(https://fieldportal.netapp.com/images/FieldPortal/framework/spriteX.png) repeat-x scroll 0px -108px / auto padding-box border-box;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_2*/

#DIV_3 {
    color: rgb(69, 69, 69);
    vertical-align: middle;
    width: 954px;
    perspective-origin: 477px 0px;
    transform-origin: 477px 0px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    margin: 0px 314.5px;
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_3*/

#SPAN_4 {
    background-position: -76px -73px;
    color: rgb(69, 69, 69);
    display: block;
    float: left;
    height: 13px;
    width: 107px;
    perspective-origin: 53.5px 6.5px;
    transform-origin: 53.5px 6.5px;
    background: rgba(0, 0, 0, 0) url(https://fieldportal.netapp.com/images/FieldPortal/framework/spriteFramework.png) no-repeat scroll -76px -73px / auto padding-box border-box;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    margin: 8px 0px 0px;
    outline: rgb(69, 69, 69) none 0px;
}/*#SPAN_4*/

#SPAN_5 {
    background-position: -25px -93px;
    color: rgb(69, 69, 69);
    display: block;
    float: right;
    height: 30px;
    width: 103px;
    perspective-origin: 51.5px 15px;
    transform-origin: 51.5px 15px;
    background: rgba(0, 0, 0, 0) url(https://fieldportal.netapp.com/images/FieldPortal/framework/spriteFramework.png) no-repeat scroll -25px -93px / auto padding-box border-box;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    outline: rgb(69, 69, 69) none 0px;
}/*#SPAN_5*/

#DIV_6 {
    background-position: 0px 0px;
    color: rgb(69, 69, 69);
    height: 28px;
    
    width: 100%;
    perspective-origin: 791.5px 14px;
    transform-origin: 791.5px 14px;
    background: rgb(0, 103, 197) none repeat scroll 0px 0px / auto padding-box border-box;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_6*/

#DIV_7 {
    color: rgb(69, 69, 69);
    height: 26px;
    width: 954px;
    perspective-origin: 477px 13px;
    transform-origin: 477px 13px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    margin: 0px 314.5px;
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_7*/

#DIV_8, #DIV_9 {
    color: rgb(69, 69, 69);
    height: 12px;
    width: 954px;
    perspective-origin: 477px 13px;
    transform-origin: 477px 13px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_8, #DIV_9*/

#UL_10 {
    color: rgb(69, 69, 69);
    height: 12px;
    width: 954px;
    perspective-origin: 477px 13px;
    transform-origin: 477px 13px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    list-style: none outside none;
    margin: 0px;
    outline: rgb(69, 69, 69) none 0px;
    padding: 0px 0px;
}/*#UL_10*/

#LI_11, #LI_13, #LI_16, #LI_19, #LI_22 {
    background-position: 0px 0px;
    color: rgb(255, 255, 255);
    display: inline;
    height: auto;
    width: auto;
    padding-right:200px;
    perspective-origin: 0px 0px;
    transform-origin: 0px 0px;
    background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
    border: 0px none rgb(255, 255, 255);
    font: normal normal normal normal 11px/normal Arial, sans-serif;
    list-style: none outside none;
    margin: 0px 5px 0px 0px;
    outline: rgb(255, 255, 255) none 0px;
    padding: 0px 5px 0px 0px;
}/*#LI_11, #LI_13, #LI_16, #LI_19, #LI_22*/

#A_12, #A_15, #A_18, #A_21 {
    color: rgb(255, 255, 255);
    text-align: left;
    text-decoration: none;
    padding-right:200px;
    border: 0px none rgb(255, 255, 255);
    font: normal normal normal normal 11px/normal Arial, sans-serif;
    font-size:4;
    list-style: none outside none;
    outline: rgb(255, 255, 255) none 0px;
}/*#A_12, #A_15, #A_18, #A_21*/

#LI_14, #LI_17, #LI_23 {
    background-position: 0px 0px;
    color: rgb(255, 255, 255);
    display: inline;
    height: auto;
    width: auto;
    
    perspective-origin: 0px 0px;
    transform-origin: 0px 0px;
    background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
    border: 0px none rgb(255, 255, 255);
    font: normal normal normal normal 11px/normal Arial, sans-serif;
    list-style: none outside none;
    margin: 0px 5px 0px 0px;
    outline: rgb(255, 255, 255) none 0px;
    padding: 0px 0px 0px 0px;
}/*#LI_14, #LI_17, #LI_23*/

#LI_20 {
    background-position: 0px 0px;
    color: rgb(255, 255, 255);
    display: inline;
    height: auto;
    padding-right:200px;
    width: auto;
    perspective-origin: 0px 0px;
    transform-origin: 0px 0px;
    background: rgba(0, 0, 0, 0) none repeat scroll 0px 0px / auto padding-box border-box;
    border: 0px none rgb(255, 255, 255);
    font: normal normal normal normal 15px/normal Arial, sans-serif;
    font-size:4;
    list-style: none outside none;
    margin: 0px 5px 0px 0px;
    outline: rgb(255, 255, 255) none 0px;
    padding: 0px 0px 0px 0px;
}/*#LI_20*/

#DIV_24 {
    clear: both;
    color: rgb(69, 69, 69);
    width: 954px;
    perspective-origin: 477px 0px;
    transform-origin: 477px 0px;
    border: 0px none rgb(69, 69, 69);
    font: normal normal normal normal 10px/normal Arial, sans-serif;
    outline: rgb(69, 69, 69) none 0px;
}/*#DIV_24*/
.wrapper{
    background-color: yellow;
	position:absolute;
	top :25%;
	bottom:25%;
	right:25%;
	left:25%;
	
}


.selection-container{
	 border-style: solid;
	 border-width:2px;
     border-color:rgb(238, 238, 238);
	position:relative;
	
	padding-top:20%;
	padding-left:35%;
	padding-right:30%;
	padding-bottom:20%;
	margin-bottom:2%;
	
}
.row clearfix .selection{
	border:1px;
	background-color:red;
}
.nextBtn{
position:relative;
float: right;
}


<!--

-->
.serif {
    font-family: "Times New Roman", Times, serif;
    font-weight: 700;
}
.serifbtn {
    font-family: "Times New Roman", Times, serif;
    font-weight: 590;
}
</style>

</html>