@extends('projects.dgme-students.layouts.email.template')

@section('css')
    @parent
    <style>
        tr.row-total{
            border-top: 1px lightgrey solid ;
        }
    </style>
@endsection

@section('content')
    <h2 style="text-align: left">Session Summary</h2>

    <table class="table" style="width: 100%">
        <tr>
            <td style="width: 25%"><b>Session</b></td>
            <td style="width: 25%">{{$data['session']->name}}</td>
            <td style="width: 25%"><b>Status</b></td>
            <td style="width: 25%">{{$data['session']->status}}</td>
        </tr>
        <tr>
            <td><b>Start Date</b></td>
            <td>{{formatDate($data['session']->starts_on)}}</td>
            <td><b>End Date</b></td>
            <td>{{formatDate($data['session']->ends_on)}}</td>
        </tr>
        <tr>
            <td><b>Selection Completed?</b></td>
            <td>{{($data['session']->selection_completed)}}</td>
            <td><b>Admission Completed?</b></td>
            <td>{{($data['session']->admission_completed)}}</td>
        </tr>
    </table>


    <h2 style="text-align: left">Country-wise Applications</h2>
    <table class="table" style="width: 100%">
        <thead>
        <tr class="row-border-bottom">
            <td style="width: 25%"><b>Country</b></td>
{{--            <td><b>Male</b></td>--}}
{{--            <td><b>Female</b></td>--}}
            <td><b>Total</b></td>
            <td><b>Payment <br/>Verified</b></td>
            <td><b>Document <br/>Verified</b></td>
            <td><b>Accepted</b></td>
        </tr>
        </thead>
        <tbody>
        @foreach($data['applications'] as $applicationData)
            <tr>
                <td>{{$applicationData->country}}</td>
{{--                <td>23</td>--}}
{{--                <td>24</td>--}}
                <td>{{$applicationData->total}}</td>
                <td>{{$applicationData->payment_verified}}</td>
                <td>{{$applicationData->document_verified}}</td>
                <td>{{$applicationData->accepted}}</td>

            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="clearfix"></div>
    <a href="{{route('home')}}" style="margin-top: 20px; float: left">Login to {{config('app.name')}}</a>
@endsection


