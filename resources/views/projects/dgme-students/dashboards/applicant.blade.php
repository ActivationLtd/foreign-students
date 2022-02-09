@extends('projects.dgme-students.layouts.default.template')


@section('head-title')
    Applicant Dashboard
@endsection
@section('title')
    Welcome to Online Application For Foreign Students
@endsection
@section('content')
    <div class="clearfix"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-green-active">
            <a href="#" style="color:white">
                <span class="info-box-icon">
                  <ion-icon name="newspaper-outline"></ion-icon>
                </span>
            </a>

            <div class="info-box-content">
                <span class="info-box-text">Online Application</span>
                <span class="info-box-number">Apply Online</span>

{{--                <div class="progress">--}}
{{--                    <div class="progress-bar" style="width: 50%"></div>--}}
{{--                </div>--}}
{{--                <span class="progress-description">--}}
{{--                    50% Increase in 30 Days--}}
{{--                  </span>--}}
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