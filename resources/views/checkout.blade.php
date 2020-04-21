@extends('layouts.larapizza')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
				<form action="#" id="order" class="billing-form">
							<h3 class="mb-4 billing-heading">Billing Details</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="first_name">First Name</label>
						<input type="text" id="first_name" name="first_name"class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="last_name">Last Name</label>
	                  <input type="text" id="last_name" name="last_name"class="form-control" placeholder="">
	                </div>
                </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="street_address">Street Address</label>
	                  <input type="text" id="street_address" name="street_address" class="form-control" placeholder="House number and street name">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                  <input type="text" id="address_misc" name="address_misc" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="address_city">Town / City</label>
	                  <input type="text" id="address_city" name="address_city" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="address_zip">Postcode / ZIP *</label>
	                  <input type="text" id="address_zip" name="address_zip" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input type="text" id="phone" name="phone" class="form-control" placeholder="">
	                </div>
				  </div>
				  

	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="email">Email Address</label>
				@if (!Auth::guest())
				  <input type="text" id="email" disabled="disabled" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="">
				  @else
				  <input type="text" id="email" name="email" class="form-control" placeholder="">
				  @endif
	                </div>
                </div>
                <div class="w-100"></div>
	            </div>
	          </form><!-- END -->
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-4">
	          	<div class="col-md-12 d-flex pt-4 mb-4">
	          		<div class="cart-detail cart-total">
		    					<p class="d-flex total-price">
								<span class="cart-total-text">Total</span>
							<span class='cart-total-currency'>{{ $currency_icon }}</span><span class='cart-total-price'>{{ number_format($total, 2) }}</span>
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-2">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" value="delivery" checked="checked" name="optradio" class="mr-2"> Payment on delivery</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" value="check" name="optradio" class="mr-2"> Check Payment</label>
											</div>
										</div>
									</div>
									<div class="form-group" style="visibility: hidden;">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									<p><a href="#"class="btn btn-primary py-3 px-4" id="order_submit">Confirm order</a></p>
								</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->


@endsection
