@extends('app')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center">

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{session('success')}}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning" role="alert">{{session('warning')}}</div>
    @endif

    <section class="d-flex container mx-auto col-12 flex-wrap row">
        <table class="w-100">
            <thead class="col-12">
                <tr class="col-12">
                    <td>
                        Imagen
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Nombre
                    </td>
                    <td>
                        Teléfono
                    </td>
                </tr>
            </thead>
            <tbody class="col-12">
                @forelse($users as $user)
                    <div class="dropdown position-absolute">
                        <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu col-6">
                            <li>
                                <form action="{{route('users.edit', ['user'=>$user->id])}}" method="get" class="dropdown-item px-0 col-8">
                                    <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{route('users.destroy', ['user'=>$user->id])}}" method="post" class="dropdown-item px-0 col-8">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-trash"></i>Eliminar</button>
                                </form>
                            </li>
                        </ul>
                    </div> 
                    <tr>
                        <td>
                            @if (empty($user->image))             
                                <img src="{{asset('Images/assets/noimage.png')}}" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:6rem;height:6rem;background-color: #4d4d4d">
                            @else
                                <img src={{asset($user->image)}} alt="userphoto" class='rounded user_image object-fit-cover rounded-4' style="width:6rem;height:6rem ;">
                            @endif
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            {{$user->phone}}
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-warning" role="alert" style="height: fit-content;">¡No hay usuarios, esperemos a que se registren!</div>
                @endforelse
            </tbody>
        </table>
        
    </section>

</div>
    
@endsection