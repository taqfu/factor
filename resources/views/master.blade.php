<html>
<head>
    <title>
        Factor
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{asset('index.css')}}" rel="stylesheet">
    <script src="{{asset('jquery-1.12.3.min.js')}}"> </script>
    <script src="{{asset('index.js')}}"></script>
</head>
<body>
    @yield('content')
</body>
</html>
