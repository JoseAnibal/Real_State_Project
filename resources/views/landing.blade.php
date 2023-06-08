@extends('app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" style="height: fit-content;" role="alert">{{session('success')}}</div>
    @endif
    
    <section class="w-100 d-flex flex-column gap-3 mb-3">
        <div class="w-100 bannerlanding d-flex position-relative">
            <img src="{{asset('Images/assets/bannerlanding.jpg')}}"  class="d-flex object-fit-cover w-100 rounded-4" alt="">
            <div class="position-absolute d-flex flex-column align-items-start centertitleleft h-100">
                <div class="col-6 h-100 d-flex flex-column align-items-center justify-content-center">
                    <h1 class="fw-bold text-start col-8">REG inmobiliaria</h1>
                    <p class="text-start col-8 property-desc">Ofrecemos una amplia selección de los mejores pisos con una inigualable relación calidad-precio.Nos enorgullece presentarte nuestras exclusivas ofertas.</p>
                    <a href="{{route('home')}}">
                        <button type="submit" class="btn btn-primary btn-block border-0 mb-4 rounded-5 buttonfadelight px-3 py-2">
                            Ver propiedades
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <section class="col-12 d-flex flex-column gap-3">
            <div>
                <h3>Encuentra los mejores Pisos:</h3>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @forelse ($properties_1 as $property)
                        <div class="d-flex flex-column">
                            <div>
                                <div class="card" style="width: 18rem;">
                                    <a href="{{route('public.showproperty',['property'=>$property->id])}}"><img src="{{asset("$property->image")}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h6 class="card-text fw-bold">{{$property->title}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100'>
            
                        <div class="p-3">
                            <img src="{{asset("Images/assets/empty.png")}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                        </div>
                        <div>
                            <h5>Pronto añadiremos este tipo de propiedad!</h5>
                        </div>
                    
                    </div>
                    @endforelse
                </div>
            </div>
            <div>
                <h3>Las mejores Casas:</h3>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @forelse ($properties_2 as $property)
                        <div class="d-flex flex-column">
                            <div>
                                <div class="card" style="width: 18rem;">
                                    <a href="{{route('public.showproperty',['property'=>$property->id])}}"><img src="{{asset("$property->image")}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h6 class="card-text fw-bold">{{$property->title}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100'>
            
                        <div class="p-3">
                            <img src="{{asset("Images/assets/empty.png")}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                        </div>
                        <div>
                            <h5>Pronto añadiremos este tipo de propiedad!</h5>
                        </div>
                    
                    </div>
                    @endforelse
                </div>
            </div>

            <div>
                <h3>Los mejores Garajes:</h3>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    @forelse ($properties_3 as $property)
                        <div class="d-flex flex-column">
                            <div>
                                <div class="card" style="width: 18rem;">
                                    <a href="{{route('public.showproperty',['property'=>$property->id])}}"><img src="{{asset("$property->image")}}" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                        <h6 class="card-text fw-bold">{{$property->title}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100'>
            
                        <div class="p-3">
                            <img src="{{asset("Images/assets/empty.png")}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                        </div>
                        <div>
                            <h5>Pronto añadiremos este tipo de propiedad!</h5>
                        </div>
                    
                    </div>
                    @endforelse
                </div>
            </div>
            
        </section>
    </section>

@endsection