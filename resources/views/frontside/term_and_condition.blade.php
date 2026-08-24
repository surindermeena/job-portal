@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'Terms and Conditions'])

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="terms-conditions">
							@foreach ($alldata as $data)
								@if ($data->status == 1)
									<div class="terms">
										<h2>{{ $loop->iteration }}. {{ $data->title }}</h2>
										<p>{{ $data->content }}</p>
									</div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    @endsection

