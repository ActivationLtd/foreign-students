@extends('mainframe.layouts.module.form.template')

<?php
/**
 * @var \App\Mainframe\Modules\Modules\Module $module
 * @var \App\User $user
 * @var \App\Mainframe\Modules\Countries\Country $element
 * @var string $formState create|edit
 * @var array $formConfig
 * @var string $uuid Only available for create
 * @var bool $editable
 */
use App\ForeignStudentApplication;
$yesNoOptions = ForeignStudentApplication::$optionsYesNo;
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
        @include('form.select-array',['var'=>['name'=>'is_saarc','label'=>'Is SAARC?', 'options'=>($yesNoOptions),'div'=>'col-md-2']])

        @include('form.is-active')
        {{--    Form inputs: ends    --}}

        @include('form.action-buttons')

        {{ Form::close() }}
    </div>
@endsection

@section('content-bottom')
    @parent
    <div class="col-md-6 no-padding-l">
        <h5>File upload</h5>
        <small>Upload one or more files</small>
        @include('form.uploads',['var'=>['limit'=>99]])
    </div>
@endsection

@section('js')
    @parent
    @include('mainframe.modules.countries.form.js')
@endsection