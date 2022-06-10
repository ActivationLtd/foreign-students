@extends('projects.dgme-students.layouts.default.template')

@section('head-title')
    {{config('app.name')}} | FAQ
@endsection
@section('title')
    Frequently Asked Questions
@endsection

@section('content')
    <div class="row">
        <ol>
            <li>
                <span class="faq-question">For how long an applicant is allowed to edit an application that has been submitted?</span>
                <span class="faq-answer">An applicant can no longer update an application once submitted. Carefully check your application before submission.</span>
            </li>
        </ol>
    </div>
@endsection
