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
    <h1 style="padding-right: 10px" align="center">Summary of Foreign Student Application</h1>
@endsection

@section('content')
    <style>

        table, tr, th, td, thead, tbody{
            font-size:18px!important;
        }

    </style>
    <table class="no-border no-padding" style="margin-top:5%">
        <tr>
            <td>Name of the course for which Admission is sought - {{$application->course_name}}</td>
        </tr>
        <tr>
            <td>Application Status - {{$application->status}}</td>
        </tr>
        <tr>
            <td>Application ID - {{$application->id}}</td>
        </tr>
        <tr>
            <td>Student Name - {{$application->applicant_name}}</td>
        </tr>
        <tr>
            <td>Student E-mail - {{$application->applicant_email}}</td>
        </tr>
        <tr>
            <td>Nationality - {{$application->nationality}}</td>
        </tr>
        <tr>
            <td>Passport No - {{$application->applicant_passport_no}}</td>
        </tr>
        <tr>
            <td>Emergency Contact Name (Bangladesh) - {{$application->emergency_contact_bangladesh_name}}</td>
        </tr>
        <tr>
            <td>Emergency Contact Name (Domicile) - {{$application->emergency_contact_domicile_name}}</td>
        </tr>
        <tr>
            <td>Thank you, we have received your Application for {{$application->course_name}} Course in Bangladesh.</td>
        </tr>
    </table>
@endsection
@section('content-bottom')
    <table class="no-border no-padding" style="margin-top:5%">
        <tr>
            <td>Signature</td>
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



