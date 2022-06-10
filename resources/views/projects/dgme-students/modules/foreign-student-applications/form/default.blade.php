@extends('projects.dgme-students.layouts.module.form.template')
<?php
/**
 * @var \App\Module $module
 * @var \App\User $user
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available for create
 * @var bool $editable
 * @var array $immutables
 * @var \App\ForeignStudentApplication $element
 * @var \App\ForeignStudentApplication $foreignStudentApplication
 * @var \App\Tenant $tenant
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationViewProcessor $view
 */

$foreignStudentApplication = $element;

?>

@section('content-top')
    @parent
    @include('mainframe.form.back-link',['var'=>['element'=>$element->user,'class'=>'pull-left']])
    @if($view->showPrintButton())
        <a class="btn btn-default bg-white" href="{{route('applications.print-view',$element)}}" target="_blank">Print</a>
        <a id="pdfBtn" class="btn btn-default bg-white" href="{{route('applications.download-pdf',$element)}}" target="_blank">Download PDF</a>
    @endif
    @if($view->showDownloadAllButton())
        @include('mainframe.form.download-all-btn')
        <div class="clearfix"></div>
    @endif
@endsection

@section('content')
    <div class="col-md-10 no-padding">
        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif


        {{---------------|  Form input start |-----------------------}}
        <h3>1. Name of the course to which admission is sought</h3>
        <?php
        $var = [
            'name' => 'application_session_id',
            'label' => 'Session',
            'div' => 'col-sm-3',
            'null_option' => false,
            'show_inactive' => true,
            'model' => App\ApplicationSession::class,
        ];
        //for created only show the existing value
        if ($element->isCreating()) {
            $var['model'] = App\ApplicationSession::class::where('status',
                App\ApplicationSession::SESSION_STATUS_OPEN)->latest('ends_on');
            $var ['value'] = $element->application_session_id;
        }
        ?>
        @include('form.select-model',['var'=>$var])
        @include('form.select-array',['var'=>['name'=>'application_category','label'=>'Government/Private Institute', 'options'=>kv(App\ForeignStudentApplication::$optionsGovernmentPublic),'div'=>'col-md-3']])
        @include('form.select-array',['var'=>['name'=>'is_saarc','label'=>'Is SAARC?', 'options'=>(App\ForeignStudentApplication::$optionsYesNo),'div'=>'col-md-3']])

        @include('form.select-model',['var' => ['name' => 'course_id', 'label' => 'Course', 'table' => 'foreign_application_courses', 'div' => 'col-md-3']])

        <div class="clearfix"></div>

        <h3>2. Applicant Info</h3>

        @if($view->showProfilePic())
            <div class="col-md-3 no-padding-l" style="padding-right: 20px">
                <img class="img-thumbnail" style="height:120px!important;" src="{{$view->profilePicPath()}}"
                     alt="Profile Pic">
            </div>
        @endif
        @include('form.text',['var'=>['name'=>'applicant_name','label'=>'Student Full Name','div'=>'col-md-6']])
        @include('form.text',['var'=>['name'=>'applicant_email','label'=>'Student Email','div'=>'col-md-3']])
        @include('form.number',['var'=>['name'=>'applicant_mobile_no','label'=>'Student Mobile No','div'=>'col-md-3']])

        <div class="clearfix"></div>
        @if($element->id)

            @include('form.text',['var'=>['name'=>'applicant_father_name','label'=>'Father\'s Name','div'=>'col-md-6']])
            @include('form.text',['var'=>['name'=>'applicant_mother_name','label'=>'Mother\'s Name','div'=>'col-md-6']])
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'communication_address','label'=>'Full Address to which communication may be sent','div'=>'col-md-12']])
            <div class="clearfix"></div>
            @include('form.date',['var'=>['name'=>'dob','label'=>'Date Of Birth','div'=>'col-md-4']])
            @include('form.select-model',['var'=>['name'=>'dob_country_id','label'=>'Country of Birth','table'=>'countries', 'div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'dob_address','label'=>'Place Of Birth','div'=>'col-md-4']])
            <div class="clearfix"></div>
            @include('form.select-model',['var'=>['name' => 'domicile_country_id','table'=>'countries', 'label' => 'Country of Domicile', 'div' => 'col-md-4']])
            @include('form.text',['var'=>['name'=>'domicile_address','label'=>'Place of Domicile','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'nationality','label'=>'Nationality','div'=>'col-md-4']])
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'applicant_passport_no','label'=>'Passport No','div'=>'col-md-4','tooltip'=>'Must Match The Logged In User Passport']])
            {{--            @include('form.date',['var'=>['name'=>'applicant_passport_issue_date','label'=>'Passport Issue Date','div'=>'col-md-4']])--}}
            {{--            @include('form.date',['var'=>['name'=>'applicant_passport_expiry_date','label'=>'Passport Expiry Date','div'=>'col-md-4']])--}}
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'legal_guardian_name','label'=>'Legal Guardian Name','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'legal_guardian_nationality','label'=>'Legal Guardian Nationality','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'legal_guardian_address','label'=>'Address of Legal Guardian','div'=>'col-md-12']])
            <div class="clearfix"></div>
            <h3>3. Name and Address of person to be notified in case of emergency</h3>
            @include('form.text',['var'=>['name'=>'emergency_contact_bangladesh_name','label'=>'Emergency Contact Name (Bangladesh)','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'emergency_contact_bangladesh_address','label'=>'Emergency Contact Address (Bangladesh)','div'=>'col-md-12']])
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'emergency_contact_domicile_name','label'=>'Emergency Contact Name (Domicile)','div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'emergency_contact_domicile_address','label'=>'Emergency Contact Address (Domicile)','div'=>'col-md-12']])
            <div class="clearfix"></div>

            <h3>4. Have you applied for admission in an Educational Institute in Bangladesh Earlier?</h3>
            @include('form.select-array',['var'=>['name'=>'has_previous_application','label'=>'Have Previous Application?', 'options'=>(App\ForeignStudentApplication::$optionsYesNo), 'div'=>'col-md-6']])
            <div id="previousApplicationFeedback">
                @include('form.textarea',['var'=>['name'=>'previous_application_feedback','label'=>'Details of Previous Application']])
            </div>
            <div class="clearfix"></div>
            <h3>5. Proposed Mode Of Financing Study</h3>
            @include('form.select-array',['var'=>['name'=>'financing_mode','label'=>'Proposed Mode Of Financing Study', 'options'=>kv(App\ForeignStudentApplication::$fundingModes), 'div'=>'col-md-6']])
            <div id="applicationFinanceOther">
                @include('form.textarea',['var'=>['name'=>'finance_mode_other','label'=>'Details of Finance Other']])
            </div>
            <div class="clearfix"></div>

            <div class="col-md-12 no-padding-l">
                @include('projects.dgme-students.modules.foreign-student-applications.form.includes.application-examination-modal')
            </div>
            <div class="col-md-12 no-padding-l">
                @include('projects.dgme-students.modules.foreign-student-applications.form.includes.language-proficiency-modal')
            </div>
            <div class="clearfix"></div>
            <h3>8. Payment Info</h3>
            @include('form.text',['var'=>['name'=>'payment_transaction_id','label'=>'Payment Transaction Id','div'=>'col-md-6']])

            <div class="clearfix"></div>
            @if($view->showDecisionFields())
                @include('form.checkbox',['var'=>['name'=>'is_valid','label'=>'Valid Application?']])
                @include('form.checkbox',['var'=>['name'=>'is_payment_verified','label'=>'Payment Verified']])
                @include('form.checkbox',['var'=>['name'=>'is_document_verified','label'=>'Document Verified']])
            @endif
            <div class="clearfix"></div>
            @include('form.select-array',['var'=>['name'=>'status','label'=>'Status', 'options'=>kv($element->availableStatusOptions())]])
            @include('form.plain-text',['var'=>['name'=>'submitted_at','label'=>'Submitted At']])
            <div class="clearfix"></div>
            @if($view->showDecisionFields())
                @include('form.textarea',['var'=>['name'=>'remarks','label'=>'Remark']])
            @endif

            <div class="clearfix"></div>
            <div id="declaration">
                <h3>9. Declaration</h3>
                @include('form.checkbox',['var'=>['name'=>'declaration_check']])
                <div class="clearfix"></div>
                <p>I, thereby, declare that particulars given and documents submitted above are true and valid to the
                    best of my knowledge.<br>
                    I also declare that I shall fully abide by the rules and regulations of the institutions, country
                    and any decisions of Authority of the<br>
                    institution to which I may be admitted. I furthermore declare that if any of the submitted documents
                    found false <br>
                    or tempered, the application will be cancelled</p>
            </div>

            {{--        @include('form.is-active')--}}
            {{---------------|  Form input start |-----------------------}}
            @if($view->showSubmitButton())
                <button id="applicationSubmitButton" type="button" class="submit btn btn-success">
                    <i class="fa fa-check"></i> Submit Application
                </button>
            @endif
        @endif
        @include('form.action-buttons')
        {{ Form::close() }}
    </div>
@endsection

@section('content-bottom')
    @parent
    @if($element->isCreated())
        <div class="col-md-12 no-padding-l">
            <h3>Upload Documents</h3>
        </div>
        <div class="col-md-4 no-padding-l">
            <h5>Applicant's Picture</h5><small>Upload one or more files</small><br/><br/>
            @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_PROFILE_PIC,'zip_download'=>false]])
            <h5>Applicant's Signature</h5><small>Upload one or more files</small>
            @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_APPLICANT_SIGNATURE,'zip_download'=>false]])
        </div>
        <div class="col-md-4 no-padding-l">
            <h5>Applicant's Passport</h5><small>Upload one or more files</small><br/><br/>
            @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_PASSPORT,'zip_download'=>false]])
            <h5>Confirmed Payment Document</h5><small>Upload one or more files</small>
            @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_PAYMENT_DOCUMENT,'zip_download'=>false]])
        </div>
        <div class="col-md-4 no-padding-l">
            <h5>Applicant's O Level/Different Grading System Or Equivalent Certificate</h5><small>Upload one or more
                files</small>
            @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_SSC_EQUIVALENT,'zip_download'=>false]])
            <h5>Applicant's A Level Or Equivalent Certificate</h5><small>Upload one or more files</small>
            @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_HSC_EQUIVALENT,'zip_download'=>false]])
        </div>
    @endif
@endsection

@section('js')
    @parent
    @include('projects.dgme-students.modules.foreign-student-applications.form.js')
    <script type="text/javascript">
        $('select[id=dob_country_id]').select2();
        $('select[id=domicile_country_id]').select2();
    </script>
@endsection