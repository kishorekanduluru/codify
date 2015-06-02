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
	font-weight: 600;
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
	height:43%;
	left:43%;
	top:45%;
	
	margin-left:-10%;
}

.select-Options{
	margin:0 auto;
	position:relative;
	width:75%;
	height:20%;
	left:30%;
	top:28%;
	padding-top:3%;
	
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
.selnresources{
	margin-right:6px;
}
</style>
<body>
<div class="form-Div">
 {{ Form::open(array('url' => '/user/test/DOT/template_choice', 'class'=>'form-Div')) }}
<div class="container">
    
<div class="row selectioncontainer">

<div class="panel panel-primary selection-box">
<div class="panel-heading">
					
						Template Driven Install for other options
					
</div>
<div class="panel-body">
			<div class="options"> 		
			<font size="4px" class="serifbtn"> 
	  <div>{{ Form::radio('template_choice', 'YES', true) }}	Yes,  Show Template Options</div>
	
	 <div>{{ Form::radio('template_choice', 'NO') }}	No,	Continue Manual Selection</div>
	  
       
    </font>
	</div>
	
	</div>
				<div class="panel-footer">
				<font class="italic">
					*
				</font>	
				</div>
</div>
		</div>
	<div class="row btns">
		
		<div class="col-md-2 column backbtn">
		 
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