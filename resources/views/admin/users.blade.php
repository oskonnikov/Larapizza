@extends('layouts.admin')
@section('title', 'Пользователи')
@section('buttons')
    <a href="{{ url('/admin/users/add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus fa-sm"></i> Добавить пользователя</a>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive darkest-table">
                <table class="table table-bordered" id="usersDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Дополнительно</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }} {{ $user['surname'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td><a class="table-link" href="{{ url('/admin/users/edit/'.$user['id']) }}">Изменить</a></td>
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
            var usersDataTable = $('#usersDataTable').DataTable({
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
                    // productsDataTable.columns.adjust().draw();
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