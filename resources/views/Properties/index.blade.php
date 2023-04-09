@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif
    <div class="container">
        @foreach ($properties as $property)
        
        <article class="container-md rounded border property_card">
            <div class="w-100">

                @if (count($property->images)>0)
                <img src={{$property->images[0]->image_url}} alt="1flat" class='w-100 rounded p-1 property_image object-fit-cover'>
                @endif

            </div>
            <h3><a href="#">{{$property->title}}</a></h3>
            <p class="m-auto overflow-hidden text-wrap" style="width: 6rem;">
                {{$property->description}}
            </p>
            <div class="desc">
                <p class="rounded bg-primary text-light">{{$property->price}} €</p>
                <a href="#" class="moreinfo">Mas info</a>
            </div>
        </article>

    @endforeach
    </div>

</div>
    
@endsection