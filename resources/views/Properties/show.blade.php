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
        <section class="d-flex flex-wrap flex-md-nowrap mt-3" id="aside-l">
            <section class="d-flex text-start flex-column gap-4 col-12 col-md-8">
                <div>
                    <h4 class="fw-semibold">{{$property->title}}</h4>
                </div>
                <div>
                    <p class="fw-light">{{$property->description}}</p>
                </div>
                <div>
                    <table class="d-flex w-100">
                        <tbody class="w-100">
                            @if ($property->type == 0 || $property->type == 1)
                                <tr class="d-flex mb-2 col-12">
                                    <td class="rounded-start-4 p-2 col-6"><i class="fa-solid fa-circle" style="color: #D9D9D9;"></i> Habitaciones: {{$property->rooms}}</td>
                                    <td class="rounded-end-4 p-2 col-6"><i class="fa-solid fa-circle" style="color: #D9D9D9;"></i> Baños: {{$property->baths}}</td>
                                </tr>
                            @endif
                          <tr class="d-flex mb-2 col-12">
                            <td class="rounded-4 p-2 col-6"><i class="fa-solid fa-circle" style="color: #D9D9D9;"></i> M2: {{$property->m2}}</td>
                          </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <h5>¿Donde se encuentra ubicado?</h5>
                </div>
                <div id="map" class="h-100 d-flex rounded-4 mb-3" style="height: 20rem !important">
                    
                </div>
                <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4xQbI2za2HHqL0p3s-whwF7yQkyuWnyk&callback=initMap&v=weekly"
                defer></script>

                <script>
                (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
                    ({key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg", v: "weekly"});
                </script>
            

            </section>
            <section class="col-12 col-md-4 d-flex flex-column align-items-center gap-3" id="aside-r">
                <span href="#" class="d-flex text-centerbadge rounded-pill text-bg-primary justify-content-center px-5 py-3">{{$property->price}} €</span>
                <div id="attrprop" class="row col-10">
                    <div class="d-flex flex-column col-4">
                        <div class="d-flex col-12">
                            <div class="col-6"><i class="fa-solid fa-bed fa-lg" style="color:#a8a8a8"></i></div>
                            <div class="col-6">{{$property->rooms}}</div>
                        </div>
                        <div class="col-12 text-truncate">
                            Habitaciones
                        </div>
                    </div>
                    <div class="d-flex flex-column col-4">
                        <div class="d-flex col-12">
                            <div class="col-6"><i class="fa-solid fa-bath fa-lg" style="color:#a8a8a8"></i></div>
                            <div class="col-6">{{$property->baths}}</div>
                        </div>
                        <div class="col-12 text-truncate">
                            Baños
                        </div>
                    </div>
                    <div class="d-flex flex-column col-4">
                        <div class="d-flex col-12">
                            <div class="col-6"><i class="fa-solid fa-ruler fa-lg" style="color:#a8a8a8"></i></div>
                            <div class="col-6">{{$property->m2}}</div>
                        </div>
                        <div class="col-12 text-truncate">
                            M2
                        </div>
                    </div>
                    

                </div>
            </section>
        </section>

    </section>
    
@endsection