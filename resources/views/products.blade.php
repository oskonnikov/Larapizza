@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                   Test
                </div>
                @foreach ($products as $product)
  <p>Product: {{ $product->product_name }}</p>
  <p>Price: {{ $product->product_price }}</p>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
