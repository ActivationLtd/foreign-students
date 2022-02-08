<?php
/**
 * Variables
 * @var \App\Mainframe\Features\Datatable\Datatable $datatable
 * @var \App\Mainframe\Modules\Modules\Module $module
 * @var array $columns
 * @var \App\Mainframe\Features\Core\ViewProcessor $view
 */
$datatable = $datatable ?? $view->datatable;
$titles = $datatable->titles();
$columnsJson = $datatable->columnsJson();
$ajaxUrl = $datatable->ajaxUrl();
$datatableName = $datatable->name();
?>

<div class="{{$datatableName}}-container datatable-container">
    <table id="{{$datatableName}}" class="table module-grid table-condensed {{$datatableName}} dataTable table-hover" style="width: 100%">
        <thead class="bg-gray-light">
        <tr>
            @foreach($titles as $title)
                <th>{!! $title !!}</th>
            @endforeach
        </tr>
        </thead>
        {{-- Note: Table body will be added by the dataTable JS --}}
    </table>
</div>

{{--
Section: Data table JS
   We are using and older version of datatable here that instantiates
   using 'dataTable'. The newer version can be initialized using
   'Datatable' (Capital D). The newer version should be used for
   custom datatables.
   For this olderversion we are using fnSetFilteringDelay(2000) for
   the inital search delay.
--}}

@section('js')
    <script type="text/javascript">
        var {{$datatableName}} =
            $('#{{$datatableName}}').DataTable({
                ajax: "{!! $ajaxUrl !!}",
                columns: [{!! $columnsJson !!}],
                processing: true,
                serverSide: true,
                searchDelay: 2000, // Search delay
                minLength: 3, // Minimum characters to be typed before search begins
                lengthMenu: {!! $datatable->lengthMenu() !!},
                pageLength: {!! $datatable->pageLength()!!},
                order: {!! $datatable->order()!!}, // First row descending
                mark: true // Mark/highlight the search results (in yellow)
            });
    </script>
    @parent
@endsection