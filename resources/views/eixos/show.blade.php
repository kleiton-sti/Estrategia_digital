@extends('layouts.app')

@section('content')
<main class="main principios-details-page">
  <!-- Breadcrumbs -->
  <!-- <div class="page-title">
    <div class="breadcrumbs">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house"></i> Home</a></li>
          <li class="breadcrumb-item active current">{{ $eixo->titulo }}</li>
        </ol>
      </nav>
    </div>
  </div> -->

  <!-- Objetivos -->
  <section id="objetivos" class="objetivos section">
    <div class="container section-title-obj" data-aos="fade-up">
      <!-- <h5>Eixo</h5> -->
      <h1>{{ $eixo->titulo }}</h1>
      <p>{{ $eixo->descricao }}</p>
    </div>

    <div class="container" data-aos="fade-up">
      <h1>Objetivos</h1>
      <div class="row gy-4 isotope-container">
        @foreach($eixo->objetivos as $objetivo)
          <div class="col-xl-4 col-lg-6 objetivos-item" data-objetivo-id="{{ $objetivo->id_objetivo }}">
            <div class="objetivos-wrapper">
              <div class="objetivos-content d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="objetivo-titulo mb-2">{{ $objetivo->titulo }}</h6>
                  <span class="badge color-azul"><strong>{{ $objetivo->iniciativas->count() }}</strong> Iniciativas</span>
                </div>
                <i class="bi bi-chevron-down objetivo-toggle" style="font-size: 1.5rem; cursor: pointer;"></i>
              </div>
              <div class="objetivo-iniciativas" style="display: none; margin-top: 15px;">
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <p class="desc">{!! $objetivo->descricao !!}</p>
    </div>
  </section>

  <!-- Iniciativas -->
  <section id="principios-details" class="principios-details section" style="display:none;">
    <div class="container">

     <!-- Título e botão Fechar -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="iniciativas-titulo mb-0" style="font-size: 20px;">Iniciativas</h6>
      <button id="fechar-iniciativas" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
        <i class="bi bi-x-lg me-1"></i> Fechar
      </button>
    </div>

      <!-- Conteúdo das Iniciativas -->
      <div class="row justify-content-center align-items-start gx-3">
        <div class="iniciativas col">
          <div class="principios-content">
            <div class="principios-process">
              <div class="process-steps"></div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-auto">
            <div class="sidebar">
              <div class="row g-2 obj-status">

                <div class="col-12">
                  <div class="card text-center shadow-sm border-0 p-2" style="background-color: #131428;">
                    <div class="card-body p-2">
                      <h4 class="card-title mb-1" id="sidebar-total">{{ $sidebar['total'] }}</h4>
                      <p class="badge color-azul">Iniciativas</p>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="card text-center shadow-sm border-0 p-2" style="background-color: #131428;">
                    <div class="card-body p-2">
                      <h4 class="card-title mb-1" id="sidebar-concluidas">{{ $sidebar['concluidas'] }}</h4>
                      <p class="badge bg-success">Concluídas</p>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="card text-center shadow-sm border-0 p-2" style="background-color: #131428;">
                    <div class="card-body p-2">
                      <h4 class="card-title mb-1" id="sidebar-andamento">{{ $sidebar['andamento'] }}</h4>
                      <p class="badge bg-primary">Em execução</p>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="card text-center shadow-sm border-0 p-2" style="background-color: #131428;">
                    <div class="card-body p-2">
                      <h4 class="card-title mb-1" id="sidebar-nao">{{ $sidebar['nao'] }}</h4>
                      <p class="badge bg-danger">Não iniciadas</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

      </div>

      <div id="status-legend" class="status-legend d-flex gap-3">
        <span class="legend-item"><span class="legend-color bg-success"></span> Concluída</span>
        <span class="legend-item"><span class="legend-color bg-primary"></span> Em execução</span>
        <span class="legend-item"><span class="legend-color bg-danger"></span> Não iniciada</span>
      </div>

    </div>
  </section>
</main>
@endsection

@push('scripts')
<script>
    window.objetivosData = @json($objetivosData);
</script>
@endpush

