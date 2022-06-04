@extends('projects.dgme-students.layouts.default.template')

@section('head-title')
    {{config('app.name')}} | Applicant Dashboard
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
                    <span style="display: block">Government Medical College</span>
                    @if(user()->canApplyForGovMedical())
                        <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_GOVERNMENT])}}"
                           class="apply" style="color:white">
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
                    <span style="display: block">Private Medical College</span>
                    @if(user()->canApplyPvtMedical())
                        <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_PRIVATE])}}"
                           class="apply" style="color:white">
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 col-md-8">
            <div class="info-box bg-gray">
                <a href="{{asset('projects/dgme-students/files/user manual.pdf')}}" style="color:white">
                <span class="info-box-icon">
                    <ion-icon name="help-circle-outline"></ion-icon>
                </span>
                </a>
                <div class="info-box-content">
                    <span style="display: block">Application Instruction</span>
                    <a href="{{asset('projects/dgme-students/files/user manual.pdf')}}"
                       class="apply" style="color:black">
                        <span class="info-box-number">DOWNLOAD <i class="fa fa-download"></i> </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <h3>Your Applications</h3>
    <div class="row ">
        <div class="col-md-12">
            <?php
            $datatable = new \App\Projects\DgmeStudents\Datatables\ForeignApplicationForApplicantDatatable();
            ?>
            @include('mainframe.layouts.module.grid.includes.datatable',compact('datatable'))
        </div>
    </div>
    <div class="clearfix"></div>
@endsection