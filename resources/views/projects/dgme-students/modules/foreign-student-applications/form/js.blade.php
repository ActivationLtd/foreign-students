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
 * @var \App\ForeignStudentApplication $foreignStudentApplication
 * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationViewProcessor $view
 */
?>
<script>
    /*
    |--------------------------------------------------------------------------
    | Common - creating and updating
    |--------------------------------------------------------------------------
    */
    // $('select').select2(); // Make all select2

    // Redirection after delete
    @if($element->some_id)
    $('.delete-cta button[name=genericDeleteBtn]').attr('data-redirect_success', '{!! route('some-module.edit',$element->some_id) !!}')
    @endif

    // Validation
    addValidationRules();
    showDeclaration();
    applicationSubmitButtonAction();
    showPreviousApplicationFeedback();
    showApplicationFinanceOther();
    enableValidation('{{$module->name}}');

    /*
    |--------------------------------------------------------------------------
    | creating
    |--------------------------------------------------------------------------
    */
    @if($element->isCreating())
    $('#foreign-student-applicationsSubmitBtn').html("Next");
    // Todo: write codes here.
    @endif

    /*
    |--------------------------------------------------------------------------
    | updating
    |--------------------------------------------------------------------------
    */
    @if($element->isUpdating())
    // Todo: write codes here.
    // Redirection after saving
    // $('#{{$module->name}}-redirect-success').val('#'); //  # Stops redirection
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
        $("input[name=name]").addClass('validate[required]');
    }

    function declarationLogic() {
        if ($('select[name=status]').val() == "Submitted") {
            $('#declaration').show();
            $('input[id=declaration_check]').prop('checked', true);

        } else {
            $('#declaration').hide();
            $('input[id=declaration_check]').prop('checked', false);

        }
    }

    function showDeclaration() {
        declarationLogic();
        $('select[name=status]').change(function () {
            if ($('select[name=status]').val() == "Submitted") {
                showAlert("Please confirm the declaration <br>"+
                    " Once submitted the application can be edited in the next 24 hour only.");
                $('#declaration').show();
                $("input[id=declaration_check]").addClass('validate[required]');
            } else {
                $('#declaration').hide();
                $("input[id=declaration_check]").removeClass('validate[required]');
            }
        });
    }
    function applicationSubmitButtonAction(){
        $('#applicationSubmitButton').click(function(){
            $('select[name=status]').val('Submitted');
            showAlert("Please confirm the declaration.<br>"+
                "Once submitted the application can be edited in the next 24 hour only.<br>" +
                "Click Save after confirmation to update the Application."
            );

            $('#declaration').show();
            $("input[id=declaration_check]").addClass('validate[required]');
        });
    }
    function showPreviousApplicationFeedbackLogic(){
        $('#previousApplicationFeedback').hide();
        if($('select[name=has_previous_application]').val()==1){
            $('#previousApplicationFeedback').show();
        }
    }
    function showPreviousApplicationFeedback(){
        showPreviousApplicationFeedbackLogic();
        $('select[name=has_previous_application]').change(showPreviousApplicationFeedbackLogic);
    }

    function showApplicationFinanceOtherLogic(){
        $('#applicationFinanceOther').hide();
        if($('select[name=financing_mode]').val()=='Other'){
            $('#applicationFinanceOther').show();
        }
    }
    function showApplicationFinanceOther(){
        showApplicationFinanceOtherLogic();
        $('select[name=financing_mode]').change(showApplicationFinanceOtherLogic);
    }
</script>