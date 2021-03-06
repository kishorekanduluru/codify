@extends('layouts.default')
@section('central_pane')
<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!DOCT
<html lang="en">
<meta charset="UTF-8" />
<head>
<script type="text/javascript" src="/nlab/css/dataTables.responsive.css"></script>
<script type="text/javascript" src="/nlab/js/dataTables.responsive.js"></script>	
</head>

<style>
.list{
	position:relative;
	padding-top: 15px;
	padding-bottom: 15px;
	line-height: 20px;
}
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
.modal-title{
	color:black;
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
					<td>
						{{ $resource->ip }}
					</td>
					<td>
						{{ $resource->DNS }}
					</td>
					<td>
						{{ $resource->owner}}
					</td>
					
					<td>
						{{ $resource->custodian}}
					</td>
					
					<td style="width: 100px; ">
					{{ $resource->status }}
					</td>
					
					<td style="width: 100px; ">
					<input type="checkbox" name="resource[]" onchange="selectCheckbox(this)" id="{{ $resource->id }}" value="{{$resource->id}}" >
					</td>
					
					<td style="width: 80px; ">
					{{ $resource->type }}
					</td>
				</tr>
				@endforeach
					
				</tbody>
			</table>
<input type="hidden" name="list[]" value="" />
</div>
<div class="modalContainer"></div>
<div class="row submit-btn">
		<div class="col-md-2 column">
		</div>
		<div class="col-md-6 column">
		</div>
		<div class="col-md-4 column sub-btn">
		<a id="modal-659891" href="#modal-container-659891" role="button" class="btn btn-primary btn pull-right" data-toggle="modal" onclick="resourcesConfirm()">Submit</a>
		</div>
	</div>
{{ Form::close() }} 
</div>




		
		
		  
</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#left_menu").append('<li class="list"><span class="tab">Reservation</span></li>');

   //$( "#left_container" ).empty();
    
} );
$.getScript('/nlab/js/jquery.dataTables.min.js',function(){
	  $.getScript('/nlab/js/dataTables.bootstrap.js',function(){
	     $('#example').dataTable();
	  });
	});
	
 var selectedUnits = [];

                function selectCheckbox(data) {
                    if (selectedUnits.length < 1) {
                        selectedUnits.push(data.value);
                    }
                    else {
                        if (data.checked == true) {
                            if ($.inArray(data.value, selectedUnits) < 0) {
                                selectedUnits.push(data.value);
                            }
                            else {
                                selectedUnits.pop(data.value);
                            }
                        }
                        else {
                            selectedUnits.pop(data.value);
                        }

                    }
				
                }
function resourcesConfirm(){
	//alert("iam called 1");
  //alert(selectedUnits);
 
 
 $('input[name="list[]"]').val(selectedUnits);
 //alert(selectedUnits.length);
 var chks=document.getElementsByName('resource[]');
   
   
	 if(selectedUnits.length <= 0){
		 $('.modalContainer').empty();
		alert("Please Select the options");
		return;
	 
  }
		if(selectedUnits.length > 0)
        {
        $('.modalContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal fade" id="modal-container-659891" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">'+'�'+'</button>'+
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
        
        
		}
	
	 
	 
	var values = new Array();
	$.each($("input[name='resource[]']:checked"), function() {
	  values.push($(this).val());
	  // or you can do something to the actual checked checkboxes by working directly with  'this'
	  // something like $(this).hide() (only something useful, probably) :P
	});
    
	var selectedResources=JSON.stringify(selectedUnits);
	//alert(selectedResources);
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
			//console.log(data);
	      }
	   
	   
		}) ;

<?php 
echo Session::get('key');
?>

	


	
}
 

 
 
</script>

</html>
@stop