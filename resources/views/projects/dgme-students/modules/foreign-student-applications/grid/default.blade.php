@extends('projects.dgme-students.layouts.default.template')
<?php
/**
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationDatatable $datatable
 * @var \App\Mainframe\Modules\Modules\Module $module
 * @var array $columns
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available for create
 * @var bool $editable
 * @var array $immutables
 * @var \App\ForeignStudentApplication $element
 * @var \App\ForeignStudentApplication $foreignStudentApplication
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationViewProcessor $view
 */
use App\ForeignStudentApplication;
$datatable = $datatable ?? $view->datatable;
$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();
$yesNoOptions = [0 => 'No', 1 => 'Yes'];
$optionsGovernmentPublic = ForeignStudentApplication::$optionsGovernmentPublic;
$fundingModes = ForeignStudentApplication::$fundingModes;
$statuses = ForeignStudentApplication::$statuses;
?>
@section('title')
    @include('mainframe.layouts.module.grid.includes.title')
@endsection
@section('content')

    <div class="{{$datatableName}}-container datatable-container">
        @if($view->showApplicationFilter())
            <div class="filters col-md-12 no-padding">
                @include('form.text',['var'=>['name'=>'created_at_from','label'=>'Created(from)', 'div'=>'col-md-3']])
                @include('form.text',['var'=>['name'=>'created_at_till','label'=>'Created(till)', 'div'=>'col-md-3']])
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
                @include('form.select-array',['var'=>['name'=>'application_category','label'=>'Government/Private Institute', 'options'=>kv($optionsGovernmentPublic),'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'is_saarc','label'=>'Is SAARC?', 'options'=>$yesNoOptions,'div'=>'col-md-3']])


                @include('form.select-array-multiple',['var'=>['name'=>'financing_modes','label'=>'Proposed Mode Of Financing Study', 'options'=>kv($fundingModes), 'div'=>'col-md-3']])
                @include('form.select-model-multiple',['var'=>['name'=>'domicile_country_ids','label'=>'Domicile Country','table'=>'countries', 'div'=>'col-md-3']])
                @include('form.select-model-multiple',['var'=>['name'=>'dob_country_ids','label'=>'DOB Country','table'=>'countries', 'div'=>'col-md-3']])


                @include('form.select-array-multiple',['var'=>['name'=>'statuses','label'=>'Status', 'options'=>kv($statuses),'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'is_payment_verified','label'=>'Payment Verified?', 'options'=>$yesNoOptions,'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'is_document_verified','label'=>'Document Verified?', 'options'=>$yesNoOptions,'div'=>'col-md-3']])
            </div>
        @endif
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
                    d.application_category = $('#application_category').val();
                    d.is_saarc = $('#is_saarc').val();
                    d.financing_modes = $('#financing_modes').val();
                    d.domicile_country_ids = $('#domicile_country_ids').val();
                    d.dob_country_ids = $('#dob_country_ids').val();
                    d.statuses = $('#statuses').val();
                    d.is_payment_verified = $('#is_payment_verified').val();
                    d.is_document_verified = $('#is_document_verified').val();
                    d.created_at_from = $('#created_at_from').val();
                    d.created_at_till = $('#created_at_till').val();
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
        $('#application_session_id,#course_id,#application_category,#is_saarc,#dob_country_ids,#domicile_country_ids,#financing_modes, #statuses,#is_payment_verified,#is_document_verified,#created_at_from,#created_at_till').on('change', function () {
            {{$datatableName}}.draw();
        });
        $("#created_at_from").bootstrapDatepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            clearBtn: true,
        }).on('clearDate', function (ev) {
            $(selector).val(null);
        }).on('changeDate', function (ev) {
            var format = 'dd-mm-yyyy';
            var validDate = null;
            var formattedDate = $(this).val();      // '01-04-2020'

            if (formattedDate.length) {

                var formatParts = format.split('-');   // ['01','04','2020']
                var dateParts = formattedDate.split('-');   // ['01','04','2020']

                var map = [];
                for (var i = 0; i < formatParts.length; i++) {
                    map[formatParts[i]] = dateParts[i];
                }

                // console.log(map);

                var day = map['dd'];             // '01'
                var month = map['mm'];           // '04'
                var year = map['yyyy'];            // '2020'
                // console.log(year.length + " " + month.length + " " + day.length);
                if (year.length == 4 && month.length == 2 && day.length == 2) {
                    validDate = year + '-' + month + '-' + day;
                }
            }
            $("#created_at_from").val(validDate);
            {{$datatableName}}.draw();
        });

        $("#created_at_till").bootstrapDatepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            clearBtn: true,
        }).on('clearDate', function (ev) {
            $(selector).val(null);
        }).on('changeDate', function (ev) {
            var format = 'dd-mm-yyyy';
            var validDate = null;
            var formattedDate = $(this).val();      // '01-04-2020'

            if (formattedDate.length) {

                var formatParts = format.split('-');   // ['01','04','2020']
                var dateParts = formattedDate.split('-');   // ['01','04','2020']

                var map = [];
                for (var i = 0; i < formatParts.length; i++) {
                    map[formatParts[i]] = dateParts[i];
                }

                // console.log(map);

                var day = map['dd'];             // '01'
                var month = map['mm'];           // '04'
                var year = map['yyyy'];            // '2020'
                // console.log(year.length + " " + month.length + " " + day.length);
                if (year.length == 4 && month.length == 2 && day.length == 2) {
                    validDate = year + '-' + month + '-' + day;
                }
            }
            $("#created_at_till").val(validDate);
            {{$datatableName}}.draw();
        });
    </script>
@endsection
