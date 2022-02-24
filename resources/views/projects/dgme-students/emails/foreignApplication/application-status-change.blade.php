@extends('projects.dgme-students.layouts.email.template')
<?php
/** @var \App\ForeignStudentApplication $application */
$user = $application->user;
?>


@section('title')
    Foreign Student Application | Application Status Changed
@endsection

@section('content')

    Dear {{$user->first_name}},<br><br>

    The status for your application on - <a href="{{route('foreign-student-applications.edit',$application->id)}}"><b>{{$application->course_name}}</b></a> course has been changed to {{$application->status}}.<br><br>

    Please <a href="{{route('foreign-student-applications.edit',$application->id)}}">click here</a> to view it.<br><br>

    <strong>Thank you</strong>
    <br><br>
    Foreign Medical(MBBS)/Dental(BDS) Student Applications

@endsection


