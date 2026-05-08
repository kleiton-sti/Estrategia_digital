@extends ('layouts.app')

@section('content')
    <main class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="flex-grow-1" data-categoria="{{ $artigo->categoria['nome'] }}" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="artigo-card h-100">
                            <div class="artigo-card-img">
                                <img src="assets/img/misc/misc.png" alt="Capa do artigo" class="img-fluid">
                                <span class="artigo-badge">{{ $artigo->categoria['nome'] }}</span>
                            </div>

                            <div class="artigo-card-body d-flex flex-column flex-grow-1 p-3">
                                <div class="artigo-data d-flex gap-3">
                                    <span><i class="bi bi-calendar"></i> {{ $artigo->created_at }}</span>
                                </div>
                                <h5 class="artigo-titulo">{{ $artigo->titulo }}</h5>
                                <p class="artigo-subtitulo mb-3 flex-grow-1">{{ $artigo->subtitulo }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection