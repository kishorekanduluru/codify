@extends('layouts.default')
@section('central_pane')

<!doctype html>
<html lang="en">


<head>
<link rel="stylesheet"
	href="/nlab/css/jquery-ui.css">

<script type="text/javascript"
	src="/nlab/js/jquery.min.js"></script>
<script src="/nlab/js/jquery-1.9.1.js"></script>
<script src="/nlab/js/jquery-ui.js"></script>


<script src="/nlab/js/filer.js"></script>

</head>

<body onLoad>
<div class="container">

{{ Form::open(array('route' => array('test.dotInstall.filerOptions',$filersIp,$hostsIp),'class'=>'form-Div')) }}
	<div class="row selectioncontainer">
	<div id="tabs">
		<ul class="menu-header">
			
			 @foreach ($TBFilerDetails as $filer)
			<li><a href="#{{$filer->filerId}}" UId="{{$filer->filerId}}">{{ $filer->IPAddress }}</a></li> 
			@endforeach
			
		</ul>

		@foreach ($TBFilerDetails as $filer)
		<div id="{{$filer->filerId}}" class="menu-body" >
		<div class="div-options">
		<div class="div-mode">
		
        
		
				
				<h5>Filer Mode</h5>
		<input type="radio" name="mode{{$filer->filerId}}" value="CMode" id="mode_of{{$filer->filerId}}" onclick="getModeSelected()" checked="checked">CMode<br>
		<input type="radio" name="mode{{$filer->filerId}}" value="7Mode" id="mode_of{{$filer->filerId}}" onclick="getModeSelected()">7Mode<br>
    

				
			
			
        
	  </div>
	    </div>
		<div id="SelectionList{{$filer->filerId}}" class="div-footer">
		<div class="selected_mode" id="selected_mode{{$filer->filerId}}"  style="display:inline-block"></div>
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
.div-mode{
	
margin: 0 auto;
 margin: 0 auto;
  position: relative;
  width: 16%;
  height: 26%;
  left: 50%;
  top: 35%;
  margin-left: -8%;
}

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
	height:87%;
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
	padding:25%;
	position:absolute;
	height:100%;
	
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
	
    
    $.get('installation/ajax-osver?id=' + id,function(data){
		$version_dd_name = "versions"+UId;
		// alert($version_dd_name);
		$('#versions'+UId).empty();
		$('#versions'+UId).append('<option value="" disabled selected>'+"Select"+'</option>');
		$.each(data,function(sample,versnObj){
		$('#versions'+UId).append('<option value="'+versnObj.id+'" text="'+versnObj.version+'">'+versnObj.version+'</option>');
		});
		});

    //alert(selectObj.options[selectObj.selectedIndex].text);
    document.getElementById('selected_ver'+UId).innerHTML="";
	document.getElementById('selected_os'+UId).innerHTML="Selected  :  "+selectObj.options[selectObj.selectedIndex].text;
    }







function getArcSelected(){
	var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
	var selected_architecture=document.querySelector('[name='+'architecture'+UId+']:checked').value;
	
	 if(document.getElementById('selected_arch'+UId).innerHTML!="" && document.getElementById('selected_pro'+UId).innerHTML != ""){
		 document.getElementById('selected_arch'+UId).innerHTML ='on  '+selected_architecture;
	 }
	
}







</script>

</html>
@stop