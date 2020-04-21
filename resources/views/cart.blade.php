@extends('layouts.larapizza')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">Cart</h1>
          </div>
        </div>
      </div>
    </div>
<section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>Product name</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>

							@foreach ($products as $product)
						      <tr class="text-center" id="product_{{ $product['id'] }}">
						        <td class="image-prod"><div class="img" style="background-image:url(images/{{ $product['product_image'] }});"></div></td>
						        <td class="product-name">
						        	<h3>{{ $product['product_name'] }}</h3>
						        </td>
						        
						        <td class="price">{{ $currency_icon }}{{ number_format($product['product_price'], 2) }}</td>
						        
						        <td class="quantity">
									<div class="input-group mb-3">
									<div class="input-group-prepend">
										<button class="btn btn-outline-primary button-minus" type="button">-</button>
									</div>
									<input disabled="disabled" type="text" name="quantity" class="form-control input-number" data-product="{{ $product['id'] }}" data-prev="{{ $product['count'] }}" value="{{ $product['count'] }}" min="1" max="100">
									<div class="input-group-append">
										<button class="btn btn-outline-primary button-plus" type="button">+</button>
									</div>
									</div>
					          	</td>
						        
						        <td class="total">{{ $currency_icon }}<span id="selected_total_{{ $product['id'] }}">{{ number_format($product['total'], 2) }}</span></td>
						      </tr><!-- END TR-->
							  @endforeach

						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col-lg-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<p class="d-flex total-price">
    						<span class="cart-total-text">Total</span>
							<span class='cart-total-currency'>{{ $currency_icon }}</span><span class='cart-total-price'>{{ number_format($total, 2) }}</span>
							@if ($total > 0)
							<a href="/checkout" class="btn btn-outline-primary">Proceed to Checkout</a>
							@endif		
    					</p>
    				</div>
				</div>

    		</div>
			</div>
		</section>
@endsection
