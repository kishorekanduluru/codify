@extends('layouts.default')
@section('central_pane')



<head>
<link rel="stylesheet"
	href="/nlab/css/jquery-ui.css">

<script type="text/javascript"
	src="/nlab/js/jquery.min.js"></script>
<script src="/nlab/js/jquery-1.9.1.js"></script>
<script src="/nlab/js/jquery-ui.js"></script>


<script src="/nlab/js/1.js"></script>

</head>
<body onLoad>
<div class="container">

 {{ Form::open(array('url' => '/user/test/DOT/hostOptions', 'class'=>'form-Div')) }}

<div class="row selectioncontainer">
	<div id="tabs" >
	
		<ul class="menu-header">
			@if ( Session::has('hosts') )
			 @foreach (Session::get('hosts') as $host)
			<li><a href="#{{$host->id}}" UId="{{$host->id}}">{{ $host->ip }}</a></li> 
			@endforeach
			@endif
		</ul>

        
		@foreach (Session::get('hosts') as $host)
		<div id="{{$host->id}}" class="menu-body" >
             
			<div class="div-options">
           <div class="dropdwn-container">
		   
		   <div class="os-dropdown">
			 <h5>OS List</h5>
			<div class="select-style">
				<select name="os{{ $host->id }}" id="os{{ $host->id }}" onchange="myFunction(this,{{ $host->id }})">
					<option value="" disabled selected>Select</option>
					 @foreach($os as $o)
					<option value="{{$o->id}}" osUId="{{$o->id}}">{{$o->software_name}}</option>
					@endforeach
				</select>
			</div>
           </div>
			
			<div class="version-dropdown">
			<h5>Versions</h5>
			<div class="select-style">
				<select name="versions{{ $host->id }}" id="versions{{ $host->id }}"  onchange="selectedList(this,{{ $host->id }})">
				<option value="" disabled selected>Select OS</option>
<!-- 					@foreach($os_versions as $ov) -->
<!-- 					<option value="{{$ov->id}}" text="{{$ov->version}}">{{$ov->version}}</option>  -->
<!-- 					@endforeach -->
				</select>
			</div>
			</div>
			</div>
			
			
		  
		  
		  <div class="radio-container">
		   <div class="arc-radio" >
			<h5>Architecture</h5>
	
	
   
	<input type="radio" name="architecture{{$host->id}}" value="x86" id="arch_of{{$host->id}}" onclick="getArcSelected()" checked="checked">x86<br>
	<input type="radio" name="architecture{{$host->id}}" value="x86-64" id="arch_of{{$host->id}}" onclick="getArcSelected()">x86-64<br>
    
  
	</div>
	
	<div class="protocol-radio">
    <h5>Protocol</h5>
	
	
     
	<input type="radio" name="protocol{{$host->id}}" value="FC" onclick="getProSelected()" checked="checked">FC<br>
	<input type="radio" name="protocol{{$host->id}}" value="FCoE" onclick="getProSelected()">FCoE<br>
	<input type="radio" name="protocol{{$host->id}}" value="iSCSCI" onclick="getProSelected()">iSCSCI<br>
   
    </div>
	 
			
			
	</div>
		
	</div>	
	   
		<div id="SelectionList{{$host->id}}" class="div-footer">
		
	
		    <font size="4" class="blockquote">
			<div class="selected_os" id="selected_os{{$host->id}}"  style="display:inline-block"></div>
    		<div class="selected_ver" id="selected_ver{{$host->id}}" style="display:inline-block"></div>
    		<div class="selected_architecture" id="selected_arch{{$host->id}}" style="display:inline-block"></div>
    		<div class="selected_protocol" id="selected_pro{{$host->id}}" style="display:inline-block"></div>
			</font>
		</div>
		</div>
		@endforeach

   


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
		<button id="submitTab" type="submit" value="Submit"  class="btn btn-primary btn pull-right" text="Submit">
				Submit</button>
		</div>
