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
 * @var \App\ForeignStudentApplication $application
 * @var \App\ForeignStudentApplication $foreignStudentApplication
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationViewProcessor $view
 */
?>
<script>
    /*--------------------------------------------------------------------------
    | Common - creating and updating
    |--------------------------------------------------------------------------*/
    $('select').select2(); // Make all select2

    // Redirection after delete
    $('.delete-cta button[name=genericDeleteBtn]').attr('data-redirect_success', '{!! $element->indexUrl() !!}');
    $('#declaration').hide();
    // Validation
    addValidationRules();
    enableValidation('{{$module->name}}');
    applicationSubmitButtonAction();

    /*
    |--------------------------------------------------------------------------
    | creating
    |--------------------------------------------------------------------------
    */
    @if($element->isCreating())
    $('.delete-cta').css('margin-right', '0');
    $('.cta-block').css({'position': 'relative', 'border-top': 'none'});
    $('#foreign-student-applicationsSubmitBtn').html(' Proceed To Next Step <i class="fa fa-angle-right"></i>');
    // Todo: write codes here.
    @endif

    /*
    |--------------------------------------------------------------------------
    | updating
    |--------------------------------------------------------------------------
    */
    @if($element->isUpdating())
    @if(user()->isApplicant() && $application->status != \App\ForeignStudentApplication::STATUS_SUBMITTED)
    $('#foreign-student-applicationsSubmitBtn').html(' Save as draft');
    @endif

    @endif
    /*
    |--------------------------------------------------------------------------
    | List of functions
    |--------------------------------------------------------------------------
    */
    /**
     * Add CSS for validation rules
     */
    function addValidationRules() {
        $("select[name=application_session_id]").addClass('validate[required]');
        $("select[name=course_id]").addClass('validate[required]');
        $("select[name=application_category]").addClass('validate[required]');
        $("select[name=is_saarc]").addClass('validate[required]');
        $("input[name=applicant_name]").addClass('validate[required]');
        $("input[name=applicant_email]").addClass('validate[required]');
        $("input[name=applicant_mobile_no]").addClass('validate[required]');
    }

    function applicationSubmitButtonAction() {
        $('#applicationSubmitButton').click(function () {
            $('select[name=status]').val('Submitted');
            $('input[name=status]').val('Submitted');
            showAlert("Please confirm the declaration.<br>" +
                "Once submitted, the application can no longer be edited.Carefully check your application before submission.<br>"
            );
            $('#applicationSubmitButton').hide();
            $('#foreign-student-applicationsSubmitBtn').removeClass('submit btn btn-success').addClass('submit btn btn-success').html('<i class="fa fa-check"></i> Submit');
            $('#declaration').show();
            $("input[id=declaration_check]").addClass('validate[required]');
        });
    }

    $('select[name=has_previous_application]').on('change', function () {
        var div = $('.previous_application_feedback_div');
        div.hide();
        if ($(this).val() == 1) {
            div.show();
        }
    }).trigger('change');

    $('select[name=financing_mode]').on('change', function () {
        var div = $('.finance_mode_other_div');
        div.hide();
        if ($(this).val() == 'Other') {
            div.show();
        }
    }).trigger('change');
</script>