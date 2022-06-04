<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    {{--    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">--}}
    @include('mainframe.layouts.default.includes.css')
    {{--        <link rel="stylesheet" href="{{asset('projects/vscript/css/print-pdf.css')}}" type="text/css"/>--}}
    <title>
        @section('head-title')
            {{setting('app-name')}}
        @show
    </title>

    @section('head')
    @show

    @section('css')
        <style type="text/css">
            .container {width: 800px}
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
    <div class="row">
        <div class="col-md-12" align="center">
            <div class="header-line-up"></div>
            <table class="no-border no-padding" width="100%">
                <tr>
                    <td width="25%">
                        <img src="{{asset('projects/dgme-students/images/bangladesh.png')}}"
                             style="width: 120px; float: right; padding-right: 15px" alt="">
                    </td>
                    <td width="50%">
                        <h2 style="text-align: center;font-size: 20px;line-height: 1.5em;font-weight: 100;color: #333;margin-top: 20px;margin-bottom: 10px;">{{__('common.agency_full_name')}}</h2>
                        <h4 style="text-align: center;font-size: 16px;line-height: 1.5em;font-weight: 100;color: #333;margin-top: 20px;margin-bottom: 10px;">{{__('common.gov_of_bangladesh')}}</h4>
                    </td>
                    <td width="25%">
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
            <h3>Summary of Foreign Student Application</h3>
            <h4 style="text-align: center;">{{"আবেদন"}}</h4>
            <table class="table table-bordered no-padding">
                <tr>
                    <td style="width: 50%">
                        @if($application->profilePic())
                            <img class="img-thumbnail" style="height:150px!important;"
                                 src="{{$application->profilePic()->thumbnail()}}" alt="alt text">
                        @endif
                    </td>
                    <td style="width: 50%">
                        <div class="col-md-12 no-padding no-margin" style="width:150px!important; vertical-align: center">
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($content)) !!} "
                                 alt="{{$content}}" width="100px" height="100px"/>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Name of the course for which Admission is sought</td>
                    <td>{{$application->course_name}}</td>

                </tr>
                <tr>
                    <td>Application ID</td>
                    <td>{{$application->id}}</td>
                </tr>
                <tr>
                    <td>Application Status</td>
                    <td>{{$application->status}}</td>
                </tr>
                <tr>
                    <td>Application Date</td>
                    <td>{{formatDateTime($application->submitted_at)}}</td>
                </tr>
                <tr>
                    <td>Student Name</td>
                    <td>{{$application->applicant_name}}</td>
                </tr>
                <tr>
                    <td>Student E-mail</td>
                    <td>{{$application->applicant_email}}</td>
                </tr>
                <tr>
                    <td>Nationality</td>
                    <td>{{$application->nationality}}</td>
                </tr>
                <tr>
                    <td>Passport No</td>
                    <td>{{$application->applicant_passport_no}}</td>
                </tr>
                <tr>
                    <td>Emergency Contact Name (Bangladesh)</td>
                    <td>{{$application->emergency_contact_bangladesh_name}}</td>
                </tr>
                <tr>
                    <td>Emergency Contact Name (Domicile)</td>
                    <td>{{$application->emergency_contact_domicile_name}}</td>
                </tr>

            </table>
        @show
    </div>
    <div class="row">
        {{--bottom table--}}
        @section('content-bottom')
            <table class="no-border no-padding" style="margin-top:5%">
                <tr>
                    <td colspan="2">
                        Thank you, We have received your Application for {{$application->course_name}} Course in Bangladesh.
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:100px;">Signature</td>
                </tr>
                <tr>
                    <td>Director Medical Education</td>
                </tr>
                <tr>
                    <td>Directorate General of Medical Education</td>
                </tr>
                <tr>
                    <td>Bangladesh</td>
                </tr>

            </table>
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