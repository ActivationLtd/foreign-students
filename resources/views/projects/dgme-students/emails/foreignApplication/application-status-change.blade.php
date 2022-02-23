@extends('projects.dgme-students.layouts.email.template')
<?php
/** @var \App\ForeignStudentApplication $application */
$user = $application->user;
?>


@section('title')
    Foreign Student Application | Application Status Changed
@endsection

@section('content')

    Dear User {{$user->full_name}},<br><br>

    You application - <a href="{{route('foreign-student-applications.edit',$application->id)}}"><b>{{$application->id}}</b></a> status has been changed to {{$application->status}}.<br><br>

    Please <a href="{{route('foreign-student-applications.edit',$application->id)}}">click here</a> to view it.<br><br>

    Foreign Medical(MBBS)/Dental(BDS) Student Applications

@endsection


