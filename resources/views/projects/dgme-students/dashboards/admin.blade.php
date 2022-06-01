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
$statuses = ForeignStudentApplication::$statuses;
?>

@section('head-title')
    Admin Dashboard
@endsection
@section('title')
    Foreign Medical/Dental Student Application
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
        <div class="col-md-3 col-md-8">
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
        <div class="col-md-3 col-md-8">
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
        <div class="col-md-3 col-md-8">
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
            <h3>Latest Applications</h3>
            <div class="{{$datatableName}}-container datatable-container shadow" style="padding: 20px">
                <div class="filters col-md-12 no-padding">
                    <?php
                    $var = [
                        'name' => 'application_session_id',
                        'label' => 'Session',
                        'div' => 'col-sm-3',
                        'null_option' => true,
                        'model' => \App\ApplicationSession::class,
                        'show_inactive' => true
                    ];
                    ?>
                    @include('form.select-model',['var'=>$var])
                    @include('form.select-model',['var'=>['name'=>'course_id','label'=>'Course','table'=>'foreign_application_courses', 'div'=>'col-md-3']])
                    @include('form.select-model-multiple',['var'=>['name'=>'domicile_country_ids','label'=>'Domicile Country','table'=>'countries', 'div'=>'col-md-3']])
                    @include('form.select-array-multiple',['var'=>['name'=>'statuses','label'=>'Status', 'options'=>kv($statuses),'div'=>'col-md-3']])

                </div>

                <table id="{{$datatableName}}"
                       class="table module-grid table-condensed {{$datatableName}} dataTable table-hover"
                       style="width: 100%">
                    <thead>
                    <tr>
                        @foreach($titles as $title)
                            <th>{!! $title !!}</th>
                        @endforeach
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script type="text/javascript">
        // Init UI elements
        $('#dob_country_ids,#dob_country_ids,#domicile_country_ids,#financing_modes,#statuses,#statuses').select2();

        // Init datatable
        var {{$datatableName}} = $('#{{$datatableName}}').DataTable({
            ajax: {
                url: "{!! $ajaxUrl !!}",
                data: function (d) {
                    d.application_session_id = $('#application_session_id').val();
                    d.course_id = $('#course_id').val();
                    d.domicile_country_ids = $('#domicile_country_ids').val();
                    d.statuses = $('#statuses').val();
                }
            },
            columns: [{!! $columnsJson !!}],
            processing: true,
            serverSide: true,
            searchDelay: {!! $datatable->searchDelay() !!}, // Search delay
            minLength: {!! $datatable->minLength() !!},     // Minimum characters to be typed before search begins
            lengthMenu: {!! $datatable->lengthMenu() !!},
            pageLength: {!! $datatable->pageLength()!!},
            order: {!! $datatable->order()!!},              // First row descending
            bLengthChange: {!! $datatable->bLengthChange() !!}, // show the length field
            bPaginate: {!! $datatable->bPaginate() !!},
            bFilter: {!! $datatable->bFilter() !!},
            bInfo: {!! $datatable->bInfo() !!},
            bDeferRender: {!! $datatable->bDeferRender() !!},
            "dom": 'Blftipr',                               // Special code to load dom element. i.e. B=buttons
            "buttons": [
                {
                    className: 'dt-refresh-btn btn btn-sm btn-default pull-left bg-white form-control input-sm',
                    text: '<ion-icon class="dt-reload" name="reload"></ion-icon>',
                    action: function (e, dt, node, config) {
                        dt.draw();
                    }
                }
            ],
            mark: true
        });

        {{$datatableName}}.buttons().container().appendTo('.dataTables_length');

        // Respond to change
        $('#application_session_id,#course_id,#domicile_country_ids,#statuses').on('change', function () {
            {{$datatableName}}.draw();
        });

    </script>
@endsection