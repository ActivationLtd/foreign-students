@extends('projects.dgme-students.layouts.centered.template')

@section('content')

    <h4>Applicant Registration Form</h4>
    <div class="card-body">
        {{ Form::open(['route' => 'register.applicant','class'=>"applicant-registration-form", 'name'=>'applicant_registration_form','id'=>'applicant_registration_form']) }}
        @include('form.text',['var'=>['name'=>'first_name','label'=>'First Name', 'div'=>'col-sm-6','tooltip'=>'Applicant\'s First Name']])
        @include('form.text',['var'=>['name'=>'last_name','label'=>'Last Name', 'div'=>'col-sm-6','tooltip'=>'Applicant\'s Last Name']])
        @include('form.text',['var'=>['name'=>'email','label'=>'Email Address', 'div'=>'col-sm-6','tooltip'=>'Applicant\'s Email Name']])
        @include('form.select-model',['var'=>['name'=>'country_id','label'=>'Country','table' => 'countries', 'div'=>'col-sm-6','tooltip'=>'Applicant\'s Country Of Residence']])
        @include('form.text',['var'=>['name'=>'passport_no','label'=>'Passport No', 'div'=>'col-sm-12','tooltip'=>'Applicant\'s Own Passport No']])
        @include('form.text',['var'=>['name'=>'password','type'=>'password','label'=>'Password','value'=>'', 'div'=>'col-sm-6','tooltip'=>'Min 6 Characters Including Alphabets And Numbers']])
        @include('form.text',['var'=>['name'=>'password_confirmation','type'=>'password','label'=>'Confirm Password', 'div'=>'col-sm-6','tooltip'=>'Must Match Given Password']])
        <div class="form-group row mb-0">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block lb-bg">{{ __('Register Applicant') }}</button>
            </div>
            <div class="col-md-12" style="margin-top:5px">
                <a class="btn btn-primary btn-block " href="{{route('login')}}" style="color:white">Log In</a>
            </div>
        </div>

        {{ Form::close() }}
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $('select[id=country_id]').select2();
        $('#applicant_registration_form').validationEngine({
            prettySelect: true,
            promptPosition: "topLeft",
            scroll: true
        });

        $("#applicant_registration_form input[name=first_name]").addClass('validate[required]');
        $("#applicant_registration_form input[name=last_name]").addClass('validate[required]');
        $("#applicant_registration_form input[name=email]").addClass('validate[required]');
        $("#applicant_registration_form select[id=country_id]").addClass('validate[required]');
        $("#applicant_registration_form input[name=passport_no]").addClass('validate[required]');
        $("#applicant_registration_form input[name=password]").addClass('validate[required]');

    </script>

@endsection