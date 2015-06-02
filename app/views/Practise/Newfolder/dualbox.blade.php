@extends('layouts.default')
@section('central_pane')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" > 

	<link rel="stylesheet" href="nlab/lib/google-code-prettify/prettify.css" />
	<link rel="stylesheet" href="nlab/css/style.css" />
	<script type="text/javascript" src="/nlab/js/ multiselect.js"></script>
<script type="text/javascript" src="/nlab/js/dataTables.responsive.js"></script>	

<head> 
  <title>Double List Box</title> 
  <script type="text/javascript"> 
  function addItems() {
     var ai = document.getElementById("availableItems"); 
    var si = document.getElementById("selectedItems"); 
    for (i=0;i<ai.options.length;i++) { 
      if (ai.options[i].selected) { 
        var opt = ai.options[i]; 
        si.options[si.options.length] = new Option(opt.innerHTML, opt.value); 
        ai.options[i] = null; i = i - 1; 
      } 
    } 
  } 
jQuery(document).ready(function($) {
	
	$('#multiselect').multiselect();
});
  function addAll() { 
    var ai = document.getElementById("availableItems"); 
    var si = document.getElementById("selectedItems"); 
    for (i=0;i<ai.options.length;i++) { 
      var opt = ai.options[i]; 
      si.options[si.options.length] = new Option(opt.innerHTML, opt.value); 
    } 
    ai.options.length = 0; 
  } 

  function removeItems() {
    var ai = document.getElementById("availableItems"); 
    var si = document.getElementById("selectedItems"); 
    for (i=0;i<si.options.length;i++) { 
      if (si.options[i].selected) { 
        var opt = si.options[i]; 
        ai.options[ai.options.length] = new Option(opt.innerHTML, opt.value); 
        si.options[i] = null; i = i - 1; 
      } 
    } 
    sortAvailable(); 
  } 

  function removeAll() { 
    var ai = document.getElementById("availableItems"); 
    var si = document.getElementById("selectedItems"); 
    for (i=0;i<si.options.length;i++) { 
      var opt = si.options[i]; 
      ai.options[ai.options.length] = new Option(opt.innerHTML, opt.value); 
    } 
    si.options.length = 0; 
    sortAvailable(); 
  } 

  function moveUp() { 
      var si = document.getElementById("selectedItems"); 
      var sel = si.selectedIndex; 
      if (sel > 0) { 
        var optHTML = si.options[sel].innerHTML; 
        var optVal = si.options[sel].value; 
        var opt1HTML = si.options[sel-1].innerHTML; 
        var opt1Val = si.options[sel-1].value; 
        si.options[sel] = new Option(opt1HTML,opt1Val); 
        si.options[sel-1] = new Option(optHTML,optVal); si.options.selectedIndex = sel -1; 
    } 
  } 

  function moveDown() { 
    var si = document.getElementById("selectedItems"); 
    var sel = si.selectedIndex; 
    if (sel < si.options.length -1) { 
      var optHTML = si.options[sel].innerHTML; 
      var optVal = si.options[sel].value; 
      var opt1HTML = si.options[sel+1].innerHTML; 
      var opt1Val = si.options[sel+1].value; 
      si.options[sel] = new Option(opt1HTML,opt1Val); 
      si.options[sel+1] = new Option(optHTML,optVal); 
      si.options.selectedIndex = sel +1; 
    } 
  } 



  function frmSubmit() {
	  //alert("iam in rey")
	 var selectedItems=[];
	 var selectedList=[];
    var si = document.getElementById("selectedItems"); 
    for (i=0;i<si.options.length;i++) { si.options[i].selected = true; 
	selectedItems.push( si.options[i].value);
	selectedList.push( si.options[i].text);
	} 
	alert(selectedItems);
	alert(selectedList);
	 $('input[name="list[]"]').val(selectedItems);
    document.form1.submit();
 } 
  </script> 

  <style type="text/css"> 
    .btn {width:90px;} 
  </style> 
</head> 
<body> 
<div class="form-Div">
{{ Form::open(array('url' => '/user/test/testcases', 'class'=>'form-Div')) }}

<div class="container">
	<div class="row selectioncontainer">
		<div class="col-md-5 column leftbox" style="float:left;">
		<select id='availableItems'  class="selectionbox"  multiple="multiple">
  <option value='0'>HA Regression</option>
  <option value='1'>HA Portblock </option>
  <option value='2'>Controller Stress</option>
  <option value='3'>HA Combined</option>
  <option value='4'>HA Ports block used</option>
</select>
		</div>
		<div class="col-xs-2 space">
				
	               <div class="btns">
					<button type="button" id="undo_redo_rightAll" class="btn btn-default btn-block" onclick="addAll();"><i class="glyphicon glyphicon-forward"></i></button>
					<button type="button" id="Move Up" class="btn btn-default btn-block" onclick="moveUp();"><i class="glyphicon glyphicon-arrow-up"></i></button>
					<button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block" onclick="addItems();"><i class="glyphicon glyphicon-arrow-right"></i></button>
					<button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block" onclick="removeItems();"><i class="glyphicon glyphicon-arrow-left"></i></button>
					<button type="button" id="Move Down" class="btn btn-default btn-block " onclick="moveDown();" ><i class="glyphicon glyphicon-arrow-down"></i></button>
					<button type="button" id="undo_redo_leftAll" class="btn btn-default btn-block" onclick="removeAll();" ><i class="glyphicon glyphicon-backward"></i></button>
		           </div> 
					<div class="submit">
					<button type="submit" id="submit" class="btn btn-primary btn-block" onclick="frmSubmit();" >Submit</button>
					</div>
</div>
		<div class="col-md-5 column leftbox" style="float:left;">
		<select  multiple="multiple" name="selectedItems" id="selectedItems" class="selectionbox"> 
</select> 
		</div>
	</div>
</div>






<input type="hidden" name="list[]" value="" />
{{ Form::close() }}
</div>
</body> 
<style>
.btns{
	position:relative;
	height:80%;
}
.submit{
	position:relative;
	height:20%;
	margin-top:2%;
}
.form-Div{
	position:relative;
	height:100%;
}
.selectioncontainer{
	height:80%;
	padding-top:5%;
	position:relative;
}
.btn-block {
  display: block;
  width: 100%;
}
.selectionbox{
	position:relative;
	height:100%;
	width:100%;
}
select[multiple], select[size] {
  height: 100%;
  position:relative;
  width:100%;
}
.leftbox{
	position:relative;
	height:100%;
}
.space{
	position:relative;
	margin-top:4%;
	height: 100%;
}
</style>

</html>
@stop