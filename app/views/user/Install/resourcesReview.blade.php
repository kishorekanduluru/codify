@extends('layouts.default')
@section('central_pane')



<head>
<link rel="stylesheet"
	href="/nlab/css/jquery-ui.css">

<script type="text/javascript"
	src="/nlab/js/jquery.min.js"></script>
<script src="/nlab/js/jquery-1.9.1.js"></script>
<script src="/nlab/js/jquery-ui.js"></script>


<script src="/nlab/js/resourceReview.js"></script>

</head>
<style>
.list{
	position:relative;
	padding-top: 15px;
	padding-bottom: 15px;
	line-height: 20px;
}

</style>
<body onLoad>
<div class="container">

{{ Form::open(array('route' => array('Job.Details.Submission',$resources),'class'=>'form-Div')) }}

<div class="row selectioncontainer">
	<div id="tabs" >
	
		<ul class="menu-header">
			
			
			<li><a href="#hostsInfo" UId="hosts">HOSTS</a></li> 
			<li><a href="#filersInfo" UId="filers">FILERS</a></li> 
			
		</ul>

        
		<div id="filersInfo" class="menu-body" >
		
		<div class="div-options">
		@foreach (Session::get('filers') as $filer)
		<?php 
			$mode='mode'.$filer->id;
			
			?>
		 <div class="box">
		 <font class="blockquotehead">
			 <u>{{$filer->ip}}</u><br>
             </font>
		 <div class="display">
			<div class="display1"><font class="blockquote">Mode</font></div>
			<div class="display2">{{Session::get('mode2')}}</div>
			</div>
		 </div>
		 @endforeach
		</div>
		<div id="" class="div-footer">
		* Please verify the details
		</div>
		</div>
	
		<div id="hostsInfo" class="menu-body" >
             
			<div class="div-options">
             @foreach (Session::get('hosts') as $host)
			
			<?php 
			$os='os'.$host->id;
			$version='version'.$host->id;
			$protocol='protocol'.$host->id;
			$architecture='architecture'.$host->id;
			?>
			<div class="box">
			<font class="blockquotehead">
			 <u>{{$host->ip}}</u><br>
             </font>
			<div class="display">
			<div class="display1"><font class="blockquote">OSVersion</font></div>
			<div class="display2">{{Session::get($os)}}{{Session::get($version)}}</div>
			</div>
			<div class="display">
			<div class="display1"><font class="blockquote">Architecture</font></div>
			<div class="display2">{{Session::get($architecture)}}</div>
			</div>
			
			<div class="display">
			<div class="display1"><font class="blockquote">Kernal</font></div>
			<div class="display2">{{Session::get('kernal')}}</div>
			</div>
			
			<div class="display">
			<div class="display1"><font class="blockquote">DNMP</font></div>
			<div class="display2">{{Session::get('DNMP')}}</div>
			</div>
			
			<div class="display">
			<div class="display1"><font class="blockquote">Protocol</font></div>
			<div class="display2">{{Session::get($protocol)}}</div>
			</div>
			
			<div class="display">
			<div class="display1"><font class="blockquote">SANBOOT </font></div>
			<div class="display2">{{Session::get('SANBOOT')}}</div>
			</div>
			
			
			</div>
			 @endforeach
			</div>
			
	
</div>	
	   
		
		    
		</div>
		</div>
	
	<div class="row jobcontainer">
    <div class="col-md-6 column">
	<div class="job_name" id="job_name">
     </div>
		</div>
		<div class="col-md-6 column">
		<div class="temp_options" id="temp_options">
		</div>
		</div>
		
	
	</div>	
<div class="row submit-btn">
<div class="Footer">
	<div class="col-md-2 column prev-btn">
	<button id="btnMoveLeftTab" type="button" value="Previous Tab" class="btn btn-primary btn pull-left"
				text="Previous Tab" >Previous</button>
		</div>
		<div class="col-md-6 column">
		</div>
		<div class="col-md-4 column next-btn">
		<button id="btnMoveRightTab" type="button" value="Next Tab" class="btn btn-primary btn pull-right"
				text="Next Tab">Next  </button>
		<button id="submitTab" type="submit" value="Submit"  class="btn btn-primary btn pull-right"  text="Submit">
				Submit</button>
		</div>
</div>	
</div>
		
{{ Form::close() }}	
</div>

</body>
<style>
.temp_options{
margin-top:10px;
}
.jobcontainer{
	padding-top:2%;
	position:relative;
	height:10%;
	font-weight: bold;
}
.job_name{
	position:relative;
	margin-top :10px;
	
}

.display{
	position:relative;
    width:100%;
    height:20px;
}
.display1{
	float:left;
	position:relative;
    width:40%;
    height:20px;
}

.display2{
	float:left;
	position:relative;
    width:60%;
    height:20px;
}

.blockquotehead {
	 font-size: 15px;
	width:100px;
	padding-right:100px;
	font-family: Arial;
	font-style: normal;
	font-variant: normal;
	font-weight: bolder;
	line-height: 20px;
}
.blockquote {
	 font-size: 13px;
	width:100px;
	padding-right:100px;
	font-family: Arial;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	line-height: 20px;
}
.ui-tabs .ui-tabs-panel {
	
	padding: 0em 0em;
	
}
.box{
	margin-right:40%;
	
	margin-left:10%;
	margin-top:5%;
}
.div-footer{
	background-color: #f5f5f5;
    border-top: 1px solid #ddd;
	border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
	position:relative;
	height:10%;
	}
div#tabs {
    position: relative;
    height: 100%;
}
.form-Div{
	position:relative;
	height:100%;
}

h5 {
	font-family: "Times New Roman", Times, serif;
	font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	line-height: 10px;
}
  input[type=radio] {
    margin-right:5px;
    height:1em;
}
.arc-radio{

	padding-top:10%;
	padding-left:10%;
	position:relative;
	height:40%;
	width:100%;
}
.protocol-radio{
   padding-top:10%;
   	padding-left:10%;
	position:relative;
	height:40%;
	width:100%;
}
.div-options{
	overflow:auto;
	position:relative;
	height:90%;
	width:100%;
}

.select-style select{
	position:relative;
	width:100%;
}
.menu-body{
	
	position:relative;
	height:90%;
	width:100%;
}
.menu-header{
	position:relative;
	height:10%;
	 background-color:#e7e7e7;
}


.radio-container{
	float:right;
	
	height:100%;
	width:50%;
}
.dropdwn-container{
	
	position:absolute;
	height:100%;
	width:50%;
}
.os-dropdown{
	padding:10%;
	position:relative;
	height:40%;
	width:100%;
}
.version-dropdown{
    padding:10%;
	position:relative;
	height:40%;
	width:100%;
}
.part2{
	position:relative;
	height:100%;
	width:50%;
}
.part21{
	position:relative;
	height:40%;
	width:100%;
}
.part22{
	position:relative;
	height:40%;
	width:50%;
}

.form-Div{
	position:relative;
	height:100%;
}
.selectioncontainer{
	padding-top:0%;
	position:relative;
	height:75%;
	
}

.submit-btn{
	position:relative;
	height:15%;
	padding-top:3%;
}
.select-style {
	padding: 0;
	margin: 0;
	border: 1px solid #ccc;
	width: 50%;
	border-radius: 3px;
	overflow: hidden;
	background-color: #fff;
	background: #fff
		url("http://www.scottgood.com/jsg/blog.nsf/images/arrowdown.gif")
		no-repeat 90% 50%;
}
.next-btn{
position:relative;
  padding-left: 0px;
  padding-right: 0px;
  top: 30%;

}
.prev-btn{
position:relative;
  padding-left: 0px;
  padding-right: 0px;
  top: 30%;

}
.select-style select {
	padding: 5px 8px;
	
	border: none;
	box-shadow: none;
	background-color: transparent;
	background-image: none;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
}

.select-style select:focus {
	outline: none;
}

.Clearboth {
	clear: both;
}



.content3 {
  background:green;
  width:350px;
  display:inline-block !important;
}
.sidebar3 {
  width:140px; /* Intentionaly has more width */ 
  display:inline-block;
  /* Ignore this, it's just to show the green sidebar is not jumping to the next line, even though it "collides" */
  background:lime;
  z-index:100;
  position:relative;
  opacity:0.3;
}
</style>
<script>
				
// $('#os').on('change',function(e){
// 	alert("iam here");
	
// 		// 	console.log(e);
// 		var id=e.target.value;
		
// 		var software_name=e.target.value.text;
// // 		console.log(name);
// 		$.get('ajax-osver?id=' + id,function(data){
			
// 			$('#versions').empty();
// 			$.each(data,function(sample,versnObj){
// 			$('#versions').append('<option value="'+versnObj.id+'">'+versnObj.version+'</option>');

// 			});

// 			});

// 		});
 $(function () {
    $( "#tabs" ).tabs(this);
	
    
  });

	$(document).ready(function() {
	$( "#left_menu" ).empty();
	$("#left_menu").append('<li><a href="/user/messages"><span class="tab">Reservation-></span></a></li>');
	$("#left_menu").append('<li><a href="/user/messages"><span class="tab">HostOptions-></span></a></li>');
	$("#left_menu").append('<li><a href="/user/messages"><span class="tab">FilerOptions-></span></a></li>');
	$("#left_menu").append('<li class="list"><span class="tab">Review</span></li>');
	
    } );	
   





</script>

@stop