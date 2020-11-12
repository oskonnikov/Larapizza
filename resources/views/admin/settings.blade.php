@extends('layouts.admin')
@section('title', 'Параметры')
@section('buttons')
    <a href="{{ url('/admin/settings/add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Добавить параметр</a>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <p>Обращение к значению параметра производится по id</p>
            <div class="table-responsive darkest-table">
                <table class="table table-bordered" id="settingsDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Параметр</th>
                        <th>Значение</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($settings as $setting)
                        <tr>
                            <td>{{ $setting->id }}</td>
                            <td>{{ $setting->name }}</td>
                            <td>{{ $setting->value }}</td>
                            <td><a class="table-link" href="{{ url('/admin/settings/edit/'.$setting->id) }}">Изменить</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('additional-scripts')
    <script>
        $(document).ready(function () {
            var settingsDataTable = $('#settingsDataTable').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": false,
                'colReorder': true,
                'stateSave': true,
                "pageLength": 50,
                fixedHeader: {
                    headerOffset: $('.navbar').outerHeight()
                },
                "initComplete": function (a) {
                    // $('.dataTables_scrollBody').css('min-height', '600px');
                    // settingsDataTable.columns.adjust().draw();
                },
                "drawCallback": function (data) {
                },
                "stateSaveCallback": function (settings, data) {

                },
                "columns": [
                    {"data": "0"},
                    {"data": "1"},
                    {"data": "2"},
                    {"data": "3"}
                ],
                "order": [[0, "asc"]]
            });
        });
    </script>
@endsection