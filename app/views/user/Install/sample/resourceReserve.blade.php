@extends('layouts.default')
@section('central_pane')
<html lang="en">
<head>
<script type="text/javascript" src="/nlab/css/dataTables.responsive.css"></script>
<script type="text/javascript" src="/nlab/js/dataTables.responsive.js"></script>	
</head>

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
	padding-top:10%;
	
	padding-left:20%;
	padding-right:20%;
}
.modal-dialog {
  position: relative;
  width: 65%;
 
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
	padding-top:10%;
	position:relative;
	height:80%;
	
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
<body>



<div class="form-Div">

<div class="container">
{{ Form::open(array('url' => 'user/host/installation', 'class'=>'form-Div')) }}

<div class="row selectioncontainer">

<table id="example" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">
        <thead>
            <tr >
						<th class="sorting_asc sorting">
							IP
						</th>
						<th>
							DNS
						</th>
						<th>
							Owner
						</th>
						<th>
							Custodian
						</th>
						<th>
							Status
						</th>
						<th>
							Mark For Install
						</th>
						<th>
							Type
						</th>
						
            </tr>
        </thead>
         
        <tbody>
					@foreach ($resources as $resource)
     

				<tr>
					<td style="width: 140px; ">
						{{ $resource->ip }}
					</td>
					<td style="width: 300px; ">
						{{ $resource->DNS }}
					</td>
					<td>
						PuneetM
					</td>
					
					<td>
						Kugesh v
					</td>
					
					<td style="width: 100px; ">
					{{ $resource->status }}
					</td>
					
					<td style="width: 100px; ">
					<input type="checkbox" name="resource[]" id="{{ $resource->id }}" value="{{$resource->id}}" >
					</td>
					
					<td style="width: 80px; ">
					{{ $resource->type }}
					</td>
				</tr>
				@endforeach
					
				</tbody>
			</table>

</div>
<div class="modalContainer"></div>
<div class="row submit-btn">
		<div class="col-md-2 column">
		</div>
		<div class="col-md-6 column">
		</div>
		<div class="col-md-4 column sub-btn">
		<a id="modal-659890" href="#modal-container-659890" role="button" class="btn btn-primary btn pull-right" data-toggle="modal" onclick="resourcesConfirm()">Submit</a>
		</div>
	</div>
{{ Form::close() }} 
</div>




		
		
		  
</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( );
} );
$.getScript('/nlab/js/jquery.dataTables.min.js',function(){
	  $.getScript('/nlab/js/dataTables.bootstrap.js',function(){
	     $('#example').dataTable();
	  });
	});
function resourcesConfirm(){
 //alert("iam there");
 var chks=document.getElementsByName('resource[]');
    
	var hasChecked=false;
	for(var i=0;i<chks.length;i++)
	{

		if(chks[i].checked){
        hasChecked=true;

        $('.modalContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal fade" id="modal-container-659890" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
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
						
					'</div>'+
					
				'</div>'+
			'</div>'+
		'</div>');
        
        break;
		}
	}
	if(hasChecked==false)
	{
		$('.modalContainer').empty();
		alert("Please Select the options");
		return;
	} 
	 
	var values = new Array();
	$.each($("input[name='resource[]']:checked"), function() {
	  values.push($(this).val());
	  // or you can do something to the actual checked checkboxes by working directly with  'this'
	  // something like $(this).hide() (only something useful, probably) :P
	});

	var selectedResources=JSON.stringify(values);
    //alert(selectedResources);
	$.ajax({ 
		type: "GET", 
		url: "/nlab/user/resourcesConfirmation", 
		data :{'jsondata':selectedResources},
		dataType: "JSON",
		success: function(data){
			document.getElementById('hosts').innerHTML="";
			document.getElementById('filers').innerHTML="";
			var hostsInfo="";
			var filersInfo="";
			$.each(data,function(i,resources){
				//console.log(resources);
				
				$.each(resources,function(i,resource){
					if(resource.type=="host"){
						hostsInfo=hostsInfo+" * "+resource.ip+"<br/>";

						
					}
					else if(resource.type){
						filersInfo=filersInfo+" * "+resource.ip+"<br/>";
					
					}
					 
					});

				});
			
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
			//console.log('Success!');
			console.log(data);
	      }
	   
	   
		}) ;



	


	
}

</script>

</html>
@stop