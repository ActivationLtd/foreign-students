@extends('projects.dgme-students.layouts.pdf-print.print-template')

@section('css')
    @parent

    <style type="text/css">
        .container {width: 800px}
        @media print {
            #btnPrint {
                display:none;
            }
        }
    </style>
@endsection

@section('content')

    <h3>Summary of Foreign Student Application</h3>
    <h3 style="font-family:'kalpurush'">ফরেন এপ্লিকেশন</h3>

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