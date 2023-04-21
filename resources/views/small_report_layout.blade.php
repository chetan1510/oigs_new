<!DOCTYPE html>
<html lang="en">
    <head>
        <title>OIGS</title>
        <?php $version = "1.0.2"; ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Combo&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{url('/assets/css/fonts.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('/assets/css/small_report.css?v='.$version)}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}" />
        <style type="text/css">

            
        </style>
    </head>
    <body style="width:1020px;">
        @yield('content')
    </body>
</html>