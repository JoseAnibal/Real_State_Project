@extends('app')

@section('content')

    <section class="col-10 col-md-7 container my-3 d-flex flex-column gap-3 justify-content-center align-items-center">
            <h4 class="fw-bold">Editando alquiler de: {{$username}}</h4>
        {{-- <div class="col-10 col-md-7 d-flex flex-column "> --}}
            <form action="{{route('rentals.update',['rental'=>$rental->id])}}" method="post" class="col-12" id="editrental">
                @csrf
                @method('PATCH')
                <div class="d-flex flex-column">
                    <label for="date_start" class="text-start">Fecha inicio</label>
                    <input id="startDate" class="form-control" type="date" name="date_start" @required(true) value="{{$rental->date_start}}"/>
                </div>

                <div class="d-flex flex-column">
                    <label for="date_end" class="text-start">Fecha fin</label>
                    <input id="startDate" class="form-control" type="date" name="date_end" @required(true) value="{{$rental->date_end}}"/>
                </div>
                
                <div class="d-flex flex-column mt-2">
                    <div class="form-check form-switch d-flex justify-content-center">
                        <input class="form-check-input shadow-none" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="scale: 1.3">
                        <label class="form-check-label ms-3" for="flexSwitchCheckDefault">Alquiler activo</label>
                    </div>
                </div>
                <input type="hidden" id="checkactive" name="active" value="{{$rental->active}}">
                <div class="d-flex flex-column mt-2">
                    <button type="submit" class="btn btn-success rounded-4 borderfade border-0 mb-2 addusers">Guardar</button>
                </div>

            </form>
        {{-- </div> --}}

    </section>

@endsection