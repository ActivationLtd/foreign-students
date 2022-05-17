<?php
/**
 * @var \App\Mainframe\Features\Report\ReportBuilder $report
 * @var \Illuminate\Pagination\LengthAwarePaginator $result
 * @var int $total Total number of rows returned
 * @var \App\Mainframe\Features\Report\ReportViewProcessor $view
 */

use App\ForeignStudentApplication;

$yesNoOptions = ForeignStudentApplication::$optionsYesNo;
$optionsGovernmentPublic = ForeignStudentApplication::$optionsGovernmentPublic;
$fundingModes = ForeignStudentApplication::$fundingModes;
$statuses = ForeignStudentApplication::$statuses;

?>
@section('css')
    @parent
    <style>
        .nav-tabs-custom > .tab-content {
            padding-bottom: 0
        }
    </style>
@stop

<form method="get">
    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_minimize" data-toggle="tab"><i class="fa fa-minus"></i></a></li>
            <li><a href="#tab_basic" data-toggle="tab">Filters</a></li>
            <li><a href="#tab_advanced" data-toggle="tab">Fields</a></li>

            <li class="pull-right">@include($report->ctaPath())</li>
        </ul>

        <div class="tab-content">

            <div class="tab-pane active " id="tab_minimize">
                @include('form.text',['var'=>['name'=>'report_name','label'=>'Report name', 'div'=>'col-sm-10']])
                @include('form.select-array',['var'=>['name'=>'rows_per_page','label'=>'Rows per page','options'=>kv([10,25,50,100]),'div'=>'pull-right col-md-2']])

            </div>

            <div class="tab-pane" id="tab_basic">
                <?php
                $var = [
                    'name' => 'application_session_id',
                    'label' => 'Session',
                    'div' => 'col-sm-3',
                    'null_option' => true,
                ];
                //for admins show all values

                $var['model'] = \App\ApplicationSession::class;
                $var ['show_inactive'] = true;
                ?>
                @include('form.date',['var'=>['name'=>'created_at_from','label'=>'Created(from)', 'div'=>'col-md-3']])
                @include('form.date',['var'=>['name'=>'created_at_till','label'=>'Created(till)', 'div'=>'col-md-3']])
                @include('form.select-model',['var'=>$var])
                <div class="clearfix"></div>
                @include('form.select-model',['var'=>['name'=>'course_id','label'=>'Course','table'=>'foreign_application_courses', 'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'application_category','label'=>'Government/Private Institute', 'options'=>kv($optionsGovernmentPublic),'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'is_saarc','label'=>'Is SAARC?', 'options'=>($yesNoOptions),'div'=>'col-md-3']])

                <div class="clearfix"></div>
                @include('form.select-array-multiple',['var'=>['name'=>'financing_mode','label'=>'Proposed Mode Of Financing Study', 'options'=>kv($fundingModes), 'div'=>'col-md-3']])
                @include('form.select-model-multiple',['var'=>['name'=>'domicile_country_id','label'=>'Domicile Country','table'=>'countries', 'div'=>'col-md-3']])
                @include('form.select-model-multiple',['var'=>['name'=>'dob_country_id','label'=>'DOB Country','table'=>'countries', 'div'=>'col-md-3']])

                <div class="clearfix"></div>
                @include('form.select-array-multiple',['var'=>['name'=>'status','label'=>'Status', 'options'=>kv($statuses),'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'is_payment_verified','label'=>'Payment Verified?', 'options'=>($yesNoOptions),'div'=>'col-md-3']])
                @include('form.select-array',['var'=>['name'=>'is_document_verified','label'=>'Document Verified?', 'options'=>($yesNoOptions),'div'=>'col-md-3']])

            </div>

            <div class="tab-pane" id="tab_advanced">
                @include($report->advancedFilterPath())
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
</form>

@section('js')
    @parent
    <script type="text/javascript">
        $('select[id=dob_country_id]').select2();
        $('select[id=domicile_country_id]').select2();
        $('select[id=financing_mode]').select2();
        $('select[id=status]').select2();

    </script>
@endsection