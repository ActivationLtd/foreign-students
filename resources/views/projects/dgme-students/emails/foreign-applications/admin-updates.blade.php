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
            <td style="width: 25%">2021-22</td>
            <td style="width: 25%"><b>Status</b></td>
            <td style="width: 25%">Closed</td>
        </tr>
        <tr>
            <td><b>Start Date</b></td>
            <td>12/12/12</td>
            <td><b>End Date</b></td>
            <td>12/12/12</td>
        </tr>
    </table>


    <h2 style="text-align: left">Country-wise Applications</h2>
    <table class="table" style="width: 100%">
        <thead>
        <tr class="row-border-bottom">
            <td style="width: 25%"><b>Country</b></td>
            <td><b>Male</b></td>
            <td><b>Female</b></td>
            <td><b>Total</b></td>
            <td><b>Payment <br/>Verified</b></td>
            <td><b>Document <br/>Verified</b></td>
            <td><b>Accepted</b></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>India</td>
            <td>23</td>
            <td>24</td>
            <td>47</td>
            <td>4</td>
            <td>4</td>
            <td>4</td>
        </tr>
        <tr>
            <td>India</td>
            <td>23</td>
            <td>24</td>
            <td>47</td>
            <td>4</td>
            <td>4</td>
            <td>4</td>
        </tr>
        <tr>
            <td>India</td>
            <td>23</td>
            <td>24</td>
            <td>47</td>
            <td>4</td>
            <td>4</td>
            <td>4</td>
        </tr>
        <tr>
            <td>India</td>
            <td>23</td>
            <td>24</td>
            <td>47</td>
            <td>4</td>
            <td>4</td>
            <td>4</td>
        </tr>
        <tr class="row-total">
            <td><b>Total</b></td>
            <td><b>99</b></td>
            <td><b>99</b></td>
            <td><b>99</b></td>
            <td><b>99</b></td>
            <td><b>99</b></td>
            <td><b>99</b></td>
        </tr>
        </tbody>
    </table>

    <div class="clearfix"></div>
    <a href="{{route('home')}}" style="margin-top: 20px; float: left">Login to {{config('app.name')}}</a>
@endsection


