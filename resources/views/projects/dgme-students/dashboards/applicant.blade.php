@extends('projects.dgme-students.layouts.default.template')


@section('head-title')
    Applicant Dashboard
@endsection
@section('title')
    <h1>Foreign Medical(MBBS)/Dental(BDS) Student Applications</h1>
@endsection
@section('content')
    <div class="clearfix"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green-active">
            <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                  <ion-icon name="newspaper-outline"></ion-icon>
                </span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Online Application</span>
                @if($applicantData['applications']['total']>0 )
                    <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                        <span class="info-box-number">{{$applicantData['applications']['total']}} Current Applications</span>
                    </a>
                @endif
                @if($applicantData['applications']['ongoingGovernmentMBBSNumber']==0 || $applicantData['applications']['ongoingGovernmentBDSNumber']==0
                    ||$applicantData['applications']['ongoingPrivateMBBSNumber']==0 || $applicantData['applications']['ongoingPrivateBDSNumber']==0 )
                    <a href="{{route('foreign-student-applications.create')}}" style="color:white">
                        <span class="info-box-number">Apply Online</span>
                    </a>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange-active">
            <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                  <ion-icon name="newspaper-outline"></ion-icon>
                </span>
            </a>
            <div class="info-box-content">

                <span class="info-box-text">Government Medical College <br>Online Application</span>
                @if($applicantData['applications']['ongoingGovernmentMBBSNumber']>0 || $applicantData['applications']['ongoingGovernmentBDSNumber']>0 )
                    <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                        <span class="info-box-number">{{$applicantData['applications']['ongoingGovernmentMBBSNumber']+$applicantData['applications']['ongoingGovernmentBDSNumber']}} Current Applications</span>
                    </a>
                    @if($applicantData['applications']['ongoingGovernmentMBBSNumber']>0)
                    <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingGovernmentMBBSApplicationId'])}}" style="color:white">
                        <span class="info-box-number">MBBS Application : {{$applicantData['applications']['ongoingGovernmentMBBSApplicationStatus']}} </span>
                    </a>
                    @endif
                    @if($applicantData['applications']['ongoingGovernmentBDSNumber']>0)
                        <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingGovernmentBDSApplicationId'])}}" style="color:white">
                            <span class="info-box-number">BDS Application : {{$applicantData['applications']['ongoingGovernmentBDSApplicationStatus']}} </span>
                        </a>
                    @endif
                @endif
                @if($applicantData['applications']['ongoingGovernmentMBBSNumber']==0 || $applicantData['applications']['ongoingGovernmentBDSNumber']==0)
                    <a href="{{route('foreign-student-applications.create')}}" style="color:white">
                        <span class="info-box-number">Apply Online</span>
                    </a>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-aqua-active">
            <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                <span class="info-box-icon">
                  <ion-icon name="newspaper-outline"></ion-icon>
                </span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Private Medical College<br>Online Application</span>
                @if($applicantData['applications']['ongoingPrivateMBBSNumber']>0 || $applicantData['applications']['ongoingPrivateBDSNumber']>0 )
                    <a href="{{route('foreign-student-applications.index')}}" style="color:white">
                        <span class="info-box-number">{{$applicantData['applications']['ongoingPrivateMBBSNumber']+ $applicantData['applications']['ongoingPrivateBDSNumber']}} Current Applications</span>
                    </a>
                @endif
                @if($applicantData['applications']['ongoingPrivateMBBSNumber']>0)
                    <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingPrivateMBBSApplicationId'])}}" style="color:white">
                        <span class="info-box-number">MBBS Application : {{$applicantData['applications']['ongoingPrivateMBBSApplicationStatus']}} </span>
                    </a>
                @endif
                @if($applicantData['applications']['ongoingPrivateBDSNumber']>0)
                    <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingPrivateBDSApplicationId'])}}" style="color:white">
                        <span class="info-box-number">BDS Application : {{$applicantData['applications']['ongoingPrivateBDSApplicationStatus']}} </span>
                    </a>
                @endif
                @if($applicantData['applications']['ongoingPrivateMBBSNumber']==0 || $applicantData['applications']['ongoingPrivateBDSNumber']==0)
                    <a href="{{route('foreign-student-applications.create')}}" style="color:white">
                        <span class="info-box-number">Apply Online</span>
                    </a>
                @endif

            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    {{--<?php--}}
    {{--$datatable = new SampleDatatable();--}}
    {{--?>--}}
    {{--@include('mainframe.layouts.module.grid.includes.datatable',compact('datatable'))--}}
    <div class="clearfix"></div>
@endsection