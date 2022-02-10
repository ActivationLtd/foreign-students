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
use App\ForeignAppLangProficiency;use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication;$foreignStudentApplication = $element;
?>

@section('content')
    <div class="col-md-12 no-padding">
        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif
        {{---------------|  Form input start |-----------------------}}
        @include('form.text',['var'=>['name'=>'applicant_name','label'=>'Name','div'=>'col-md-12']])
        @include('form.text',['var'=>['name'=>'applicant_email','label'=>'Student Email','div'=>'col-md-4']])
        @include('form.text',['var'=>['name'=>'applicant_mobile_no','label'=>'Student Mobile No','div'=>'col-md-4']])
        @include('form.text',['var'=>['name'=>'applicant_father_name','label'=>'Father\'s Name','div'=>'col-md-6']])
        @include('form.text',['var'=>['name'=>'applicant_mother_name','label'=>'Mother\'s Name','div'=>'col-md-6']])
        <div class="clearfix"></div>
        @include('form.textarea',['var'=>['name'=>'communication_address','label'=>'Full Address to which communication may be sent']])
        <div class="clearfix"></div>
        @include('form.date',['var'=>['name'=>'dob','label'=>'Date Of Birth','div'=>'col-md-4']])
        @include('form.select-model',['var'=>['name'=>'dob_country_id','label'=>'Country of Birth','table'=>'countries', 'div'=>'col-md-4']])
        @include('form.text',['var'=>['name'=>'dob_address','label'=>'Place Of Birth','div'=>'col-md-4']])
        <div class="clearfix"></div>
        @include('form.select-model',['var'=>['name'=>'domicile_country_id','label'=>'Country of Domicile','table'=>'countries', 'div'=>'col-md-4']])
        @include('form.text',['var'=>['name'=>'domicile_address','label'=>'Place of Domicile','div'=>'col-md-4']])
        <div class="clearfix"></div>
        @include('form.text',['var'=>['name'=>'nationality','label'=>'Nationality','div'=>'col-md-4']])
        <div class="clearfix"></div>
        @include('form.text',['var'=>['name'=>'applicant_passport_no','label'=>'Passport No','div'=>'col-md-4']])
        @include('form.date',['var'=>['name'=>'applicant_passport_issue_date','label'=>'Passport Issue Date','div'=>'col-md-4']])
        @include('form.date',['var'=>['name'=>'applicant_passport_expiry_date','label'=>'Passport Expiry Date','div'=>'col-md-4']])
        <div class="clearfix"></div>
        @include('form.text',['var'=>['name'=>'legal_guardian_name','label'=>'Legal Guardian Name','div'=>'col-md-4']])
        @include('form.text',['var'=>['name'=>'legal_guardian_nationality','label'=>'Legal Guardian Nationality','div'=>'col-md-4']])
        @include('form.textarea',['var'=>['name'=>'legal_guardian_address','label'=>'Address of Legal Guardian']])
        <div class="clearfix"></div>
        <h4>Name and Address of person to be notified in case of emergency</h4>
        @include('form.text',['var'=>['name'=>'emergency_contact_bangladesh_name','label'=>'Emergency Contact Name (Bangladesh)','div'=>'col-md-4']])
        @include('form.textarea',['var'=>['name'=>'emergency_contact_bangladesh_address','label'=>'Emergency Contact Address (Bangladesh)']])
        <div class="clearfix"></div>
        @include('form.text',['var'=>['name'=>'emergency_contact_domicile_name','label'=>'Emergency Contact Name (Domicile)','div'=>'col-md-4']])
        @include('form.textarea',['var'=>['name'=>'emergency_contact_domicile_address','label'=>'Emergency Contact Address (Domicile)']])
        <div class="clearfix"></div>
        <?php
        $yesNoOptions = ForeignStudentApplication::$optionsYesNo;
        $proficiencyLevels = ForeignAppLangProficiency::$proficiencyLevels;
        $fundingModes = ForeignStudentApplication::$fundingModes;
        $statuses = ForeignStudentApplication::$statuses;
        if (user()->isApplicant()) {
            unset($statuses['2']);
            unset($statuses['3']);
            unset($statuses['4']);
        }
        if (user()->isAdmin()) {
            unset($statuses['0']);
        }
        ?>
        <h4>Have you applied for admission in an Educational Institute in Bangladesh Earlier?</h4>
        @include('form.select-array',['var'=>['name'=>'has_previous_application','label'=>'Have Previous Application?', 'options'=>($yesNoOptions)]])
        @include('form.textarea',['var'=>['name'=>'previous_application_feedback','label'=>'Details of Previous Application']])
        <div class="clearfix"></div>
        <h4>Name of the course to which admission is sought:</h4>
        @include('form.select-model',['var'=>['name'=>'course_id','label'=>'Course','table'=>'foreign_application_courses', 'div'=>'col-md-4']])
        @if($element->id)
            <div class="col-md-12 no-padding-l">
                {{--Education List--}}
                <?php
                $datatable = new \App\Projects\DgmeStudents\Datatables\ApplicationExaminationDatatable();
                $datatable->addUrlParam(['foreign_student_application_id' => $element->id]);
                ?>
                <h4 class="col-md-6 no-padding-l">Beginning with Matriculation/SSC or equivalent examinations</h4>

                @if($view->showExaminationCreateButton())
                    <div class="col-md-6 no-padding-r">  <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#examinationModal">
                            Add Examinations
                        </button>
                    </div>
                @endif
                <div class="clearfix"></div>
                @include('mainframe.layouts.module.grid.includes.datatable',['datatable'=>$datatable])
            </div>
            <div class="col-md-12 no-padding-l">
                {{--Proficiency List--}}
                <?php
                $datatable = new \App\Projects\DgmeStudents\Datatables\AppLanguageProficiencyDatatable();
                $datatable->addUrlParam(['foreign_student_application_id' => $element->id]);
                ?>
                <h4 class="col-md-6 no-padding-l">Proficiency Of Language</h4>
                @if($view->showLanguageProfiencyCreateButton())
                    <div class="col-md-6 no-padding-r">  <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#languageProficiencyModal">
                            Add Language Proficiency
                        </button>
                    </div>
                @endif
                <div class="clearfix"></div>
                @include('mainframe.layouts.module.grid.includes.datatable',['datatable'=>$datatable])
            </div>
            <div class="clearfix"></div>
            @include('form.text',['var'=>['name'=>'payment_transaction_id','label'=>'Payment Transaction Id','div'=>'col-md-6']])



        @endif
        @include('form.select-array',['var'=>['name'=>'financing_mode','label'=>'Proposed Mode Of Financing Study', 'options'=>kv($fundingModes)]])
        <div class="clearfix"></div>
        @include('form.select-array',['var'=>['name'=>'status','label'=>'Status', 'options'=>kv($statuses)]])
        @include('form.plain-text',['var'=>['name'=>'submitted_at','label'=>'Submitted At']])
        <div class="clearfix"></div>
        <div id="declaration">
            <h5>Declaration</h5>
            @include('form.checkbox',['var'=>['name'=>'declaration_check']])
            <div class="clearfix"></div>
            <h5>I, hereby, declare that particulars given above are true to the best of my knowledge and believe, that I <br>
                have made satisfactory arrangements for regular supply of funds for my expenditure in Bangladesh and <br>
                that I shall return to my country of domicile after completion or discontinuation of studies in Bangladesh. <br>
                I further declare I shall abide fully by the rules and regulations of the institute and any decision to the <br>
                Authority of the institutions to which I may be admitted</h5>
        </div>

        {{--        @include('form.is-active')--}}
        {{---------------|  Form input start |-----------------------}}
        @if($view->showSubmitButton())
            <button id="applicationSubmitButton" type="button" class="submit btn btn-warning">
                <i class="fa fa-check"></i>Submit
            </button>
        @endif
        @include('form.action-buttons')
        {{ Form::close() }}
    </div>
