@extends('projects.dgme-students.layouts.default.template')


@section('head-title')
    Applicant Dashboard
@endsection
@section('title')
    Foreign Medical/Dental Student Application
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
                    @if($applicantData['applications']['ongoingMBBSNumber']>0)
                        <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingMBBSApplicationId'])}}" style="color:white">
                            <span class="info-box-number">MBBS Application : {{$applicantData['applications']['ongoingMBBSApplicationStatus']}} </span>
                        </a>
                    @endif
                    @if($applicantData['applications']['ongoingBDSNumber']>0)
                        <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingBDSApplicationId'])}}" style="color:white">
                            <span class="info-box-number">BDS Application : {{$applicantData['applications']['ongoingBDSApplicationStatus']}} </span>
                        </a>
                    @endif
                @endif
                @if($applicantData['applications']['ongoingMBBSNumber']==0 || $applicantData['applications']['ongoingBDSNumber']==0)
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