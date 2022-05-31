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


    /*
    |--------------------------------------------------------------------------
    | creating
    |--------------------------------------------------------------------------
    */
    @if($element->isCreating())
    $('#foreign-student-applicationsSubmitBtn').html('<i class="fa fa-check"></i>Next');
    // Todo: write codes here.
    @endif

    /*
    |--------------------------------------------------------------------------
    | updating
    |--------------------------------------------------------------------------
    */
    @if($element->isUpdating())
    ajaxForExaminations();
    validationForExaminations();
    loadDomicileCountry();
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
        $("select[name=course_id]").addClass('validate[required]');
        $("select[name=application_category]").addClass('validate[required]');
        $("select[name=is_saarc]").addClass('validate[required]');
        $("input[name=applicant_name]").addClass('validate[required]');
        $("input[name=applicant_email]").addClass('validate[required]');
        $("input[name=applicant_mobile_no]").addClass('validate[required]');
    }


    function handleLanguageProficiencySuccess(response) {
        $("#appLanguageProficiencyDatatableDt").DataTable().ajax.reload();
        $("#languageProficiencyFormModalCloseButton").click();
        $("#languageProficiencyForm").trigger("reset");
        console.log(response);
    }


    /**
     * Validation For Examination
     */
    function validationForExaminations() {
        let currentYear = new Date().getFullYear();
        let oneYearBefore = currentYear - 1;
        let twoYearBefore = currentYear - 2;
        let threeYearBefore = currentYear - 3;
        let fiveYearBefore = currentYear - 5;

        $('#applicationExaminationForm').validationEngine({
            prettySelect: true,
            promptPosition: "topLeft",
            scroll: false
        });
        $('#applicationExaminationForm #examination_type').addClass('validate[required]');
        $('#applicationExaminationForm #examination_name').addClass('validate[required]');
        $('#applicationExaminationForm #passing_year').addClass('validate[required]');
        $('#applicationExaminationForm #examination_type').change(function () {
            let minYear = null;
            let maxYear = null;
            $('#applicationExaminationForm #passing_year').removeClass();
            if (this.value == 'O level') {
                minYear = fiveYearBefore;
                maxYear = threeYearBefore;

            } else if (this.value == 'A level') {
                minYear = twoYearBefore;
                maxYear = oneYearBefore;
            }
            $('#applicationExaminationForm #passing_year').addClass('form-control passing_year validate[required] validate[min[' + minYear + '],max[' + maxYear + ']]')
        });
        $('#applicationExaminationForm #subjects').addClass('validate[required]');
        $('#applicationExaminationForm #certificate_name').addClass('validate[required]');

    }

    /**
     * Ajax For Examination
     */
    function ajaxForExaminations() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#applicationExaminationForm").submit(function (e) {
            e.preventDefault();
            if ($("#applicationExaminationForm").validationEngine('validate')) {
                $.ajax({
                    type: 'POST',
                    url: "{{route('foreign-application-examinations.store')}}",
                    data: $('#applicationExaminationForm').serialize(),
                    success: function (data) {
                        $('#applicationExaminationDatatableDt').DataTable().ajax.reload();
                        $('#applicationExaminationModalCloseButton').click();
                        $("#applicationExaminationForm").trigger('reset');
                    }
                });
            }


        });
    }

    function declarationLogic() {
        if ($('select[name=status]').val() == "Submitted") {
            $('#declaration').show();
            $('input[id=declaration_check]').prop('checked', true);
            //make the button read Only after application is submitted
            $('input[id=declaration_check]').prop('readonly', true);

        } else {
            $('#declaration').hide();
            $('input[id=declaration_check]').prop('checked', false);

        }
    }

    function showDeclaration() {
        declarationLogic();
        $('select[name=status]').change(function () {
            if ($('select[name=status]').val() == "Submitted") {
                showAlert("Please confirm the declaration <br>" +
                    " Once submitted the application can be edited in the next 24 hours only.");
                $('#declaration').show();
                $('#applicationSubmitButton').hide();
                $('#foreign-student-applicationsSubmitBtn').html("Submit");
                $("input[id=declaration_check]").addClass('validate[required]');
            } else {
                $('#declaration').hide();
                $("input[id=declaration_check]").removeClass('validate[required]');
            }
        });
    }

    function applicationSubmitButtonAction() {
        $('#applicationSubmitButton').click(function () {
            $('select[name=status]').val('Submitted');
            showAlert("Please confirm the declaration.<br>" +
                "Once submitted the application can be edited in the next 24 hours only.<br>"
            );
            $('#applicationSubmitButton').hide();
            $('#foreign-student-applicationsSubmitBtn').removeClass('submit btn btn-success').addClass('submit btn btn-success').html('<i class="fa fa-check"></i> Submit');
            $('#declaration').show();
            $("input[id=declaration_check]").addClass('validate[required]');
        });
    }

    function showPreviousApplicationFeedbackLogic() {
        $('#previousApplicationFeedback').hide();
        if ($('select[name=has_previous_application]').val() == 1) {
            $('#previousApplicationFeedback').show();
        }
    }

    function showPreviousApplicationFeedback() {
        showPreviousApplicationFeedbackLogic();
        $('select[name=has_previous_application]').change(showPreviousApplicationFeedbackLogic);
    }

    function showApplicationFinanceOtherLogic() {
        $('#applicationFinanceOther').hide();
        if ($('select[name=financing_mode]').val() == 'Other') {
            $('#applicationFinanceOther').show();
        }
    }

    function showApplicationFinanceOther() {
        showApplicationFinanceOtherLogic();
        $('select[name=financing_mode]').change(showApplicationFinanceOtherLogic);
    }


    function loadDomicileCountry() {
        let url = '{{route('countries.list-json',['is_active'=>'1','force_all_data'=>'yes'])}}';

        $('select[name=is_saarc]').on('change', function () {
            let isSaarc = $('select[name=is_saarc]').val();
            var childOldValue = $("select[name=domicile_country_id]").select2('val'); // Temprarily store value to assign after ajax loading
            $("select[name=domicile_country_id]").select2("val", "").empty().select2('enable', false); // Clear and disable child
            /*----------------------------------------
            | Options 1 : Axios based implementations
            |----------------------------------------*/
            axios.get(url, {
                params: {
                    is_saarc: isSaarc,
                    force_all_data: 'yes',
                }
            }).then((response) => {
                $($("select[name=domicile_country_id]")).append("<option value=0>" + "-" + "</option>"); // Add empty selection
                $.each(response.data.data.items, function (i, obj) { // Load options
                    $($("select[name=domicile_country_id]")).append("<option value=" + obj.id + ">" + obj.name + "</option>");
                });
                $("select[name=domicile_country_id]").select2('enable', true); // Enable back child after the ajax call
                $("select[name=domicile_country_id]").val(childOldValue).select2(); // Assign backold value
            });
        });

    }
</script>