<!DOCTYPE html>
<html>
<head>
    <title>Academy</title>
    <meta charset="utf-8">
    <meta name=viewport content="initial-scale=1">

    @if(env('APP_ENV') == "production" || env('APP_ENV') == "online")
        <link rel="stylesheet" type="text/css" href="{{url('assets/dist/css/fonts.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/dist/css/combined.min.css')}}" />
        <script src="{{url('assets/dist/js/jquery.min.js')}}" type="text/javascript"></script>
    @else

        <link rel="stylesheet" type="text/css" href="{{url('/assets/css/fonts.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/plugins/bootstrap/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{url('assets/plugins/simple-ine/css/simple-line-icons.css')}}" />
    	<link rel="stylesheet" type="text/css" href="{{url('/assets/css/custom.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" />
        <link rel="stylesheet" href="{{url('assets/plugins/admin/scripts/ui-cropper.css')}}" type="text/css">
        <link rel="stylesheet" href="{{url('assets/plugins/admin/scripts/jquery-cropper/croppie.css')}}" type="text/css">
        <script src="{{url('assets/plugins/jquery.min.js')}}" type="text/javascript"></script>
    @endif

</head>
<body ng-app="app">
    <div class="wrapper">
        <div class="page-menu">
            @include('page_menu')
        </div>
        <div class="main">
            @include('page_header')
            @yield('sub_header')
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>


    <script type="text/javascript">
        var base_url = "{{url('/')}}";

        @if(Auth::check())
            var api_key = "{{ Auth::user()->api_key }}";
            var client_id = "{{ Auth::user()->client_id }}";
            var currency_format = "INR";
        @else
            var api_key = "";
            var client_id = "";
            var currency_format = "INR";
        @endif
        
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    
    @if(env('APP_ENV') == "production" || env('APP_ENV') == "online")
        <script type="text/javascript" src="{{url('assets/dist/js/bundle.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/dist/js/combined.min.js')}}"></script>
    @else
        <script src="{{url('assets/plugins/popper.js')}}"></script>
        <script src="{{url('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/plugins/bootbox.min.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{url('assets/plugins/echarts.min.js')}}"></script>

        <!--Begin Angular scripts -->
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/angular.min.js')}}" ></script>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/angular-sanitize.js')}}" ></script>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/ng-file-upload.min.js')}}" ></script>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/ng-file-upload-shim.min.js')}}" ></script>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/jcs-auto-validate.js')}}" ></script>
        <script src="{{url('assets/plugins/admin/scripts/jquery-cropper/croppie.js')}}" type="text/javascript"></script>
        <script src="{{url('assets/plugins/admin/scripts/ui-cropper.js')}}" type="text/javascript"></script>

        <?php $version = "1.0.2"; ?>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/core/custom.js?v='.$version)}}"></script>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/core/app.js?v='.$version)}}" ></script>
        <script type="text/javascript" src="{{url('assets/plugins/admin/scripts/core/services.js?v='.$version)}}" ></script>
        @include('admin_angular')

    @endif

    @yield('footer_scripts')

</body>

</html>