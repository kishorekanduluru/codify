@extends('layouts.defaultWithMenu')
@section('central_pane')
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
	<link href="../../css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

 
  
	<script type="text/javascript" src="../../js/jquery.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/scripts.js"></script>
</head>
<style>

#nextBtn{
position:relative;
height :30px;
width:100px;
margin:200px 0px ;

float: right;
}
</style>
<body>
{{ Form::open(array('url' => '/user/confirmSelection')) }}

<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
               <th>
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
						<th style="width: 100px; ">
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
						netapp.com/inghjfgdsgf/khkhfks
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
	</div>

<div id="nextBtn">
   
    <input class="next" type="submit" value="Next" style="height:30px; width: 80px;background-color: rgb(0, 103, 196);color: white;"  onclick="resourcesConfirm()">
  </div>
		</div>
		 {{ Form::close() }}
		 </div>
</body>
<script type="text/javascript">
function resourcesConfirm(){
 alert("iam there");
	var values = new Array();
	$.each($("input[name='resource[]']:checked"), function() {
	  values.push($(this).val());
	  // or you can do something to the actual checked checkboxes by working directly with  'this'
	  // something like $(this).hide() (only something useful, probably) :P
	});
}
}
					</script>
</html>
@stop