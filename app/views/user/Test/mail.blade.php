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
<?php $Hostdetails=new Collection;
$Hostdetails=unserialize(Session::get('HostDetails'));
$FilerDetails=new Collection;
$FilerDetails=unserialize(Session::get('FilerDetails'));
?>
@foreach ($Hostdetails as $host)
<h3><li><a href="#{{$host->hostId}}" UId="{{$host->hostId}}">{{ $host->IPAdress }}</a></li> </h3>
@endforeach
<br>		
<br>		
<h3>FilerOSInstallation</h3>
@foreach ($FilerDetails as $filer)
<h3><li><a href="#{{$filer->filerId}}" UId="{{$filer->filerId}}">{{ $filer->IPAddress}}</a></li> </h3>
@endforeach
<br><br>
<p class="thick">Regards<br>
nLAB Team</p>
</body>
</html>