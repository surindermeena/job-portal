@extends('layout.app')

@section('content')

@include('frontside.component.pageTitle', ['title'=>'How it Works'])

	<section>
		<div class="block ">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						@foreach ($alldata as $item)
							<div class="how-works {{ $item->id == 2 ? 'flip' : '' }}">
								<div class="how-workimg">
									<img src="{{ asset('images/resource/' . $item->image) }}" alt="{{ $item->title }}" />
								</div>
								<div class="how-work-detail">
									<div class="how-work-box">
										<span>{{ $item->id}}</span>
										<i class="la la-{{$item->icon}}"></i>
										<h3>{{ $item->title }}</h3>
										<p>{{ $item->description }}</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					
				</div>
			</div>
		</div>
	</section>
    
    @endsection
