<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    @include('mainframe.layouts.default.includes.css')
    {{--    <link rel="stylesheet" href="{{asset('projects/vscript/css/print-pdf.css')}}" type="text/css"/>--}}
    <title>
        @section('head-title')
            {{setting('app-name')}}
        @show
    </title>

    @section('head')
    @show

    @section('css')
        <style type="text/css">
            table {
                border-collapse: collapse;
            }
            table td {
                padding: 0px 5px;

            }
            @media print {
                #printPageButton {
                    display: none;
                }
            }

            table, tr, th, td, thead, tbody {
                font-size: 14px !important;
            }
        </style>
    @show
    @include('projects.dgme-students.layouts.default.includes.analytics')
</head>
<body>
<div class="container">
    <div class="row" >
        @include('mainframe.layouts.default.includes.print-btn')
    </div>
    <div class="row">
        <div class="col-md-12" align="center">
            <div class="header-line-up"></div>
            <table class="no-border no-padding" width="80%">
                <tr>
                    <td width="20%" align="left">
                        @section('title-left')
                            <img src="{{asset('projects/dgme-students/images/bangladesh.png')}}" class="img-thumbnail"
                                 style="border:none!important; height: 110px;">
                        @show
                    </td>
                    <td width="60%" align="center" style="vertical-align: middle">
                        @section('title')
                            <h3 align="center">Directorate General of Medical Education (DGME)</h3>
                            <h4 align="center">Government of the People's Republic of Bangladesh</h4>
                        @show

                    </td>
                    <td width="20%" align="right">
                        @section('title-right')
                            <img src="{{asset('projects/dgme-students/images/dgme.png')}}" class="img-thumbnail pull-right"
                                 style="margin-top: 2%; border:none!important;height: 120px;">
                        @show
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