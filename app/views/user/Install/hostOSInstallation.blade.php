<font size="4px" class="serifbtn"> 
Architecture
<br>
	{{ Form::radio('arch', 'x86', true) }} x86
	<br>
	{{ Form::radio('arch', 'x86-64') }} x86-64
    <br>
</font>
<br>
<br>



<font size="4px" class="serifbtn"> 
Protocol
<br>
	{{ Form::radio('protocol', 'FC', true) }} FC
	<br>
	{{ Form::radio('protocol', 'FCOE') }} FCOE
    <br>
    {{ Form::radio('protocol', 'iSCSI') }} iSCSI
    <br>
</font>
