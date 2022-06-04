@extends('projects.dgme-students.layouts.centered.template')

@section('content')
    <div class="card-body">
        <h4 style="color:red">We are not taking any application at the moment</h4>

    </div>
    <div class="clearfix"></div>
    <div class="col-md-12" style="margin-top:5px">
        <a class="btn btn-primary btn-block " href="{{route('login')}}" style="color:white">Log In</a>
    </div>
    <div class="clearfix"></div>
    <a class="btn btn-block" target="_blank"
       href="{{asset('projects/dgme-students/files/user manual.pdf')}}"> <i class="fa fa-download"></i> <b>Download User Manual For Application</b>
    </a>
    <p style="text-align: center">If you require any further information, please feel free to email us at <a href="mailto:supportforeignstudents@dgme.gov.bd">supportforeignstudents@dgme.gov.bd</a></p>


@endsection