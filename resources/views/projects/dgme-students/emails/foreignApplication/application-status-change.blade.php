@extends('projects.dgme-students.layouts.email.template')
<?php
/** @var \App\ForeignStudentApplication $application */
$user = $application->user;
?>


@section('title')

                <table class="no-border no-padding" style="width:50%; margin: 0 auto;" >
                    <tr>
                        <td>
                            <img src="{{asset('projects/dgme-students/images/bangladesh.png')}}" class="img-thumbnail"
                                 style="margin-top: 2%; border:none!important; height: 120px;">
                        </td>
                        <td>
                            <h2 align="center">Directorate General of Medical Education (DGME)</h2>
                            <h3 align="center">Government of the People's Republic of Bangladesh</h3>

                        </td>
                        <td>
                            <img src="{{asset('projects/dgme-students/images/dgme.png')}}" class="img-thumbnail pull-right"
                                 style="margin-top: 2%; border:none!important;height: 120px;">

                        </td>
                    </tr>
                </table>


    Foreign Student Application | Application Status Changed
@endsection

@section('content')

    Dear {{$user->first_name}},<br><br>

    The status for your application on - <a
            href="{{route('foreign-student-applications.edit',$application->id)}}"><b>{{$application->course_name}}</b></a> course has been changed to {{$application->status}}.
    <br><br>

    Please <a href="{{route('foreign-student-applications.edit',$application->id)}}">click here</a> to view it.<br><br>

    <strong>Thank you</strong>
    <br><br>
    Foreign Medical(MBBS)/Dental(BDS) Student Applications

@endsection


