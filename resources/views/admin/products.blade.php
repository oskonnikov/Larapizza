@extends('layouts.admin')
@section('title', 'Продукты')
@section('buttons')
    <a href="{{ url('/admin/products/add') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Добавить продукт</a>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive darkest-table">
                <table class="table table-bordered" id="productsDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Стоимость</th>
                        <th>Изображение</th>
                        <th>Активен</th>
                        <th>Дополнительно</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->product_image }}</td>
                            <td>@if($product->product_active == 1) Да @else Нет @endif</td>
                            <td><a class="table-link" href="{{ url('/admin/products/edit/'.$product->id) }}">Изменить</a></td>
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
            var productsDataTable = $('#productsDataTable').DataTable({
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
                    {"data": "3"},
                    {"data": "4"}
                ],
                "order": [[0, "asc"]]
            });
        });
    </script>
@endsection