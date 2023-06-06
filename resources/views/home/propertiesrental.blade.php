@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center gap-3">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif

    <section class="col-12 mt-3">

    </section>

    <section class="container d-flex flex-wrap justify-content-center p-0 gap-3">
        <section class="col-10 col-sm-10 col-md-4 col-lg-2 filtersdiv bg-graylight rounded-4 p-0" style="height: fit-content;">
            <h6 class="pt-3"><b>Filtros</b></h6>
            <form class="d-flex flex-column gap-3 p-3" id="filters" action="#" method="post">
                @csrf
                <div class="d-flex flex-column">
                    <label for="email" class="text-start">Tipo de Propiedad</label>
                    <select class="form-select" name="type" id="type">
                        <option value="all">Todos</option>
                        <option value="0">Piso</option>
                        <option value="1">Casa</option>
                        <option value="2">Parking</option>
                        <option value="3">Terreno</option>
                    </select>
                </div>
    
                <div class="d-flex flex-column">
                    <label for="title" class="text-start">Título</label>
                    <input type="text" name="title" id="title" placeholder="Título" class="form-control">
                </div>

                <div class="d-flex flex-column">
                    <label for="order" class="text-start">Precio</label>
                    <select class="form-select" name="order" id="type">
                        <option value="DESC">Ascendente</option>
                        <option value="ASC">Descendente</option>
                    </select>
                </div>
            </form>
            <button type="submit" class="btn btn-success rounded-4 borderfade border-0 filter mb-2">Aplicar filtros</button>
        </section>

        <section class="col-10 col-md-7 col-lg-9">
            <section class=" d-flex container mx-auto flex-wrap row justify-content-center px-0" id="propertiescontainer">
    
            </section>
            <button type="submit" class="btn rounded-4 border-0 bg-graylight viewmore my-3">Ver mas</button>
        </section>
    
    </section>

</div>
    
@endsection