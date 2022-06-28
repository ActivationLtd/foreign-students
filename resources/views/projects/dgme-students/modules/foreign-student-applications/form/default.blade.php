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
$foreignStudentApplication = $application = $element;
?>

@section('content-top')
    @parent
    @include('mainframe.form.back-link',['var'=>['element'=>$element->user,'class'=>'pull-left']])
    @if($view->showPrintButton())
        <a class="btn btn-default bg-white" href="{{route('applications.print-view',$element)}}"
           target="_blank">Print</a>
        <a id="pdfBtn" class="btn btn-default bg-white" href="{{route('applications.download-pdf',$element)}}"
           target="_blank">Download PDF</a>
    @endif
    @if($view->showDownloadAllButton())
        @include('mainframe.form.download-all-btn')
    @endif

    @if($application->status)
        <span class="btn application-status">
        Application Status:
        <span class="badge status-{{ Str::slug($application->status)}}">{{$application->status}}</span>
    </span>
    @endif

    <div class="clearfix"></div>
    @if($application->isCreating())
        <?php
        $session = \App\ApplicationSession::currentOpenSession();
        ?>
        @if($session->description)
            <div class="alert alert-danger alert-dismissible col-md-10">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>📢 Notice!</h4>
                {{ $session->description }}
            </div>
        @endif
    @endif
    <div class="clearfix"></div>
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
            'model' => App\ApplicationSession::class,
        ];
        //for created only show the existing value
        if ($application->isCreating()) {
            $var['query'] = App\ApplicationSession::class::where('status',
                App\ApplicationSession::SESSION_STATUS_OPEN)->latest('ends_on');
        }
        ?>
        @include('form.select-model',['var'=>$var])

        @include('form.select-array',['var'=>['name'=>'application_category','label'=>'Category', 'options'=>kv($application->availableCategoryOptions())]])
        @include('form.select-array',['var'=>['name'=>'is_saarc','label'=>'Is SAARC?', 'options'=>$view->availableIsSaarcOptions()]])

        <?php
        $model = \App\ForeignApplicationCourse::query();
        if ($application->isCreating() && user()->isApplicant() && $application->session->allowed_course_id_options) {
            $model->whereIn('id', $application->session->allowed_course_id_options);
        }
        ?>
        @include('form.select-model',['var' => ['name' => 'course_id', 'label' => 'Course', 'model'=>$model]])

        <div class="clearfix"></div>

        <h3>2. Applicant Info</h3>
        @if($view->showProfilePic())
            <div class="col-md-3 no-padding-l" style="padding-right: 20px">
                <img class="img-thumbnail" style="height:120px!important;" src="{{$view->profilePicPath()}}"
                     alt="Profile Pic">
            </div>
        @endif
        @include('form.text',['var'=>['name'=>'applicant_name','label'=>'Student Full Name','value'=> $element->applicant_name ?? user()->name, 'div'=>'col-md-9']])
        @include('form.select-array',['var'=>['name'=>'gender','label'=>'Sex','options'=>kv(App\User::$genderOptions),'div'=>'col-sm-3']])
        @include('form.text',['var'=>['name'=>'applicant_email','label'=>'Student Email','value'=> $element->applicant_email ?? user()->email]])
        @include('form.number',['var'=>['name'=>'applicant_mobile_no','label'=>'Student Mobile No']])

        <div class="clearfix"></div>
        @if($application->isCreated())
            @include('form.text',['var'=>['name'=>'applicant_father_name','label'=>'Father\'s Name','div'=>'col-md-6']])
            @include('form.text',['var'=>['name'=>'applicant_mother_name','label'=>'Mother\'s Name','div'=>'col-md-6']])
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'communication_address','label'=>'Full Address to which communication may be sent','div'=>'col-md-12']])
            <div class="clearfix"></div>
            @include('form.date',['var'=>['name'=>'dob','label'=>'Date Of Birth','div'=>'col-md-4']])
            @include('form.select-model',['var'=>['name'=>'dob_country_id','label'=>'Country of Birth','table'=>'countries', 'div'=>'col-md-4']])
            @include('form.text',['var'=>['name'=>'dob_address','label'=>'Place Of Birth','div'=>'col-md-4']])
            <div class="clearfix"></div>
            <?php
            $model = \App\Country::active();
            if (user()->isApplicant() && !$application->domicile_country_id && $application->session->allowed_country_id_options) {
                $model->whereIn('id', $application->session->allowed_country_id_options);
            }
            $element->domicile_country_id = $element->domicile_country_id ?: user()->country_id;
            ?>
            @include('form.select-model',['var'=>['name' => 'domicile_country_id','label' => 'Nationality Country','model'=>$model, 'div' => 'col-md-4']])

            @include('form.text',['var'=>['name'=>'domicile_address','label'=>'Place of Domicile','div'=>'col-md-4']])
            @include('form.plain-text',['var'=>['name'=>'nationality','label'=>'Nationality','div'=>'col-md-4']])
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'applicant_passport_no','label'=>'Passport No','div'=>'col-md-4', 'value'=> $element->applicant_passport_no ?? user()->passport_no, 'tooltip'=>'Must Match The Logged In User Passport']])
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

            <div class="previous_application_feedback_div">
                @include('form.textarea',['var'=>['name'=>'previous_application_feedback','label'=>'Details of Previous Application']])
            </div>


            <div class="clearfix"></div>
            <h3>5. Proposed Mode Of Financing Study</h3>
            @include('form.select-array',['var'=>['name'=>'financing_mode','label'=>'Proposed Mode Of Financing Study', 'options'=>kv(App\ForeignStudentApplication::$fundingModes), 'div'=>'col-md-6']])
            <div class="finance_mode_other_div">
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

            @if(user()->isApplicant())
                @include('form.hidden',['var'=>['name'=>'status']])
            @else
                @include('form.select-array',['var'=>['name'=>'status','label'=>'Status', 'options'=>kv($application->availableStatusOptions())]])
            @endif
            @if($application->submitted_at)
                @include('form.plain-text',['var'=>['name'=>'submitted_at','label'=>'Submitted At']])
            @endif
            <div class="clearfix"></div>
            @if($view->showDecisionFields())
                @include('form.textarea',['var'=>['name'=>'remarks','label'=>'Remark']])
            @endif

            <div class="clearfix"></div>

            <div class="col-md-12 no-padding-l">
                <h3>9. Upload Documents</h3>
            </div>

            <div class="col-md-6 no-padding-l">
                <h5>Applicant's Picture</h5><small>{{-- Upload one or more files --}}</small>
                @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_PROFILE_PIC]])
            </div>

            <div class="col-md-6 no-padding-l">
                <h5>Applicant's Signature</h5><small>{{-- Upload one or more files --}}</small>
                @include('form.uploads',['var'=>['limit'=>1,'type'=>\App\Upload::TYPE_APPLICANT_SIGNATURE]])
            </div>

            <div class="clearfix"></div>

            <div class="col-md-6 no-padding-l">
                <h5>Applicant's Passport</h5><small>{{-- Upload one or more files --}}</small>
                @include('form.uploads',['var'=>['limit'=>5,'type'=>\App\Upload::TYPE_PASSPORT]])
            </div>

            <div class="col-md-6 no-padding-l">
                <h5>Confirmed Payment Document</h5><small>{{-- Upload one or more files --}}</small>
                @include('form.uploads',['var'=>['limit'=>2,'type'=>\App\Upload::TYPE_PAYMENT_DOCUMENT]])
            </div>

            <div class="clearfix"></div>

            <div class="col-md-6 no-padding-l">
                <h5>Applicant's O Level/Different Grading System Or Equivalent Certificate</h5><small>Upload one or more
                    files</small>
                @include('form.uploads',['var'=>['limit'=>5,'type'=>\App\Upload::TYPE_SSC_EQUIVALENT]])
            </div>

            <div class="col-md-6 no-padding-l">
                <h5>Applicant's A Level Or Equivalent Certificate</h5><small>{{-- Upload one or more files --}}</small> <br><br>
                @include('form.uploads',['var'=>['limit'=>5,'type'=>\App\Upload::TYPE_HSC_EQUIVALENT]])
            </div>
            <div class="clearfix"></div>

            <div id="declaration" style="color: red">
                <h3>10. Declaration</h3>
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

@section('js')
    @parent
    @include('projects.dgme-students.modules.foreign-student-applications.form.js')
    <script type="text/javascript">
        $('select[id=dob_country_id]').select2();
        $('select[id=domicile_country_id]').select2();
    </script>
@endsection