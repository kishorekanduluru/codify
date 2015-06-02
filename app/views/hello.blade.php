<body>

@foreach (Session::get('filers') as $filer)
{{$filer->ip}}
 @endforeach
 
 @foreach (Session::get('hosts') as $host)
{{$host->ip}}
 @endforeach
</body>

