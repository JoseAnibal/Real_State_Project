@extends('app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" style="height: fit-content;" role="alert">{{session('success')}}</div>
    @endif
    
    <section class="w-100 d-flex gap-3 mb-3 flex-column my-3 gap-3">
        <div class="w-100 d-flex flex-wrap flex-column-reverse flex-lg-row justify-content-center align-items-center">
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center flex-column">
                <h4 class="fw-bold text-start col-6">Somos REG inmobiliaria</h4>
                <p class="text-start col-6">Entendemos la importancia de encontrar una vivienda de calidad sin tener que pagar un precio exorbitante. Nos esforzamos por ofrecerte una excelente relación calidad-precio, para que puedas disfrutar de tu nuevo hogar sin preocuparte por tu bolsillo.</p>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                <img src="{{asset('Images/assets/logo.png')}}" alt="" class="object-fit-cover rounded-4" style="height: 15rem; width: 30rem;">
            </div>
        </div>

        <div class="d-flex flex-column align-items-center justify-content-center mt-4">
            <h4 class="fw-bold text-start">Nuestros valores</h4>
            <div class="d-flex flex-wrap w-100 justify-content-center gap-3 flex-column flex-md-row">
                <div class="d-flex flex-column col-12 col-md-3 border rounded-4">
                    <h5 class="fw-bolder">Transparencia</h5>
                    <hr>
                    <p>
                        En nuestra inmobiliaria, nos enorgullece destacar por nuestra transparencia en cada paso del proceso.
                        Creemos firmemente en la importancia de brindar a nuestros clientes la información completa y veraz.
                    </p>
                </div>
                <div class="d-flex flex-column col-12 col-md-3 border rounded-4">
                    <h5 class="fw-bolder">Efricacia</h5>
                    <hr>
                    <p>
                        En nuestro trabajo, nos enorgullece ser altamente eficaces. Nos dedicamos a lograr resultados con prontitud y precisión,
                        sin comprometer la calidad de nuestro trabajo.
                    </p>
                </div>
                <div class="d-flex flex-column col-12 col-md-3 border rounded-4">
                    <h5 class="fw-bolder">Experiencia</h5>
                    <hr>
                    <p>
                        Nuestra experiencia es sólida y respaldada por años de trayectoria en el sector.
                        Contamos con un equipo de profesionales altamente capacitados y conocedores del mercado inmobiliario.
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center justify-content-center mt-4">
            <h4 class="fw-bold text-start">Un poco de nuestra historia</h4>
            <div>
                <p>
                    A lo largo de los años, hemos aprendido valiosas lecciones gracias a nuestra experiencia en el sector inmobiliario.
                    Siempre hemos estado arraigados en Granada, lo que nos ha permitido conocer a fondo las necesidades y deseos de los
                    inquilinos en esta maravillosa ciudad.Nuestra larga trayectoria nos ha brindado una perspectiva única y una comprensión
                    profunda del mercado inmobiliario local. Hemos presenciado de primera mano cómo evolucionan las demandas y hemos aprendido
                    a adaptarnos a las cambiantes necesidades de los inquilinos a lo largo del tiempo.Esta experiencia nos ha enseñado la importancia
                    de escuchar atentamente a nuestros clientes. Sabemos que cada persona tiene requisitos y preferencias individuales,
                    y nos esforzamos por encontrar la vivienda perfecta que se ajuste a sus necesidades específicas.
                </p>
            </div>
        </div>
        
    </section>

@endsection