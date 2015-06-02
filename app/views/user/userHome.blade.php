@extends('layouts.default')
@section('central_pane')
<style>
.italic {
    font-style: italic;
}
.selectioncontainer{
	
	position:relative;
	height:80%;
	
}
.btns{
	position:relative;
	height:20%;
}
.panel-title{
	font-size:20px;
	text-align:center;
}
.col-lg-12{
	position:relative;
	height:100%;
}
.selection-box{
	position:relative;
	overflow:hidden;
	height:100%;
	  }

.panel-heading{
	text-align:center;
	  background-color: #f5f5f5;
	   border-bottom: 1px solid #ddd;
	position:relative;
	height:10%;
}
.panel-body{
	
	position:relative;
	height:80%;
	padding:20%;
	padding:0px;

}
.panel-footer{
	
	
	position:relative;
	height:10%;
}
h3{
	font-family: 'Arial Narrow', Arial, sans-serif;
	font-size: 20px;
	font-style: normal;
	font-variant: small-caps;
	font-weight: bold;
	
}
.options{
	
	
	margin:0 auto;
	position:relative;
	width:50%;
	height:40%;
	left:45%;
	top:40%;
	
	margin-left:-10%;
}
.backbtn{
	position:relative;
	padding-left:0px;
	padding-right:0px;
	top:30%;
	
}
.Nextbtn{
	position:relative;
	padding-left:0px;
	padding-right:0px;
	top:30%;
	
}
.form-Div{
	position:relative;
	height:100%;
}
.btn-lg{
padding:6px 12px;

}
</style>
<body>
<div class="form-Div">
 {{ Form::open(array('url' => '/user/taskSelection', 'class'=>'form-Div')) }}
<div class="container">
    
<div class="row selectioncontainer">

<div class="panel panel-primary selection-box">
<div class="panel-heading">
					<h3 class="panel-title">
						TASK SELECTION
					</h3>
</div>
<div class="panel-body">
			<div class="options"> 		
			<font size="5px" class="serifbtn"> 
	  {{ Form::radio('task_selection', 'Install only', true) }} Install only
	<br>
	{{ Form::radio('task_selection', 'Install & Test') }} Install and Test
    
    </font>
	</div>
				</div>
				<div class="panel-footer">
				<font class="italic">
					*  Select the task you want to do
				</font>	
				</div>
</div>
		</div>
	<div class="row btns">
		
		<div class="col-md-2 column backbtn">
		<button type="button" class="btn disabled btn-primary btn-lg ">Back</button> 
		</div>
		<div class="col-md-6 column">
		&nbsp;
		</div>
		<div class="col-md-4 column Nextbtn">
		     <font size="10px" class="serifbtn"> 
			 
			 
			 <input type="submit" value="Next"class="btn btn-primary btn-lg pull-right">
			 </font>
		</div>
	</div>

	</div>
{{ Form::close() }}
</div>
<body>
		
@stop