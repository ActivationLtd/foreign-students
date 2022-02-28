@extends('projects.dgme-students.layouts.email.template')

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