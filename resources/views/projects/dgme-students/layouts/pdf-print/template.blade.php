<?php
$render = $render ?? 'print'
?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="{{asset('mainframe/templates/admin/bootstrap/css/bootstrap.min.css')}}"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset('projects/dgme-students/css/print-pdf.css')}}" type="text/css"/>
    <title>
        @section('head-title')
            {{setting('app-name')}}
        @show
    </title>

    @section('head')
    @show
</head>
<body>
<div class="container">
    @if($render == 'print')
        @include('mainframe.layouts.default.includes.print-btn')
    @endif
    <div class="row">
        <div class="col-md-12" align="center">
            <div class="header-line-up"></div>
            <table class="no-border no-padding" width="100%">
                <tr>
                    <td>
                        <img src="{{asset('projects/dgme-students/images/bangladesh.png')}}"
                             style="width: 113px; float: right; padding-right: 15px" alt="">
                    </td>
                    <td align="center">
                        <h2 style="text-align: center">{{__('common.agency_full_name')}}</h2>
                        <h4 style="text-align: center">{{__('common.gov_of_bangladesh')}}</h4>
                    </td>
                    <td>
                        <img src="{{asset('projects/dgme-students/images/dgme.png')}}" class="pull-right"
                             style="margin-top: 2%; border:none!important;width: 120px;" alt="">
                    </td>
                </tr>
            </table>

        </div>
    </div>
    <div class="row">
        {{--top table--}}
        @section('top')
        @show
    </div>
    <div class="row">
        {{--middle table--}}
        @section('content-top')
        @show
    </div>
    <div class="row">
        {{--middle table--}}
        @section('content')
        @show
    </div>
    <div class="row">
        {{--bottom table--}}
        @section('content-bottom')
        @show
    </div>
    <div class="row">
        {{--tc section--}}
        <div class="col-md-12" id="footer">
            @section('footer')
            @show
            {{-- <hr>--}}
        </div>
    </div>
</div>

</body>
@section('js')
@show