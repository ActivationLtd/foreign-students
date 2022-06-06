<?php
/**
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationDatatable $datatable
 * @var \App\Mainframe\Modules\Modules\Module $module
 * @var array $columns
 */
$datatable = new \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationDatatable();


$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();

$datatable->hidden = ['applicant_name'];


?>

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
        @include('form.select-array-multiple',['var'=>['name'=>'statuses','label'=>'Status', 'options'=>kv(\App\ForeignStudentApplication::$statuses),'div'=>'col-md-3']])

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
