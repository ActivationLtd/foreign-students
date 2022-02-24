@extends('projects.dgme-students.layouts.email.template')

@section('title')
    <a href="{{$url}}" style="color:#000; text-decoration:none;">Foreign Student Application Registration Email Verification</a>
@endsection

@section('content')
    Dear {{$user->first_name}}, <br><br>

    Thank You for taking the time to register.
    <br/><br/>

    Please <a href="{{$url}}">click here</a> to verify your user email.

    <br/><br/>
    <strong>Thank you</strong>
    <br><br>
    Foreign Medical(MBBS)/Dental(BDS) Student Applications


@endsection