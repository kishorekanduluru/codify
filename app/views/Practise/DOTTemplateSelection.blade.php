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
<body>



<div class="form-Div">

<div class="container">
{{ Form::open(array('url' => 'user/test/DOT/resourcesView', 'class'=>'form-Div')) }}

<div class="row selectioncontainer">

<table id="example" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">
        <thead>
            <tr >
						<th class="sorting_asc sorting">
							JOBID
						</th>
						<th>
							JOBName
						</th>
						<th>
							createdAT
						</th>
						<th>
							updatedAt
						</th>
						<th>
							Status
						</th>
						<th>
							Mark For Install
						</th>
						
						
            </tr>
        </thead>
         
        <tbody>
					@foreach ($resources as $resource)
     

				<tr>
					<td>
						{{ $resource->id}}
					</td>
					<td>
					<a id="{{ $resource->id}}" href="#modal-container"  data-toggle="modal" onclick="getJobDetails(this,{{ $resource->id}})">{{ $resource->job_name }}</a>
						
					</td>
					<td>
						{{ $resource->created_at}}
					</td>
					
					<td>
						{{ $resource->updated_at}}
					</td>
					
					<td style="width: 100px; ">
					{{ $resource->status }}
					</td>
					
					<td style="width: 100px; ">
					<a id="{{ $resource->id}}" href="#modal-container"  data-toggle="modal" onclick="getJobDetails(this,{{ $resource->id}})">
					<input type="checkbox" name="resource[]" onchange="selectCheckbox({{ $resource->id }})" id="{{ $resource->id }}" value="{{$resource->id}}" >
					</a>
					
					</td>
					
					
				</tr>
				@endforeach
					
				</tbody>
			</table>
<input type="hidden" name="selJob_id" id="selJob_id" value="" />
</div>
<div class="modalContainer"></div>
<div class="checkModalContainer"></div>
<div class="row submit-btn">
		<div class="col-md-2 column">
		</div>
		<div class="col-md-6 column">
		</div>
		<div class="col-md-4 column sub-btn">
		<a id="modal-65000" href="#modal-container-65000" role="button" class="btn btn-primary btn pull-right" data-toggle="modal" onclick="resourcesConfirm()">Submit</a>
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
	
 

                function selectCheckbox(UId) { 
				
				//document.getElementById("list").value = UId;
					//('input[name="list"]').val(UId);
					$('#selJob_id').val(UId);
					
					$('.modalContainer').empty();
	
	
			$('.checkModalContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal modal-wide fade" id="modal-container" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Confirmation - JobDetails'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								
								+'<div class="row selectioncontainer">'

+'<table id="HostDetails" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        +'<thead>'
            +'<tr >'
						+'<th class="sorting_asc sorting">'
							+"HOSTIP"
						+'</th>'
						+'<th>'
							+"OS Name"
						+'</th>'
						+'<th>'
							+"Version"
						+'</th>'
						
						+'<th>'
							+"Architecture"
						+'</th>'
						+'<th>'
							+"Protocol"
						+'</th>'
						
						
						
						
            +'</tr>'
        +'</thead>'
		
		
		//sample
		   +'<tbody>'
            
        +'</tbody>'
		
		
         
        
					
			+'</table>'+

								
								'</div>'+
								'<div class="modal-footer">'+
									 '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
 '<input type="submit" value="Fetch" class="btn btn-primary">'+
										'</div>'+
							'</div>'+
							
						'</div>'+  
						
					'</div>'+
					
				'</div>'+
			'</div>'+
		'</div>'+
		'</div>');
				
				}

function getJobDetails(selectedJob,UId){
	var jobId = $(selectedJob).attr('id');
	$('#selJob_id').val(UId);
	$('.modalContainer').empty();
	
	
	$('.modalContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal modal-wide fade" id="modal-container" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Confirmation - JobDetails'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								
								+'<div class="row selectioncontainer">'

+'<table id="HostDetails" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        +'<thead>'
            +'<tr >'
						+'<th class="sorting_asc sorting">'
							+"HOSTIP"
						+'</th>'
						+'<th>'
							+"OS Name"
						+'</th>'
						+'<th>'
							+"Version"
						+'</th>'
						
						+'<th>'
							+"Architecture"
						+'</th>'
						+'<th>'
							+"Protocol"
						+'</th>'
						
						
						
						
            +'</tr>'
        +'</thead>'
		
		
		//sample
		   +'<tbody>'
            
        +'</tbody>'
		
		
         
        
					
			+'</table>'+

								
								'</div>'+
								'<div class="modal-footer">'+
									 '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
 '<input type="submit" value="Fetch" class="btn btn-primary">'+
										'</div>'+
							'</div>'+
							
						'</div>'+  
						
					'</div>'+
					
				'</div>'+
			'</div>'+
		'</div>'+
		'</div>');
	
	$.ajax({ 
		type: "GET", 
		url: "/nlab/user/test/getHostDetails", 
		data :{'jsondata':jobId},
		dataType: "JSON",
		success: function(data){
			$.each(data.HostDetails,function(i,hostInfo){
					//console.log(hostInfo.IP);
					$('#HostDetails').append('<tr><th>'+hostInfo.IPAdress+'</th><th>'+hostInfo.osType+'</th><th>'+hostInfo.osVersion+'</th><th>'+hostInfo.architecture+'</th><th>'+hostInfo.protocol+'</th></tr>');

					});
			console.log('Success!');
			console.log(data);
	      }
	   
	   
		}) ;
	
	
	
	
	
		
		
		
		
	
}
</script>

</html>
@stop