@extends('app')

@section('content')

    <div class="col-8 col-md-6 col-xl-4 container border rounded p-4 my-4 mx-0 divcreate" style="position: relative ">
        <form enctype="multipart/form-data" method="POST" action="{{route('properties.createbill',['property'=>$property])}}">
            @csrf
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger' role='alert'>:message</div>")) !!}
            @endif

            <h5>Crear nueva factura</h5>
            <div class="mb-3 forjs">
                <label for="status" class="form-label">Selecciona usuario</label>
                <select class="form-select" aria-label="Default select example" name='rental'>
                    @foreach ($rentals as $key=>$value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 forjs">
                <label for="date" class="text-start">Fecha</label>
                <input id="startDate" class="form-control" type="date" name="date" @required(true) value="{{date('Y-m-d')}}"/>
            </div>
            <div class="mb-3 forjs">
                <label for="date_end" class="text-start">Agua</label>
                <input type="number" class="form-control sum" name="water" placeholder="Cantidad en €">
            </div>
            <div class="mb-3 forjs">
                <label for="gas" class="text-start">Gas</label>
                <input type="number" class="form-control sum" name="gas" placeholder="Cantidad en €">
            </div>
            <div class="mb-3 forjs">
                <label for="luz" class="text-start">Luz</label>
                <input type="number" class="form-control sum" name="light" placeholder="Cantidad en €">
            </div>
            <div class="mb-3 forjs">
                <label for="internet" class="text-start">Internet</label>
                <input type="number" class="form-control sum" name="internet" placeholder="Cantidad en €">
            </div>
            <div class="mb-3 forjs">
                <label for="extra" class="text-start">Extra</label>
                <input type="number" class="form-control sum" name="extra" placeholder="Cantidad en €">
            </div>
            <div class="mb-3 forjs">
                <button class="btn btn-primary sendButton rounded-5 border-0 w-100 calculate">Calcular</button>
            </div>
            <div class="mb-3 forjs">
                <label for="internet" class="text-start">Total</label>
                <input type="number" class="form-control totaltopay" name="total" placeholder="Total" value="" disabled>
            </div>
            <button class="btn btn-primary sendButton borderfade rounded-5 border-0 w-100">Crear Factura</button>
        </form>
        
    </div>
@endsection