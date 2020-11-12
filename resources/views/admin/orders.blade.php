@extends('layouts.admin')
@section('title', 'Заказы')
@section('buttons')

@stop
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive darkest-table">
                <table class="table table-bordered" id="ordersDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Сумма</th>
                        <th>Валюта</th>
                        <th>Метод оплаты</th>
                        <th>Дополнительно</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['id']}}</td>
                            <td>{{ $order['order_total']}}</td>
                            <td>{{ $order['order_currency']}}</td>
                            <td>{{ $order['payment_method'] }}</td>
                            <td><a class="table-link" href="{{ url('/admin/order/'.$order['id']) }}">Просмотр заказа</a></td>
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
            var ordersDataTable = $('#ordersDataTable').DataTable({
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
                    // ordersDataTable.columns.adjust().draw();
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