<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('projects.dgme-students.layouts.default.includes.analytics')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @section('head-title')
            {{config('app.name')}}
        @show
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('head')
    @show
    @include('mainframe.layouts.default.includes.css')
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition login-page lb-bg">

<div class="clearfix"></div>
<div class="login-box shadow">
    <div class="row">
        <div class="login-box no-margin-t no-margin-b">
            <div class="col-xs-3">
                <img src="{{asset('projects/dgme-students/images/bangladesh.png')}}" class="" alt="" style="width: 90%">

            </div>
            <div class="col-xs-6 text-center">
                <h3 class="no-margin">{{__('common.agency_full_name')}}</h3>
                <h5>{{__('common.gov_of_bangladesh')}}</h5>
            </div>
            <div class="col-xs-3">
                <img src="{{asset('projects/dgme-students/images/dgme.png')}}" class="" alt="" style="width: 100%">

            </div>
        </div>
    </div>
    <div class="login-logo">
        {{config('app.name')}}
    </div>
    <div class="login-box-body">
        @include('mainframe.layouts.default.includes.alerts.messages-top')

        @section('content-top')
        @show

        @section('content')
        @show

        @section('content-bottom')
        @show
    </div>
    @include('mainframe.layouts.default.includes.modals.messages')
    @include('mainframe.layouts.default.includes.modals.delete')
</div>

@include('mainframe.layouts.default.includes..js')
@section('js')
    {{-- js section   --}}
@show
<script>

</script>
</body>
</html>