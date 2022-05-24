@extends('projects.dgme-students.layouts.default.template')


@section('head-title')
    Applicant Dashboard
@endsection
@section('title')
    Foreign Medical(MBBS)/Dental(BDS) Student Applications
@endsection
@section('content')
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3 col-md-8">
            <div class="info-box bg-smart-blue">
                <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                   <ion-icon name="newspaper-outline"></ion-icon>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-number">Applications</span>
                    <table style="width: 100%">
                        <tr>
                            <td>Total:</td>
                            <td>{{$applicantData['applications']['total']}}</td>
                        </tr>
                        <tr>
                            <td>Gov :</td>
                            <td>{{$applicantData['applications']['gov']}}</td>
                        </tr>
                        <tr>
                            <td>Private :</td>
                            <td>{{$applicantData['applications']['private']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-md-8">
            <div class="info-box bg-smart-red">
                <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                    <ion-icon name="add-outline"></ion-icon>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="">Government Medical College</span>
                    @if($applicantData['applications']['showGovtApplicationCreateButton'])
                        <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_GOVERNMENT])}}" style="color:white">
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        </a>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-3 col-md-8">
            <div class="info-box bg-smart-red">
                <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                    <ion-icon name="add-outline"></ion-icon>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="">Private Medical College</span>
                    @if($applicantData['applications']['showPvtApplicationCreateButton'])
                        <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_PRIVATE])}}" style="color:white">
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <h3>Your Applications</h3>
    <?php
    $datatable = new \App\Projects\DgmeStudents\Datatables\ForeignApplicationForApplicantDatatable();
    ?>
    @include('mainframe.layouts.module.grid.includes.datatable',compact('datatable'))
    <div class="clearfix"></div>
@endsection