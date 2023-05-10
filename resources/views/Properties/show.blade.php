@extends('app')

@section('content')

    <section class="container d-flex flex-column">
        <section class="d-flex flex-column justify-content-center align-items-center bg-body-secondary rounded-4" id="imagesfield">
            <div id="carouselExample" class="carousel slide w-75">
                <div class="carousel-inner">
                    @php
                        $first=true;
                    @endphp
                    @forelse ($property->images as $image)
                    @if ($first)
                        <div class="carousel-item active">
                            <img src={{asset($image->image_url)}} class="d-block w-100 object-fit-cover rounded-4 my-3" alt="..." style="height:20rem">
                        </div>
                        @php
                            $first=false;
                        @endphp
                    @else
                        <div class="carousel-item">
                            <img src={{asset($image->image_url)}} class="d-block w-100 object-fit-cover rounded-4 my-3" alt="..." style="height:20rem">
                        </div>
                    @endif
                        
                    @empty
                        <div class="carousel-item active">
                        <img src="{{asset('Images/assets/noimage.png')}}" class="d-block w-100 object-fit-cover my-3" alt="..." style="height:20rem">
                      </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              <div class="d-flex flex-nowrap col-9 mb-3 gap-3 overflow-x-scroll">
                @forelse ($property->images as $image)
                    <div class="d-flex object-fit-cover miniimage col-4">
                        <img src={{asset($image->image_url)}} class="d-block w-100 h-100 object-fit-cover rounded-4" alt="...">
                    </div>
                @empty
                    
                @endforelse
              </div>
        </section>
        <section class="d-flex" id="propertyinfo">

        </section>

    </section>
    
@endsection