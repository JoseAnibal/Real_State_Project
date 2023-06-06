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
        <h3 class="fw-bold"> Facturas de {{session()->get('email')}}</h3>
    </section>

    <section class="container d-flex flex-wrap justify-content-center p-0 gap-3 my-3">

        <section class="col-10 col-md-7 col-lg-9">
            <section class=" d-flex container mx-auto flex-wrap row justify-content-center px-0 gap-3" id="propertiescontainer">
                @foreach ($billsuser as $bill)
                    <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">
                        <img src="{{asset('Images/assets/bill.png')}}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-contain rounded-4 col-12'>
                        <div class="card-body d-flex flex-column px-0 justify-content-center align-items-center">
                            <h5 class="card-title text-start"><b>{{$bill->date}}</b></h5>
                            <p class="card-text text-start property-desc">Agua: {{$bill->water}} €</p>
                            <p class="card-text text-start property-desc">Gas: {{$bill->gas}} €</p>
                            <p class="card-text text-start property-desc">Luz: {{$bill->light}} €</p>
                            <p class="card-text text-start property-desc">Internet: {{$bill->internet}} €</p>
                            <p class="card-text text-start property-desc">Extra: {{$bill->extra}} €</p>
                            <hr class="w-100">
                            <p class="card-text text-start property-desc">Total: {{$bill->total}} €</p>
                            
                        </div>
                    </div>  
                @endforeach
            </section>
        </section>
    
    </section>

</div>
    
@endsection