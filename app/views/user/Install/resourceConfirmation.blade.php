

{{Form::open(array('route' => array('host.install',$data)))}}

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


<!-- slected list string -->
<!-- {{$data}} -->

 <!-- submit buttons -->
 <input class="next" type="submit" value="Confirm" style="height: 30px;width: 80px;background-color: rgb(0, 103, 196);color: white;">

{{ Form::close() }}
