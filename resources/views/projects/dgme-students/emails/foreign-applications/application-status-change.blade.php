@extends('projects.dgme-students.layouts.email.template')
<?php
/** @var \App\ForeignStudentApplication $application */
$user = $application->user;
?>

@section('content-header')
    @parent
    <h2 style="text-align: center">Reset password</h2>
@endsection

@section('content')

    Dear {{$user->first_name}},<br><br>

    The status for your application on has been changed to - {{$application->status}}.
    <br><br>

    Please <a href="{{route('foreign-student-applications.edit',$application->id)}}">click here</a> to view your application<br><br>

    Thank you.
    <br><br>
@endsection


