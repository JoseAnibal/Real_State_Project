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
              <div class="d-flex flex-nowrap col-9 mb-3 gap-3 overflow-x-scroll scroll-container mx-auto withscroll" style="width: 50%">
                @forelse ($property->images as $image)
                    <div class="d-flex object-fit-cover miniimage col-4 mx-auto">
                        <img src={{asset($image->image_url)}} class="d-block w-100 h-100 object-fit-cover rounded-4 clickable" alt="..." style="user-select: none;">
                    </div>
                @empty
                @endforelse
              </div>
        </section>
        <section class="d-flex" id="propertyinfo">
            <section class="text-start">
                <h4 class="fw-semibold">{{$property->title}}</h4>
                <p class="fw-light">{{$property->description}}</p>

                <table>
                    <tbody>
                        @if ($property->type == 0 || $property->type == 1)
                            <tr>
                                <td class="rounded-start-4 p-2"><i class="fa-solid fa-circle" style="color: #D9D9D9;"></i> Habitaciones: {{$property->rooms}}</td>
                                <td class="rounded-end-4 p-2"><i class="fa-solid fa-circle" style="color: #D9D9D9;"></i> Baños: {{$property->baths}}</td>
                            </tr>
                        @endif
                      <tr>
                        <td class="rounded-4 p-2"><i class="fa-solid fa-circle" style="color: #D9D9D9;"></i> M2: {{$property->rooms}}</td>
                      </tr>
                    </tbody>
                  </table>
                  
            </section>
            <section>
                
            </section>
        </section>

    </section>
    
@endsection