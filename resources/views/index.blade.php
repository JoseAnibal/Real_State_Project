@extends('app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" style="height: fit-content;" role="alert">{{session('success')}}</div>
    @endif
    
    <section class="w-100">
        <div class="container">
            <h3 class="fw-bold my-3"> Propiedad destacada </h3>
            <div class="border-0 rounded-4 bg-graylight banner d-flex justify-content-around align-items-center flex-wrap flex-md-nowrap">
                <div class="col-10 col-md-5 d-flex">
                    <img src="{{asset("$imagebanner")}}" alt="" class="object-fit-cover rounded-4 m-2" style="height: 100%; width: 100%;">
                </div>
                <div class="col-7 d-flex flex-column align-items-center gap-2 my-2">
                    <a href="{{route('public.showproperty',['property'=>$propertymain->id])}}" style="color: black;text-decoration: none;"><h5 class="fw-bold text-break">{{$propertymain->title}}</h5></a>
                    
                    <p class="property-desc">{{$propertymain->description}}</p>
                    <div class="d-flex justify-content-center align-items-center col-6">
                        <span class="d-flex col-12 text-centerbadge rounded-pill buttonfadelight justify-content-center px-5 py-3 text-light">{{$propertymain->price}} €</span>
                    </div>
                    <div id="attrprop" class="row col-10 d-flex justify-content-center">
                        @if (in_array($propertymain->type,[0,1]))
                            <div class="d-flex flex-column col-4">
                                <div class="d-flex col-12">
                                    <div class="col-6"><i class="fa-solid fa-bed fa-lg" style="color:#a8a8a8"></i></div>
                                    <div class="col-6">{{$propertymain->rooms}}</div>
                                </div>
                                <div class="col-12 text-truncate">
                                    Habitaciones
                                </div>
                            </div>
                            <div class="d-flex flex-column col-4">
                                <div class="d-flex col-12">
                                    <div class="col-6"><i class="fa-solid fa-bath fa-lg" style="color:#a8a8a8"></i></div>
                                    <div class="col-6">{{$propertymain->baths}}</div>
                                </div>
                                <div class="col-12 text-truncate">
                                    Baños
                                </div>
                            </div>
                        @endif
                        <div class="d-flex flex-column col-4">
                            <div class="d-flex col-12">
                                <div class="col-6"><i class="fa-solid fa-ruler fa-lg" style="color:#a8a8a8"></i></div>
                                <div class="col-6">{{$propertymain->m2}}</div>
                            </div>
                            <div class="col-12 text-truncate">
                                M2
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="col-12">
            <h5 class="fw-bold mt-3 border-bottom">Échale un vistao a los mejores pisos de Granada</h5>
            <section class=" d-flex container mx-auto flex-wrap row justify-content-center px-0" id="propertiescontainer">
                
            </section>
            <button type="submit" class="btn rounded-4 border-0 bg-graylight viewmore my-3">Ver mas</button>
        </section>
    </section>

@endsection