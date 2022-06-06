{{--Education List--}}
<div class="col-md-12 no-padding-l">
    <?php
    $datatable = new \App\Projects\DgmeStudents\Datatables\ApplicationExaminationDatatable();
    $datatable->addUrlParam(['foreign_student_application_id' => $element->id]);
    $datatable->bPaginate = false;
    ?>
    <h3>6. Beginning with Matriculation/O Level or equivalent examinations list your examinations</h3>
    @include('mainframe.layouts.module.grid.includes.datatable',['datatable'=>$datatable])
    <div class="clearfix"></div>
    @if($view->showExaminationCreateButton())
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#examinationModal">
            Add
        </button>
    @endif
</div>


@section('content-bottom')
    @parent

    <div class="modal fade" id="examinationModal" tabindex="-1" role="dialog"
         aria-labelledby="examinationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="applicationExaminationForm" name="applicationExaminationForm"
                      action="{{route('foreign-application-examinations.store')}}"
                      method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Examination</h5>
                        <button id="applicationExaminationModalCloseButton" type="button" class="close"
                                data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                        <input name="foreign_student_application_id" type="hidden" value="{{$element->id}}">
                        <input name="user_id" type="hidden" value="{{$element->user_id}}">
                        <div class="clearfix"></div>
                        @include('form.select-array',['var'=>['name'=>'examination_type','label'=>'O Level/ A Level Equivalent', 'options'=>($examinationTypes),'div'=>'col-md-12']])
                        @include('form.text',['var'=>['name'=>'examination_name','label'=>'Examination','div'=>'col-md-12']])
                        @include('form.number',['var'=>['name'=>'passing_year','label'=>'Passing Year','div'=>'col-md-6']])
                        @include('form.textarea',['var'=>['name'=>'subjects','label'=>'Subjects Taken','div'=>'col-md-12']])
                        @include('form.text',['var'=>['name'=>'certificate_name','label'=>'Certificate','div'=>'col-md-12']])
                        <input name="redirect_success" type="hidden"
                               value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                        <input name="redirect_fail" type="hidden"
                               value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                        {{--<input name="redirect_fail" type="hidden" value="{{URL::full()}}"/>--}}
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button id="applicationExaminationFormButton" name="applicationExaminationFormButton"
                                type="submit" class="btn btn-primary">Add
                            Examination
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent

    <script>
        /**************************
         * 1. Add FE validations
         * todo:(optional)
         *************************/
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

        /**************************
         * 2. Handle form post
         *************************/
        enableValidation('applicationExaminationForm',
            function success(response) {
                $("#examinationModal").modal('hide');
                $("#applicationExaminationForm").trigger('reset');
                $('#applicationExaminationDatatableDt').DataTable().ajax.reload();
            },
            function fail(response) {
                // console.log(response);
            }
        );
    </script>
@endsection