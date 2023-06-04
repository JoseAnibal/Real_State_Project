@extends('app')

@section('content')

    <section class="container d-flex flex-column mt-3">
        <section class="d-flex flex-column justify-content-center align-items-center bg-body-secondary rounded-4 bg-graylight" id="imagesfield">
            <div class="col-6 d-flex rounded-4 justify-content-center" style="height: 18rem;">
                <img src="{{asset("$incidence->image_url")}}" alt="incidenceimage" class="col-12 object-fit-cover rounded-4 m-3">
            </div>
        </section>
        <section class="d-flex flex-column flex-wrap flex-md-nowrap mt-3 gap-3 my-3" id="aside-l">
            <div>
                <h5 class="fw-bold">Título</h5>
                <p>{{$incidence->title}}</p>
            </div>
            <div>
                <h5 class="fw-bold">Descripción</h5>
                <p>{{$incidence->title}}</p>
            </div>
            <div class="d-flex flex-column align-items-center my-3">
                <h5 class="fw-bold">Estado:</h5>
                <div class="d-flex col-10 justify-content-around align-items-center flex-wrap">
                    <form action="{{route('incidences.update',['incidence'=>$incidence->id])}}" method="post" class="d-flex col-10 justify-content-around align-items-center flex-wrap">
                        @method('PATCH')
                        @csrf
                        @foreach ($status as $key=>$value)
                        
                            @if ($incidence->status == $key)
                                <div class="form-check border rounded-5">
                                    <div class="m-2">
                                        {!! $value !!}
                                        <input class="form-check-input" type="radio" name="status" value="{{$key}}" checked>
                                    </div>
                                </div>
                            @else
                                <div class="form-check border rounded-5">
                                    <div class="m-2">
                                        {!! $value !!}
                                        <input class="form-check-input" type="radio" name="status" value="{{$key}}">
                                    </div>
                                </div>
                            @endif
                            
                        @endforeach
                        
                        <button class="btn btn-primary sendButton borderfade rounded-5 border-0 col-6 mt-3">Guardar</button>
                    </form>
                </div>
            </div>
            <div>
                <h5 class="fw-bold mt-3">Piso en el que se registró esta incidencia:</h5>
                <a href="{{route('properties.show',['property'=>$property->id])}}"><h6>{{$property->title}}</h6></a>
            </div>

        </section>

    </section>
    
@endsection
