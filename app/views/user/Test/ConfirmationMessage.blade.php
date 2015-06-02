@extends('layouts.default')
@section('central_pane')
<style>
.italic {
    font-style: italic;
}
.selectioncontainer{
	
	position:relative;
	height:60%;
	
}
.btns{
	position:relative;
	height:15%;
	padding-top:5%;
    
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
	height:85%;
	padding:20%;
	padding:0px;

}
.panel-footer{
	
	
	position:relative;
	height:15%;
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
	left:50%;
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

h3 {
	font-family: 'Arial Narrow', Arial, sans-serif;
	font-size: 16px;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	line-height: 6px;
}
.div-options{
	position:relative;
	height:100%;
	width:100%;
}
.radio-container{
	float:right;
	height:100%;
	width:50%;
	padding-top:6%;
	padding-left: 14%;
}.dropdwn-container{
	padding-left: 14%;
  border-right-style: dashed;
  border-right-color: #428bca;
  border-width: 1px;
	padding-top:6%;
	position:absolute;
	height:100%;
	width:50%;
}
h1 {
	font-family: 'Arial Narrow', Arial, sans-serif;
	font-size: 18px;
	font-style: normal;
	font-variant: normal;
	font-weight: bold;
	padding-bottom:10px;
	line-height: 6.5px;
}
</style>
<body>
<div class="form-Div">
 {{ Form::open(array('url' => '/user/taskSelection', 'class'=>'form-Div')) }}
<div class="container">
    
<div class="row btns">
		<div class="col-md-1 column backbtn">
		</div>
		<div class="col-md-11 column">
		 <h3> The job has been successfully queued.Please Refer the emails for further update</h3>
	   </div>
		
	</div>	

	<div class="row selectioncontainer">

<div class="panel panel-primary selection-box">

<div class="panel-body">
			<div class="div-options"> 	
<div class="dropdwn-container">			
<h1>HOSTS OS Installation</h1>

<?php $Hostdetails=new Collection;
$Hostdetails=unserialize(Session::get('HostDetails'));
$FilerDetails=new Collection;
$FilerDetails=unserialize(Session::get('FilerDetails'));
?> 
	 @foreach ($Hostdetails as $host)
<h3><li><a href="#{{$host->hostId}}" UId="{{$host->hostId}}">{{ $host->IPAdress }}</a></li> </h3>
@endforeach
	

    
   
	</div>
	
	  <div class="radio-container">
	  
	  <h1>Filers OS Installation</h1>
			
	@foreach ($FilerDetails as $filer)
<h3><li><a href="#{{$filer->filerId}}" UId="{{$filer->filerId}}">{{ $filer->IPAddress}}</a></li> </h3>
@endforeach
	  </div>
	
	</div>
				</div>
				<div class="panel-footer">
				<font class="italic">
					* 
				</font>	
				</div>
</div>
		</div>

	

	</div>
{{ Form::close() }}
</div>
<body>
		
@stop