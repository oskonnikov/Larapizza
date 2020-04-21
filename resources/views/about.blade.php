@extends('layouts.larapizza')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center fadeInUp ftco-animated">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home</a></span> <span>Cart</span></p>
            <h1 class="mb-0 bread">About</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-12 py-5 wrap-about pb-md-5 ftco-animate">
	          <div class="heading-section-bold mb-4 mt-md-5">
	          	<div class="ml-md-0">
		            <h2 class="mb-4">About Larapizza</h2>
	            </div>
	          </div>
	          <div class="pb-md-5">
	          	<p>Larapizza is a fictional project created by Oleg Skonnikov as result of executing The Pizza Task.</p>
							<p>Larapizza based on:</p>
              <ul>
                <li>Laravel - The PHP Framework for Web Artisans</li>
                <li>Vegefoods - template from Colorlib based on Boostrap and Jquery</li>
              </ul>
							<p><a href="https://github.com/oskonnikov/Larapizza" target="_blank "class="btn btn-primary">GitHub Repository of Larapizza</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection
