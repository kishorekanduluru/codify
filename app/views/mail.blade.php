<!DOCTYPE html>
<html>
<head>
<style>
p.thick {
    font-weight: bold;
}
</style>
</head>
<body>
<h3>Please click on the links for further reference and updates.</h3>

<h3>hostOSInstallation</h3>


@foreach (Session::get('hosts') as $host)
<h3><li><a href="#{{$host->id}}" UId="{{$host->id}}">{{ $host->ip }}</a></li> </h3>
@endforeach
<br>		
<h3>FilerOSInstallation</h3>
@foreach (Session::get('filers') as $filer)
<h3><li><a href="#{{$filer->id}}" UId="{{$filer->id}}">{{ $filer->ip }}</a></li> </h3>
@endforeach


<br><br>
<p class="thick">Regards<br>
nLAB Team</p>
</body>
</html>