@extends('app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" style="height: fit-content;" role="alert">{{session('success')}}</div>
    @endif
    index
@endsection