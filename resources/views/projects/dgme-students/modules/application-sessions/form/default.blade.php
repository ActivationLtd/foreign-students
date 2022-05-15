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
 * @var \App\ApplicationSession $element
 * @var \App\ApplicationSession $applicationSession
 * @var \App\Tenant $tenant
 * @var \App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSessionViewProcessor $view
 */
$applicationSession = $element;

?>

@section('content')
    <div class="col-md-12 no-padding">
        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif

        {{---------------|  Form input start |-----------------------}}
        @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
        @include('form.date',['var'=>['name'=>'starts_on','label'=>'Start','tooltip'=>'Session Start Date']])
        @include('form.date',['var'=>['name'=>'ends_on','label'=>'End','tooltip'=>'Session End Date']])
        @include('form.textarea',['var'=>['name'=>'description','label'=>'Description']])

        <div class="clearfix"></div>
        @include('form.select-array',['var'=>['name'=>'status','label'=>'Status','options'=>kv($view->statusTypes())]])
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
    @include('projects.dgme-students.modules.application-sessions.form.js')
@endsection