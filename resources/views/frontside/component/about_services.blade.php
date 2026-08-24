
<section>
    <div class="block remove-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="our-services">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Our Service</h2>
                            </div>
                            @foreach ($alldata->services as $service)
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="service">
                                        <i class="{{$service->icon}}"></i>
                                        <div class="service-info">
                                            <h3>{{$service->service_title}}</h3>
                                            <p>{{$service->service_description}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>