@endsection

@section('content-bottom')
    @parent
    <div class="col-md-6 no-padding-l">
        <h5>Passport upload</h5><small>Upload one or more files</small>
        @include('form.uploads',['var'=>['limit'=>2,'type'=>\App\Upload::TYPE_PASSPORT]])
        <h5>Payment Document upload</h5><small>Upload one or more files</small>
        @include('form.uploads',['var'=>['limit'=>2,'type'=>\App\Upload::TYPE_PAYMENT_DOCUMENT]])
        <h5>SSC Equivalent File upload</h5><small>Upload one or more files</small>
        @include('form.uploads',['var'=>['limit'=>2,'type'=>\App\Upload::TYPE_SSC_EQUIVALENT]])
        <h5>HSC Equivalent File upload</h5><small>Upload one or more files</small>
        @include('form.uploads',['var'=>['limit'=>2,'type'=>\App\Upload::TYPE_HSC_EQUIVALENT]])
    </div>
    @if($element->id && $view->showExaminationCreateButton())
        <div class="modal fade" id="examinationModal" tabindex="-1" role="dialog" aria-labelledby="examinationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="applicationExaminationForm" name="applicationExaminationForm" action="{{route('foreign-application-examinations.store')}}"
                          method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Examination</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <input name="foreign_student_application_id" type="hidden" value="{{$element->id}}">
                            <input name="user_id" type="hidden" value="{{$element->user_id}}">
                            <div class="clearfix"></div>
                            @include('form.text',['var'=>['name'=>'examination_name','label'=>'Examination','div'=>'col-md-12']])
                            @include('form.number',['var'=>['name'=>'passing_year','label'=>'Passing Year','div'=>'col-md-6']])
                            @include('form.textarea',['var'=>['name'=>'subjects','label'=>'Subjects Taken','div'=>'col-md-12']])
                            @include('form.text',['var'=>['name'=>'certificate_name','label'=>'Certificate','div'=>'col-md-12']])
                            <input name="redirect_success" type="hidden" value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                            <input name="redirect_fail" type="hidden" value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                            {{--<input name="redirect_fail" type="hidden" value="{{URL::full()}}"/>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Examination</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if($element->id && $view->showLanguageProfiencyCreateButton())
        <div class="modal fade" id="languageProficiencyModal" tabindex="-1" role="dialog" aria-labelledby="languageProficiencyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="languageProficiencyForm" name="languageProficiencyForm" action="{{route('foreign-app-lang-proficiencies.store')}}" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Language Proficiency </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <input name="foreign_student_application_id" type="hidden" value="{{$element->id}}">
                            <input name="user_id" type="hidden" value="{{$element->user_id}}">
                            <div class="clearfix"></div>
                            @include('form.text',['var'=>['name'=>'language_name','label'=>'Language','div'=>'col-md-12']])
                            @include('form.select-array',['var'=>['name'=>'reading_proficiency','label'=>'Reading', 'options'=>kv($proficiencyLevels)]])
                            @include('form.select-array',['var'=>['name'=>'writing_proficiency','label'=>'Writing', 'options'=>kv($proficiencyLevels)]])
                            @include('form.select-array',['var'=>['name'=>'speaking_proficiency','label'=>'Speaking', 'options'=>kv($proficiencyLevels)]])
                            <input name="redirect_success" type="hidden" value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                            <input name="redirect_fail" type="hidden" value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                            {{--<input name="redirect_fail" type="hidden" value="{{URL::full()}}"/>--}}
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Language Proficiency</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    @parent
    @include('projects.dgme-students.modules.foreign-student-applications.form.js')
    <script type="text/javascript">
        $('select[id=dob_country_id]').select2();
        $('select[id=domicile_country_id]').select2();

        $('#applicationExaminationForm').validationEngine({
            prettySelect: true,
            promptPosition: "topLeft",
            scroll: false
        });
        $('#applicationExaminationForm #examination_name').addClass('validate[required]');
        $('#applicationExaminationForm #passing_year').addClass('validate[required]');
        $('#applicationExaminationForm #subjects').addClass('validate[required]');
        $('#applicationExaminationForm #certificate_name').addClass('validate[required]');

        $('#languageProficiencyForm').validationEngine({
            prettySelect: true,
            promptPosition: "topLeft",
            scroll: false
        });
        $('#languageProficiencyForm #language_name').addClass('validate[required]');
        $('#languageProficiencyForm #reading_proficiency').addClass('validate[required]');
        $('#languageProficiencyForm #writing_proficiency').addClass('validate[required]');
        $('#languageProficiencyForm #speaking_proficiency').addClass('validate[required]');
    </script>
@endsection