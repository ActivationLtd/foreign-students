@extends('projects.dgme-students.layouts.email.template')

@section('css')
    @parent
    <style>
        tr.row-total {
            border-top: 1px lightgrey solid;
        }
    </style>
@endsection

<?php
$totalApplicationsSubmittedYesterday = \App\ForeignStudentApplication::where('status',
    \App\ForeignStudentApplication::STATUS_SUBMITTED)->whereBetween('submitted_at', [today()->subDay(), today()])->count();
?>


@section('content')
    <h2 style="text-align: left">Session Summary
        <br>
        Total {{ $totalApplicationsSubmittedYesterday }} - applications were submitted yesterday ({{today()->subDay()->format('d-m-Y')}}).
    </h2>

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
    <h2 style="text-align: left">Saarc Country-wise Applications</h2>
    <table class="table" style="width: 100%">
        <thead>
        <tr class="row-border-bottom">
            <td style="width: 25%"></td>
            <td style="width: 15%"><b>Public</b></td>
            <td style="width: 15%"><b>Private </b></td>
            <td style="width: 15%"><b>MBBS</b></td>
            <td style="width: 15%"><b>BDS </b></td>
        </tr>
        </thead>
        <tbody>
        <?php

        $privateApplications = 0;
        $publicApplications = 0;
        $bdsApplications = 0;
        $mbbsApplications = 0;
        ?>
        @foreach($data['pvtPublicCountBasedOnSaarc'] as $applicationData)
            <tr>
                <td>{{transformSaarcField($applicationData->is_saarc)}}</td>
                <td>{{$applicationData->private}}</td>
                <td>{{$applicationData->government}}</td>
                <td>{{$applicationData->mbbs}}</td>
                <td>{{$applicationData->bds}}</td>
            </tr>
            <?php

            $privateApplications += $applicationData->private;
            $publicApplications += $applicationData->government;
            $bdsApplications += $applicationData->mbbs;
            $mbbsApplications += $applicationData->bds;
            ?>
        @endforeach
        <tr>
            <td>Total</td>
            <td>{{$privateApplications}}</td>
            <td>{{$publicApplications}}</td>
            <td>{{$bdsApplications}}</td>
            <td>{{$mbbsApplications}}</td>
        </tr>
        </tbody>
    </table>




    <h2 style="text-align: left">Country-wise Applications</h2>
    <table class="table" style="width: 100%">
        <thead>
        <tr class="row-border-bottom">
            <td style="width: 25%"><b>Country</b></td>
            {{--            <td><b>Male</b></td>--}}
            {{--            <td><b>Female</b></td>--}}
            <td style="width: 15%"><b>Total</b></td>
            <td style="width: 15%"><b>Payment <br/>Verified</b></td>
            <td style="width: 15%"><b>Document <br/>Verified</b></td>
            <td style="width: 15%"><b>Valid</b></td>
            <td style="width: 15%"><b>Accepted</b></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $sumTotal = 0;
        $sumPaymentVerified = 0;
        $sumDocumentVerified = 0;
        $sumValidApplication = 0;
        $sumAccepted = 0;
        ?>
        @foreach($data['applications'] as $applicationData)
            <tr>
                <td>{{$applicationData->country}}</td>
                {{--                <td>23</td>--}}
                {{--                <td>24</td>--}}
                <td>{{$applicationData->total}}</td>
                <td>{{$applicationData->payment_verified}}</td>
                <td>{{$applicationData->document_verified}}</td>
                <td>{{$applicationData->valid_application}}</td>
                <td>{{$applicationData->accepted}}</td>
            </tr>
            <?php
            $sumTotal = $sumTotal + $applicationData->total;
            $sumPaymentVerified = $sumPaymentVerified + $applicationData->payment_verified;
            $sumDocumentVerified = $sumDocumentVerified + $applicationData->document_verified;
            $sumValidApplication = $sumValidApplication + $applicationData->valid_application;
            $sumAccepted = $sumAccepted + $applicationData->accepted;
            ?>
        @endforeach
        <tr style="border-top: 2px solid grey">
            <td><b>Total</b></td>
            <td><b>{{$sumTotal}}</b></td>
            <td><b>{{$sumPaymentVerified}}</b></td>
            <td><b>{{$sumDocumentVerified}}</b></td>
            <td><b>{{$sumValidApplication}}</b></td>
            <td><b>{{$sumAccepted}}</b></td>
        </tr>

        </tbody>
    </table>

    <div class="clearfix"></div>
    <a href="{{route('home')}}" style="margin-top: 20px; float: left">Login to {{config('app.name')}}</a>
@endsection


