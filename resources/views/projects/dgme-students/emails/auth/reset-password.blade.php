@extends('projects.dgme-students.layouts.email.template')

@section('title')
    <table class="no-border no-padding" style="width:60%">
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
    Reset password
@endsection

@section('content')
   {{__('You are receiving this email because we received a password reset request for your account.')}}

    <a class="button button-blue action" href="{{$url}}"> {{__('Reset Password')}}</a>
  <br /><br />
    <a href="{{$url}}">{{$url}}</a>
    <br /><br />
   {{__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])}}
    <br /><br />
    {{__('If you did not request a password reset, no further action is required.')}}
@endsection