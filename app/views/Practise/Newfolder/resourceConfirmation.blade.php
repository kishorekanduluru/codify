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
	
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

 
  
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/scripts.js"></script>
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
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			
			
			<div id="modal-container-545418" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
							<h4 class="modal-title" id="myModalLabel">
								Confirmation
							</h4>
						</div>
						<div class="modal-body">
							
hosts 

@foreach ($hosts as $host)
    <p>{{ $host->ip }}</p>
    
@endforeach

<!-- @if(Session::has('selected_List')) -->
<!--     <div class="alert-box success"> -->
       
             
<!--         </h2> -->
<!--     </div> -->
<!-- @endif -->
    

filers
@foreach ($filers as $filer)
    <p>{{ $filer->ip }}</p>
@endforeach
						
						</div>
						<div class="modal-footer">
							 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">confirm</button>
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
	</div>
</div>
</body>
</html>