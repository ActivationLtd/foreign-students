@extends('projects.dgme-students.layouts.pdf-print.template')
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
</style>

@section('title-right')
    <button id="printPageButton" class="btn-primary" onClick="window.print();">Print This Page</button>
@endsection

@section('top')
    <table class="no-border no-padding" style="width:100%">
        <tr>
            <td>
                <img src="{{asset('projects/dgme-students/images/bangladesh.png')}}" class="img-thumbnail" style="margin-top: 2%; border:none!important; height: 120px;">
            </td>
            <td>
                <h2 align="center">Directorate General of Medical Education (DGME)</h2>
                <h3 align="center">Government of the People's Republic of Bangladesh</h3>

            </td>
            <td>
                <img src="{{asset('projects/dgme-students/images/dgme.png')}}" class="img-thumbnail pull-right" style="margin-top: 2%; border:none!important;height: 120px;">

            </td>
        </tr>
    </table>

@endsection

@section('content')
    <style>

        table, tr, th, td, thead, tbody {
            font-size: 18px !important;
        }

    </style>
    <h3 style="padding-right: 10px" align="center">Summary of Foreign Student Application</h3>
    <table class="table-bordered no-padding" style="margin-top:5%; width:100%" >
        <tr>
            <td style="margin-bottom:10px" colspan="2">
                @if($profilePic)
                        <img class="img-thumbnail" style="height:200px!important;" src="{{$profilePic->path}}" alt="alt text">
                @endif
            </td>
        </tr>

        <tr>
            <td>Name of the course for which Admission is sought - </td>
            <td>{{$application->course_name}}</td>

        </tr>
        <tr>
            <td>Application ID - </td>
            <td>{{$application->id}}</td>
        </tr>
        <tr>
            <td>Application Status - </td>
            <td>{{$application->status}}</td>
        </tr>
        <tr>
            <td>Application Date - </td>
            <td>{{formatDateTime($application->submitted_at)}}</td>
        </tr>
        <tr>
            <td>Student Name - </td>
            <td>{{$application->applicant_name}}</td>
        </tr>
        <tr>
            <td>Student E-mail - </td>
            <td>{{$application->applicant_email}}</td>
        </tr>
        <tr>
            <td>Nationality - </td>
            <td>{{$application->nationality}}</td>
        </tr>
        <tr>
            <td>Passport No - </td>
            <td>{{$application->applicant_passport_no}}</td>
        </tr>
        <tr>
            <td>Emergency Contact Name (Bangladesh) - </td>
            <td>{{$application->emergency_contact_bangladesh_name}}</td>
        </tr>
        <tr>
            <td>Emergency Contact Name (Domicile) - </td>
            <td>{{$application->emergency_contact_domicile_name}}</td>
        </tr>

    </table>
@endsection
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
@endsection



