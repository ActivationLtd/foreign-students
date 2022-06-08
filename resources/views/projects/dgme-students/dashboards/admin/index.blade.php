@extends('projects.dgme-students.layouts.default.template')
<?php
/**
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationDatatable $datatable
 * @var \App\Mainframe\Modules\Modules\Module $module
 * @var array $columns
 */
use App\ForeignStudentApplication;
$datatable = new \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationDatatable();
$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();
?>

@section('head-title')
    {{config('app.name')}} | Admin Dashboard
@endsection
@section('title')
    Foreign Medical/Dental Student Application
@endsection
@section('content')
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-3">
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
                            <td>Draft:</td>
                            <td>{{$adminData['applications']['draft']}}</td>
                        </tr>
                        <tr>
                            <td>Submitted :</td>
                            <td>{{$adminData['applications']['submitted']}}</td>
                        </tr>
                        <tr>
                            <td>Total :</td>
                            <td>{{$adminData['applications']['total']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-navy">
                <a href="{{route('application-sessions.index')}}" style="color:white">
                <span class="info-box-icon">
                   <i class="fa fa-calendar-check-o"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-number"> <span
                                class="badge badge-success bg-green">Latest</span> Session</span>
                    <table style="width: 100%">
                        <tr>
                            <td>Session:</td>
                            <td>{{$adminData['applications']['latestSession']->name}}
                                {{-- <span class="badge bg-green">{{$adminData['applications']['latestSession']->status}}</span>--}}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">Ends:</td>
                            <td style="vertical-align:top">
                                {{formatDate($adminData['applications']['latestSession']->ends_on)}}<br>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-smart-red">
                <a href="{{route('users.index')}}" style="color:white">
                <span class="info-box-icon">
                   <i class="fa fa-user"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-number"> Users</span>
                    <table style="width: 100%">
                        <tr>
                            <td>Total:</td>
                            <td>{{$adminData['applications']['totalUsers']}}</td>
                        </tr>
                    </table>
                    <a href="{{route('users.index')}}" style="color:white">Manage</a> <i class="fa fa-angle-right"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box bg-gray">
                <a href="{{route('reports.index')}}" style="color:white">
                <span class="info-box-icon">
                   <i class="fa fa fa-file-text-o"></i>
                </span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-number"> Reports</span>

                    <span>
                        <a href="{{route('foreign-student-applications.report')}}">Application default report</a>
                        <br>
                        <a href="{{route('reports.index')}}">View all report</a>
                    </span>

                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            @include('projects.dgme-students.dashboards.admin.includes.latest-applications-datatable');
        </div>
    </div>
@endsection
