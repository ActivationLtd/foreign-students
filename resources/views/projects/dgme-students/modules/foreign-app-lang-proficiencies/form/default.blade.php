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
 * @var \App\ForeignAppLangProficiency $element
 * @var \App\ForeignAppLangProficiency $foreignAppLangProficiency
 * @var \App\Tenant $tenant
 * @var \App\Projects\DgmeStudents\Modules\ForeignAppLangProficiencies\ForeignAppLangProficiencyViewProcessor $view
 */
use App\ForeignAppLangProficiency;
$foreignAppLangProficiency = $element;
?>

@section('content')
    <div class="col-md-12 no-padding">
        @if(($formState == 'create'))
            {{ Form::open($formConfig) }} <input name="uuid" type="hidden" value="{{$uuid}}"/>
        @elseif($formState == 'edit')
            {{ Form::model($element, $formConfig)}}
        @endif

        {{---------------|  Form input start |-----------------------}}
        <?php
        $proficiencyLevels = ForeignAppLangProficiency::$proficiencyLevels;
        ?>
        @include('form.text',['var'=>['name'=>'language_name','label'=>'Language','div'=>'col-md-12']])
        @include('form.select-array',['var'=>['name'=>'reading_proficiency','label'=>'Reading', 'options'=>kv($proficiencyLevels)]])
        @include('form.select-array',['var'=>['name'=>'writing_proficiency','label'=>'Writing', 'options'=>kv($proficiencyLevels)]])
        @include('form.select-array',['var'=>['name'=>'speaking_proficiency','label'=>'Speaking', 'options'=>kv($proficiencyLevels)]])
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
    @include('projects.dgme-students.modules.foreign-app-lang-proficiencies.form.js')
@endsection