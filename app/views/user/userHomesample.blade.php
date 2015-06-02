@extends('layouts.default')
@section('central_pane')





<style>
h1 {
    color: maroon;
    margin-left: 40px;
	
} 
</style>





<body>
 <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 column">
		
		<div class="selection-container">
		
		<div class="selection-header"">
		 <font size="4px" class="serif" font-variant="small-caps"> 
		  Task Selection
	 <br>&nbsp;&nbsp;
	</font>
	<font size="4px" class="serifbtn"> 
	{{ Form::radio('task_selection', 'Install only', true) }} Install only
	<br>&nbsp;&nbsp;
	{{ Form::radio('task_selection', 'Install & Test') }} Install and Test
    <br>
    </font>
	</div>
		</div>
	</div>
	<div class="row clearfix">
		
		<div class="col-md-2 column">
		<button type="button" class="btn disabled btn-primary btn-lg">Back</button> 
		</div>
		<div class="col-md-6 column">
		&nbsp;
		</div>
		<div class="col-md-4 column">
		     <font size="10px" class="serifbtn"> 
			 
			 
			 <button type="button" class="btn btn-primary btn-lg pull-right">Next</button>
			 </font>
		</div>
	</div>
		
		</div>
	



</body>
<style>

</style>
</html>
@stop