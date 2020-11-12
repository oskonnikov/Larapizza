@extends('layouts.admin')
@section('title', 'Просмотр Заказа '.$order->id)
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <p class="text-muted">Имя клиента: {{$order->name}} {{$order->surname}}</p>
            <p class="text-muted">Телефон: {{$order->phone}}</p>
            <p class="text-muted">Сумма заказа: {{$order->order_total}}</p>
            <p class="text-muted">Валюта заказа: {{$order->order_currency}}</p>
            <p class="text-muted">Тип оплаты: {{$order->payment_method}}</p>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive darkest-table">
                <table class="table table-bordered" id="ordersDataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Стоимость (USD)</th>
                        <th>Количество</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderproducts as $orderproduct)
                        <tr>
                            <td>{{ $orderproduct['id']}}</td>
                            <td>{{ $orderproduct['product_name']}}</td>
                            <td>{{ $orderproduct['product_price']}}</td>
                            <td>{{ $orderproduct['product_count'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection