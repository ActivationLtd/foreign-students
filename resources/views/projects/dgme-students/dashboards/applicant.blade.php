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
                @if($applicantData['applications']['ongoing']>0)
                    <a href="{{route('foreign-student-applications.edit',$applicantData['applications']['ongoingApplicationId'])}}" style="color:white">
                        <span class="info-box-number">{{$applicantData['applications']['ongoing']}} Current Applications</span>
                    </a>

                    <span class="progress-description">Status : {{$applicantData['applications']['ongoingApplicationStatus']}}</span>
                @else
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