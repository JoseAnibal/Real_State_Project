@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center my-3">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif
    <section class="w-100 d-flex flex-wrap flex-md-nowrap gap-3 justify-content-center align-items-start">

        <section class="col-10 col-md-4 col-lg-3 filtersdiv bg-graylight rounded-4">
            <h6 class="pt-3"><b>Filtros</b></h6>
            <form class="d-flex flex-column gap-3 p-3" id="filters" action="#" method="post">
                <div class="d-flex flex-column">
                    <label for="email" class="text-start">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                </div>

                <div class="d-flex flex-column">
                    <label for="phone" class="text-start">Teléfono</label>
                    <input type="text" name="phone" id="phone" placeholder="Teléfono" class="form-control">
                </div>
            </form>
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0 mb-2 filter">Aplicar filtros</button>
        </section>
                
        <section class="col-10 col-md-4">

            <form id="usersform">
                <section class="d-flex flex-wrap col-12 mx-0 px-0 justify-content-center gap-3 position-relative" id="userscontainer">

                </section>
            </form>
            
            <button type="submit" class="btn rounded-4 border-0 bg-graylight viewmore my-3">Ver mas</button>
            
        </section>

        <section class="col-10 col-md-4 col-lg-3 filtersdiv bg-graylight rounded-4">
            <h6 class="pt-3"><b>Fechas</b></h6>
            {{-- <form class="d-flex flex-column gap-3 p-3" id="filters" action="{{route('properties.useradded')}}" method="post"> --}}
            <form class="d-flex flex-column gap-3 p-3" id="dates">
                <div class="d-flex flex-column">
                    <label for="date_start" class="text-start">Fecha inicio</label>
                    <input id="startDate" class="form-control" type="date" name="date_start" @required(true)/>
                </div>

                <div class="d-flex flex-column">
                    <label for="date_end" class="text-start">Fecha fin</label>
                    <input id="startDate" class="form-control" type="date" name="date_end" @required(true)/>
                </div>
            </form>
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0 mb-2 addusers">Añadir usuarios</button>
        </section>

    </section>
</div>
    
@endsection