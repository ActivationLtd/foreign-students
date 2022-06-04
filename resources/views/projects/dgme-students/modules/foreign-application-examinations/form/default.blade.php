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
 * @var \App\ForeignApplicationExamination $element
 * @var \App\ForeignApplicationExamination $foreignApplicationExamination
 * @var \App\Tenant $tenant
 * @var \App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExaminationViewProcessor $view
 */
use App\ForeignApplicationExamination;
$foreignApplicationExamination = $element;
$examinationTypes = ForeignApplicationExamination::$examinationTypes;
?>
@section('content-top')
    @if($element->foreignApplication()->exists())
        <a class="btn btn-default" href="{{route('foreign-student-applications.edit',$element->foreignApplication->id)}}"> <i class="fa fa-angle-left"></i> Back To Application </a>
    @endif
@endsection
@section('content')
    <div class="col-md-12 no-padding">
        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif

        {{---------------|  Form input start |-----------------------}}
        {{--        @include('form.text',['var'=>['name'=>'name','label'=>'Name']])--}}
        @include('form.select-array',['var'=>['name'=>'examination_type','label'=>'O Level/ A Level Equivalent', 'options'=>$examinationTypes,'div'=>'col-md-4']])
        @include('form.text',['var'=>['name'=>'examination_name','label'=>'Examination','div'=>'col-md-12']])
        @include('form.number',['var'=>['name'=>'passing_year','label'=>'Passing Year','div'=>'col-md-6']])
        @include('form.textarea',['var'=>['name'=>'subjects','label'=>'Subjects Taken','div'=>'col-md-12']])
        @include('form.text',['var'=>['name'=>'certificate_name','label'=>'Certificate','div'=>'col-md-12']])
        {{--        @include('form.is-active')--}}
        {{---------------|  Form input start |-----------------------}}

        @include('form.action-buttons')
        {{ Form::close() }}
    </div>
@endsection

@section('content-bottom')
    @parent
    {{--    <div class="col-md-6 no-padding-l">--}}
    {{--        <h5>File upload</h5><small>Upload one or more files</small>--}}
    {{--        @include('form.uploads',['var'=>['limit'=>99,'type'=>\App\Upload::TYPE_GENERIC]])--}}
    {{--    </div>--}}
@endsection

@section('js')
    @parent
    @include('projects.dgme-students.modules.foreign-application-examinations.form.js')
@endsection