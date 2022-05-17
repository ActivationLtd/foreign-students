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
 * @var \App\ModuleGroup $element
 * @var \App\ModuleGroup $moduleGroup
 * @var \App\Tenant $tenant
 * @var \App\Projects\DgmeStudents\Modules\ModuleGroups\ModuleGroupViewProcessor $view
 */
$moduleGroup = $element;
?>

@section('content')
    <div class="col-md-12 col-lg-10 no-padding">

        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif

        {{--    Form inputs: starts    --}}
        {{--   --------------------    --}}
        @include('form.text',['var'=>['name'=>'name','label'=>'Name']])
        @include('form.text',['var'=>['name'=>'title','label'=>'Title']])
        @include('form.select-model',['var'=>['name'=>'parent_id','label'=>'Parent module', 'table'=>'modules']])
        @include('form.text',['var'=>['name'=>'level','label'=>'Level']])
        @include('form.text',['var'=>['name'=>'order','label'=>'Order']])
        @include('form.text',['var'=>['name'=>'color_css','label'=>'Color CSS class']])
        @include('form.text',['var'=>['name'=>'icon_css','label'=>'Icon CSS class']])
        @include('form.text',['var'=>['name'=>'default_route','label'=>'Default route name']])

        <div class="clearfix"></div>
        @include('form.textarea',['var'=>['name'=>'description','params'=>['class'=>''],'label'=>'Description', 'div'=>'col-sm-6']])

        <div class="clearfix"></div>
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
    @include('projects.dgme-students.modules.module-groups.form.js')
@endsection