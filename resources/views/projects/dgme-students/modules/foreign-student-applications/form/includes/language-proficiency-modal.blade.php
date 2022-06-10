{{-- Datatable and button --}}
<div class="col-md-12 no-padding-l">
    {{--Proficiency List--}}
    <?php
    $datatable = new \App\Projects\DgmeStudents\Datatables\AppLanguageProficiencyDatatable();
    $datatable->addUrlParam(['foreign_student_application_id' => $element->id]);
    $datatable->bPaginate = false;
    ?>
    <h3>7. Proficiency Of Language</h3>
    @include('mainframe.layouts.module.grid.includes.datatable',['datatable'=>$datatable])

    <div class="clearfix"></div>
    @if($view->showLanguageProficiencyCreateButton())
        <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#languageProficiencyModal">Add
        </button>
    @endif
</div>


@section('content-bottom')
    @parent
    <div class="modal fade" id="languageProficiencyModal" tabindex="-1" role="dialog"
         aria-labelledby="languageProficiencyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="languageProficiencyForm" name="languageProficiencyForm"
                      action="{{route('foreign-app-lang-proficiencies.store')}}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Language Proficiency </h5>
                        <button type="button" id="languageProficiencyFormModalCloseButton" class="close"
                                data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                        <input name="foreign_student_application_id" type="hidden" value="{{$element->id}}">
                        <input name="user_id" type="hidden" value="{{$element->user_id}}">
                        <div class="clearfix"></div>
                        @csrf
                        @include('form.text',['var'=>['name'=>'language_name','label'=>'Language','div'=>'col-md-12']])
                        @include('form.select-array',['var'=>['name'=>'reading_proficiency','label'=>'Reading', 'options'=>kv(App\ForeignAppLangProficiency::$proficiencyLevels), 'div'=>'col-md-4']])
                        @include('form.select-array',['var'=>['name'=>'writing_proficiency','label'=>'Writing', 'options'=>kv(App\ForeignAppLangProficiency::$proficiencyLevels), 'div'=>'col-md-4']])
                        @include('form.select-array',['var'=>['name'=>'speaking_proficiency','label'=>'Speaking', 'options'=>kv(App\ForeignAppLangProficiency::$proficiencyLevels), 'div'=>'col-md-4']])
                        <input name="redirect_success" type="hidden"
                               value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                        <input name="redirect_fail" type="hidden"
                               value="{{route('foreign-student-applications.edit',$element->id)}}"/>
                        {{--<input name="redirect_fail" type="hidden" value="{{URL::full()}}"/>--}}
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Language Proficiency</button>
                        <button id="languageProficiencyFormButtonClose" type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
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
        $('#languageProficiencyForm #language_name').addClass('validate[required]');
        $('#languageProficiencyForm #reading_proficiency').addClass('validate[required]');
        $('#languageProficiencyForm #writing_proficiency').addClass('validate[required]');
        $('#languageProficiencyForm #speaking_proficiency').addClass('validate[required]');

        /**************************
         * 2. Handle form post
         *************************/
        enableValidation('languageProficiencyForm',
            function success(response) {
                $("#languageProficiencyModal").modal('hide');   // 1. Hide the form modal
                $("#languageProficiencyForm").trigger("reset"); // 2. Reset the form inputs
                $("#appLanguageProficiencyDatatableDt").DataTable().ajax.reload(); // 3. Refresh the ajax datatable
            },
            function fail(response) {
                // console.log(response);
            }
        );
    </script>
@endsection