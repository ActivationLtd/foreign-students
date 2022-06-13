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
    // Make all select2
    $('select').select2();

    // Redirection after delete
    $('.delete-cta button[name=genericDeleteBtn]').attr('data-redirect_success', '{!! $element->indexUrl() !!}');

    $('#declaration').hide();
    // Validation
    addValidationRules();
    enableValidation('{{$module->name}}');
    showOrHidePreviousApplicationDetailsSection();
    showOrHideFinancingModeDetailsSection();

    handleApplicationSubmitButtonClick();

    /*
    |--------------------------------------------------------------------------
    | creating
    |--------------------------------------------------------------------------
    */
    @if($element->isCreating())
    // Todo: write codes here.
    $('.delete-cta').css('margin-right', '0');
    $('.cta-block').css({'position': 'relative', 'border-top': 'none'});
    @endif

    /*
    |--------------------------------------------------------------------------
    | updating
    |--------------------------------------------------------------------------
    */


    $('#foreign-student-applicationsSubmitBtn').html('{!!  $view->submitButtonText()  !!}');

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


    /**
     * There is an additional button to initiate the submit process.
     * This function handles the steps when the button is clicked.
     */
    function handleApplicationSubmitButtonClick() {
        $('#applicationSubmitButton').click(function () {

            // 1- Change the status input field
            $('select[name=status]').val('Submitted');
            $('input[name=status]').val('Submitted');

            // 2- Show alert message

            showAlert("Please confirm the declaration.<br>" +
                "Once submitted, the application can no longer be edited.Carefully check your application before submission.<br>"
            );

            // 3- Hide the application submit button and change text of default CTA save button
            $('#applicationSubmitButton').hide();
            $('#foreign-student-applicationsSubmitBtn').html('<i class="fa fa-check"></i> Submit');

            // 4 - Show the declaration text and add a checkbox with validation
            $('#declaration').show();
            $("input[id=declaration_check]").addClass('validate[required]');
        });
    }

    /**
     * Based on value of has_previous_application show/hide details field
     */
    function showOrHidePreviousApplicationDetailsSection() {
        $('select[name=has_previous_application]').on('change', function () {
            var div = $('.previous_application_feedback_div');
            div.hide();
            if ($(this).val() == 1) {
                div.show();
            }
        }).trigger('change');
    }

    /**
     * Based on financing_mode of has_previous_application show/hide details field
     */
    function showOrHideFinancingModeDetailsSection() {
        $('select[name=financing_mode]').on('change', function () {
            var div = $('.finance_mode_other_div');
            div.hide();
            if ($(this).val() == 'Other') {
                div.show();
            }
        }).trigger('change');
    }
</script>