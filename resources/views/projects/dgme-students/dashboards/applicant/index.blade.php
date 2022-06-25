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
            <div class="info-box bg-smart-blue">
                <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                   <ion-icon name="newspaper-outline"></ion-icon>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-number">You Applied</span>
                    <table style="width: 100%">
                        <tr>
                            <td>Private</td>
                            <td><span class="badge badge-dark flat">{{$applicantData['applications']['private']}}</span>
                            </td>
                            <td>Public</td>
                            <td><span class="badge badge-dark flat">{{$applicantData['applications']['gov']}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><span class="badge bg-red flat">{{$applicantData['applications']['total']}}</span>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-md-8">
            <a href="{{route('foreign-student-applications.create',['application_category'=>\App\ForeignStudentApplication::OPTION_GOVERNMENT])}}"
               class="apply" style="color:white">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><ion-icon name="add-outline"></ion-icon></span>
                    <div class="info-box-content">
                        <span style="display: block">Government Medical College</span>
                        @if(user()->canApplyForGovMedical())
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        @endif
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
                        <span style="display: block">Private Medical College</span>
                        @if(user()->canApplyPvtMedical())
                            <span class="info-box-number">APPLY <i class="fa fa-angle-right"></i></span>
                        @endif
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
                        <span style="display: block">Application Instruction</span>
                        <span class="info-box-number">DOWNLOAD <i class="fa fa-download"></i> </span>
                    </div>
                </div>
            </a>
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