@extends('projects.dgme-students.layouts.default.template')

@section('head-title')
    {{config('app.name')}} | Applicant Dashboard
@endsection

@section('title')
    @include('projects.dgme-students.dashboards._includes.system-title')
@endsection

@section('content')
    <div class="clearfix"></div>
    <div class="row">

        <div class="col-md-3 col-md-8">
            <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_GOVERNMENT])}}"
               class="apply" style="color:white">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><ion-icon name="add-outline"></ion-icon></span>
                    <div class="info-box-content">
                        @if(user()->canApplyForGovMedical())
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        @endif
                        <span style="display: block">Government Medical College</span>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-md-8">
            <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_PRIVATE])}}"
               class="apply" style="color:white">
                <div class="info-box bg-smart-red">
                    <span class="info-box-icon"><ion-icon name="add-outline"></ion-icon></span>
                    <div class="info-box-content">
                        @if(user()->canApplyPvtMedical())
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        @endif
                        <span style="display: block">Private Medical College</span>

                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-md-8">
            <a href="{{asset('projects/dgme-students/files/user manual.pdf')}}" style="color:white">
                <div class="info-box bg-gray">

                <span class="info-box-icon">
                    <ion-icon name="help-circle-outline"></ion-icon>
                </span>
                    <div class="info-box-content">
                        <span class="info-box-number">DOWNLOAD</span>
                        <span style="display: block">Application Instruction</span>

                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <h3>Your Applications</h3>
    <div class="col-md-12 bordered">
        <?php
        $datatable = new \App\Projects\DgmeStudents\Datatables\ForeignApplicationForApplicantDatatable();
        ?>
        @include('mainframe.layouts.module.grid.includes.datatable',compact('datatable'))
    </div>
    <div class="clearfix"></div>
@endsection