@extends('layouts.default')
@section('central_pane')



<head>
<link rel="stylesheet"
	href="/nlab/css/jquery-ui.css">

<script type="text/javascript"
	src="/nlab/js/jquery.min.js"></script>
<script src="/nlab/js/jquery-1.9.1.js"></script>
<script src="/nlab/js/jquery-ui.js"></script>


<script src="/nlab/js/resourcesInfo.js"></script>

</head>
<body onLoad>
<div class="container">
{{ Form::open(array('url' => 'user/test/dotInstallOptions', 'class'=>'form-Div')) }}

	<div class="row selection">
		<div class="col-md-4 column">
		</div>
		<div class="col-md-4 column">TestBeds
		<select name="testbed" id="testbed" onchange="fetchTestBed(this)">
					@foreach($testbeds as $testbed)
					<option value="{{$testbed->id}}">{{$testbed->name}}</option>
					@endforeach
				</select>
		</div>
		<div class="col-md-4 column">
		</div>
	</div>
	
	<div class="row selectioncontainer">
		<div id="tabs" >
		
		<ul class="menu-header">
			<li><a href="#hostsInfo" UId="hosts">HOSTS</a></li> 
			<li><a href="#filersInfo" UId="filers">FILERS</a></li> 
		</ul>
		
		<div id="hostsInfo" class="menu-body" >
		<div class="row tableCon">
		<table id="STBTable" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        <thead>
            <tr >
						<th class="sorting_asc sorting">
							Model
						</th>
						<th>
							IPAddress
						</th>
						<th>
							MACAddress
						</th>
						
						<th>
							HBA
						</th>
						<th>
							OS
						</th>
						<th>
						   ContainerTB
						</th>
						
						
            </tr>
        </thead>
		
		<tbody>
            
        </tbody>
		
		</table>
		</div>
		</div>
		<div id="filersInfo" class="menu-body" >
		<div class="row tableCon">
		<table id="STBTableFiler" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        <thead>
            <tr >
						<th class="sorting_asc sorting">
							IPAddress
						</th>
						<th>
							Mode
						</th>
						<th>
							MACAddress
						</th>
						
						<th>
						   ContainerTB
						</th>
						
						
            </tr>
        </thead>
		
		<tbody>
            
        </tbody>
		
		</table>
		</div>
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
		<div id="submitTab"><a id="modal-659891" href="#modal-container-659899" role="button" class="btn btn-primary btn pull-right" data-toggle="modal" onclick="resourcesConfirm()">Submit</a></div>
		</div>
</div>	
</div>

<div class="STBmodalContainer"></div>
{{ Form::close() }} 
</div>
</body>
<style>
<style>
.mdl {
	font-family: 'Arial Narrow', Arial, sans-serif;
	font-size: 17px;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	margin-top: 0;
	
}
.mdl2 {
	font-family: 'Arial Narrow', Arial, sans-serif;
	font-size: 17px;
	margin-top: 5px;
	font-variant: normal;
	font-weight: bold;
	font-style: italic;
}
.modal-body{
	padding-top:0px;
}
.modal{
	padding-top:0%;
	padding-down:20%;
	
	padding-left:0%;
	padding-right:0%;
}
.modal-dialog {
  position: relative;
  height: 65%;
 
  margin: 30px auto;
}
table.dataTable thead .sorting {
  background-image: url("/nlab/images/sort_both.png");
  background-repeat: no-repeat;
  background-position: center right;
  cursor: pointer;
}
table.dataTable thead .sorting_desc {
  background-image: url("/nlab/images/sort_desc.png");
  background-repeat: no-repeat;
  background-position: center right;
  cursor: pointer;
}
table.dataTable thead .sorting_asc {
  background-image: url("/nlab/images/sort_asc.png");
  background-repeat: no-repeat;
  background-position: center right;
  cursor: pointer;
}
#nextBtn{
position:relative;
height :30px;
width:100px;
margin:200px 0px ;

float: right;
}
.dataTables_filter label {
   float:right
}

.pagination {
   margin-top:0;
   float:right;
}
.form-Div{
	position:relative;
	height:100%;
}
.selectioncontainer{
	
	padding-top:5%;
	position:relative;
	
	
}
.tableContainer{
	position:relative;
	height:80%;
	overflow:auto;
}
.submit-btn{
	position:relative;
	height:20%;
}
.sub-btn{
position:relative;
padding-right:0px;	
}
</style>
<script>
var hostsIP=new Array();
var filersIP=new Array();
var hostsIP_new=new Array();
var filersIP_new=new Array();
$(function() {
 $("#testbed").val($("#testbed option:first").val());
 var option = $(this).find('option:selected').val();
//alert(option);
 $.ajax({ 
		type: "GET", 
		url: "/nlab/user/test/resourcesInfo", 
		data :{'jsondata':option},
		dataType: "JSON",
		success: function(data){
			//var obj = $.parseJSON(data);
			//alert(obj);
			console.log("sucess");
			//console.log(data.TBHostDetails);
			
			$.each(data.TBHostDetails,function(i,hostInfo){
					//console.log(hostInfo.IP);
					hostsIP.push(hostInfo.IPAdress);
					$('#STBTable').append('<tr><th>'+hostInfo.model+'</th><th>'+hostInfo.IPAdress+'</th><th>'+hostInfo.MAC+'</th><th>'+hostInfo.HBA+'</th><th>'+hostInfo.osType+'</th><th>'+hostInfo.conatainerTB+'</th></tr>');

					});
					
					$.each(data.TBFilerDetails,function(i,filerInfo){
					//console.log(filerInfo.IPAddress);
					filersIP.push(filerInfo.IPAddress);
					$('#STBTableFiler').append('<tr><th>'+filerInfo.IPAddress+'</th><th>'+filerInfo.mode+'</th><th>'+filerInfo.MAC+'</th><th>'+filerInfo.conatainerTB+'</th></tr>');

					});
			
	      }
	   
	   
		}) ;
});
function fetchTestBed(testBed){
	var id = testBed.value;
	//alert("iam new");
	//alert(id);
	$("#STBTable > tbody").html("");
	$("#STBTableFiler > tbody").html("");
	
//var value = $('#dropDownId').val()
 $.ajax({ 
		type: "GET", 
		url: "/nlab/user/test/resourcesInfo", 
		data :{'jsondata':id},
		dataType: "JSON",
		success: function(data){
			//var obj = $.parseJSON(data);
			//alert(obj);
			console.log("sucess");
			//console.log(data.TBHostDetails);
			hostsIP.length=0;
			filersIP.length = 0;
			$.each(data.TBHostDetails,function(i,hostInfo){
					//console.log(hostInfo.IP);
					
					hostsIP.push(hostInfo.IPAdress);
					$('#STBTable').append('<tr><th>'+hostInfo.model+'</th><th>'+hostInfo.IPAdress+'</th><th>'+hostInfo.MAC+'</th><th>'+hostInfo.HBA+'</th><th>'+hostInfo.osType+'</th><th>'+hostInfo.conatainerTB+'</th></tr>');

					});
					
					$.each(data.TBFilerDetails,function(i,filerInfo){
					//console.log(filerInfo.IPAddress);
					
					filersIP.push(filerInfo.IPAddress);
					$('#STBTableFiler').append('<tr><th>'+filerInfo.IPAddress+'</th><th>'+filerInfo.mode+'</th><th>'+filerInfo.MAC+'</th><th>'+filerInfo.conatainerTB+'</th></tr>');

					});
			
			
	      }
	   
	   
		}) ;
}
function resourcesConfirm(){
	
    $('.STBmodalContainer').empty();
	 $('.STBmodalContainer').append(
					
					'<div class="modal fade" id="modal-container-659899" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Confirmation'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								'<h2 class="mdl2">'+
								     'you chose the following'+
									 '</h2>'+
								'<font class="mdl">'+
								     'Hosts'+
									 '</font>'+
									'<div id="hosts">'+
									
									'</div>'+
									'<font class="mdl">'+
								     'Filers'+
									 '</font>'+
									'<div id="filers">'+
									
								'	</div>'+
								'</div>'+
								'<div class="modal-footer">'+
									 '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
 '<input type="submit" value="Reserve" class="btn btn-primary">'+
										'</div>'+
							'</div>'+
							
						'</div>'+  
						
					'</div>');
        
	document.getElementById('hosts').innerHTML="";
	document.getElementById('filers').innerHTML="";
	var hostsInfo="";
	var filersInfo="";
	for	(index = 0; index < hostsIP.length; index++) {
    hostsInfo = hostsInfo+" * "+hostsIP[index]+"<br/>";
	}
	for	(index = 0; index < filersIP.length; index++) {
    filersInfo = filersInfo+" * "+filersIP[index]+"<br/>";
	}
 if(hostsInfo!=""){
			 document.getElementById('hosts').innerHTML=hostsInfo;
			 }
			 else{
				 document.getElementById('hosts').innerHTML="Hosts not chosen";
			 }
			 if(filersInfo!=""){
 			 document.getElementById('filers').innerHTML=filersInfo;
			 }
			 else{
			document.getElementById('filers').innerHTML="Filers not chosen";
			 }	
	//console.log("iam in confilrm");
	//console.log(hostsIP);
    //console.log(filersIP);
}
</script>
<style>
.tableCon{
	margin-right:0px;
	margin-left:0px;
}
.selection{
	position:relative;
	height:15%;
	padding-top:3%;
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
	height:13%;
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
	padding-top:2%;
	position:relative;
	height:65%;
	
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
@stop