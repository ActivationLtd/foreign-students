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
 * @var \App\Tenant $element
 * @var \App\Tenant $tenant
 * @var \App\Tenant $tenant
 * @var \App\Projects\DgmeStudents\Modules\Tenants\TenantViewProcessor $view
 */
$tenant = $element;

?>

@section('content')
    <div class="col-md-12 no-padding">

        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif

        {{--    Form inputs: starts    --}}
        {{--   --------------------    --}}
        @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
        @include('form.text',['var'=>['name'=>'code','label'=>'code']])
        @include('form.is-active')
        {{--    Form inputs: ends    --}}

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
    @include('projects.dgme-students.modules.tenants.form.js')
@endsection