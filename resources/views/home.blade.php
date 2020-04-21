@extends('layouts.larapizza')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>My Personal Page</span></p>
            <h1 class="mb-0 bread">My Personal Page</h1>
          </div>
        </div>
      </div>
</div>
<section class="ftco-cart">
			<div class="container">
      <div class="row d-flex mb-5 contact-info">
      <div class="heading-section-bold mb-4 mt-md-5">
	          	<div class="ml-md-0">
		            <h2 class="mb-4">About me</h2>
	            </div>
	          </div>
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Name:</span> {{ Auth::user()->name }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> {{ Auth::user()->phone }}</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> {{ Auth::user()->email }}</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Full address: </span> {{ Auth::user()->full_address }}</p>
	          </div>
          </div>
        </div>
				<div class="row">
        <div class="heading-section-bold mb-4 mt-md-5">
	          	<div class="ml-md-0">
		            <h2 class="mb-4">Orders History</h2>
	            </div>
	          </div>
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>Created At</th>
						        <th>Total</th>
						        <th>Payment Method</th>
						      </tr>
						    </thead>
						    <tbody>

							@foreach ($orders as $order)
						      <tr class="text-center">
						        <td class="product-name">
						        	<h3>{{ $order['created_at'] }}</h3>
						        </td>
						        <td class="price">@if ($order['order_currency'] == 'EUR') € @else $ @endif{{ number_format($order['order_total'], 2) }}</td>
						        <td class="price">{{$order['payment_method']}}</td>
						      </tr><!-- END TR-->
							  @endforeach

						    </tbody>
						  </table>
					  </div>
    			</div>
        </div>
        
    		</div>
			</div>
		</section>
@endsection