</div>	
</div>
		
{{ Form::close() }}	
</div>

</body>
<style>
.blockquote {
	text-align:center;
	padding-left:25%;
	font-family: Arial;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	line-height: 36px;
}
.ui-tabs .ui-tabs-panel {
	
	padding: 0em 0em;
	
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
	background-color: #e7e7e7;
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
	padding-top:5%;
	position:relative;
	height:80%;
	
}

.submit-btn{
	position:relative;
	height:20%;
	padding-top:5%;
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
		url("/nlab/images/arrowdown.gif")
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
function myFunction(selectObj,UId) {
	var id = selectObj.value;
// 	alert('selected_os'+UId);
//	alert(selectObjid );
	osId=selectObj.options[selectObj.selectedIndex].getAttribute('osUId');
	
    $.get('/nlab/user/host/installation/ajax-osver?id=' + osId,function(data){
		$version_dd_name = "versions"+UId;
		// alert($version_dd_name);
		$('#versions'+UId).empty();
		$('#versions'+UId).append('<option value="" disabled selected>'+"Select"+'</option>');
		$.each(data,function(sample,versnObj){
		$('#versions'+UId).append('<option verUId="'+versnObj.id+'" value="'+versnObj.id+'" text="'+versnObj.version+'">'+versnObj.version+'</option>');
		});
		});

    //alert(selectObj.options[selectObj.selectedIndex].text);
    document.getElementById('selected_ver'+UId).innerHTML="";
	document.getElementById('selected_os'+UId).innerHTML="Selected  :  "+selectObj.options[selectObj.selectedIndex].text;
    }


function selectedList(selVerObj,UId) {

	var selectedVersion=selVerObj.options[selVerObj.selectedIndex].text;
	//alert(selectedVersion);
// 	var dname=document.getElementById('os'+UId).options[document.getElementById('os'+UId).selectedIndex].text;
    document.getElementById('selected_ver'+UId).innerHTML=selectedVersion;
//     alert("architecture"+UId);
 
    //var arc_value = document.querySelector('[name=architecture]:checked').value;
    var selected_architecture=document.querySelector('[name='+'architecture'+UId+']:checked').value;
    document.getElementById('selected_arch'+UId).innerHTML =' on  '+selected_architecture;
	
    var selected_protocol=document.querySelector('[name='+'protocol'+UId+']:checked').value;
    document.getElementById('selected_pro'+UId).innerHTML =' using '+selected_protocol;
    
	}





function getArcSelected(){
	var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
	var selected_architecture=document.querySelector('[name='+'architecture'+UId+']:checked').value;
	
	 if(document.getElementById('selected_arch'+UId).innerHTML!="" && document.getElementById('selected_pro'+UId).innerHTML != ""){
		 document.getElementById('selected_arch'+UId).innerHTML ='on  '+selected_architecture;
	 }
	
}


function getProSelected(){

	var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
	var selected_architecture=document.querySelector('[name='+'protocol'+UId+']:checked').value;
	 
	 if(document.getElementById('selected_arch'+UId).innerHTML != "" && document.getElementById('selected_pro'+UId).innerHTML != ""	){
		 document.getElementById('selected_pro'+UId).innerHTML ='using '+selected_architecture;
	 }
}


//$("input:radio[name="+"architecture"+"]").click(function() {
//	alert(UId);
// var value = $(this).val();
// alert("iam in");
// var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
// alert(UId);
// document.getElementById('selected_arch'+UId).innerHTML=value;

//});


//  $('#versions'+ver).on('change',function(e){
// 	 alert("iam here");
// // // 	console.log(e);
//  	var name = $('#versions'+ver 'option:selected').text();
// // 	var sw_name = $('#os option:selected').text();
// // 	alert(name);
// // 	console.log(sw_name);
	
// document.getElementById("demo").innerHTML = sw_name +"   "+name;

// 	});

</script>

@stop