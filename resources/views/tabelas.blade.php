@extends('layouts.app')

@section('content')
<main class="main pagina-interna">
  <section id="tabelas" class="section">
    <div class="container" data-aos="fade-up">

      <!-- Título -->
      <div class="section-title texto-esquerda-flex mb-4">
        <h1>Painel de Inovação</h1>
        <p class="alinha-texto-esquerda">Panorama atualizado para acompanhar as transformações digitais conduzidas pela Secretaria de Tecnologia da Informação e Inovação (STII).</p>
      </div>

      <div class="progress">
        <div class="progress-bar" id="progressBar" data-percent="{{ $percentual }}">
          0%
        </div>
      </div>

      <div class="row g-4">
        <!-- Coluna Esquerda: Serviços Online -->
        <div class="col-12 col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3">Serviços Online</h5>
              <div class="table-responsive" style="max-height: 100%; overflow-y: auto;">
                <table class="table table-bordered align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Serviço</th>
                      <th>2024</th>
                      <th>2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($servicos_online as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                        @if($item->status_2024 == 1)
                          <i class="bi bi-check2-all text-success"></i>
                        @elseif($item->status_2024 == 0)
                          <i class="bi bi-x-lg text-danger"></i>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025 == 1)
                          <span data-bs-toggle="tooltip" title="Concluído"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025 == 3)
                          <span data-bs-toggle="tooltip" title="Programado para 2025"><i class="bi bi-check2" style="color: yellow;"></i></span>
                        @elseif($item->status_2025 == 0)
                          <span data-bs-toggle="tooltip" title="Em estudo para 2026"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Coluna Direita -->
        <div class="col-12 col-lg-4 d-flex flex-column gap-4">

          <!-- Adequação Municipal -->
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3">Adequação Municipal</h5>
              <div class="table-responsive" style="max-height: 145px; overflow-y: auto;">
                <table class="table table-bordered align-middle mb-0">
                  <thead>
                    <tr><th>Item</th><th>2024</th><th>2025</th></tr>
                  </thead>
                  <tbody>
                    @foreach($adequacao as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                        @if($item->status_2024 == 1)<i class="bi bi-check2-all text-success"></i>
                        @elseif($item->status_2024 == 0)<i class="bi bi-x-lg text-danger"></i>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025 == 1)<span data-bs-toggle="tooltip" title="Concluído"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025 == 3)<span data-bs-toggle="tooltip" title="Programado para 2025"><i class="bi bi-check2" style="color: yellow;"></i></span>
                        @elseif($item->status_2025 == 0)<span data-bs-toggle="tooltip" title="Em estudo para 2026"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Sistemas Digitais -->
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3">Sistemas Digitais no dia-a-dia da População</h5>
              <div class="table-responsive" style="max-height: 160px; overflow-y: auto;">
                <table class="table table-bordered align-middle mb-0">
                  <thead>
                    <tr><th>Serviço/Sistema</th><th>2024</th><th>2025</th></tr>
                  </thead>
                  <tbody>
                    @foreach($sistemas_digitais as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                        @if($item->status_2024 == 1)<i class="bi bi-check2-all text-success"></i>
                        @elseif($item->status_2024 == 0)<i class="bi bi-x-lg text-danger"></i>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025 == 1)<span data-bs-toggle="tooltip" title="Concluído"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025 == 3)<span data-bs-toggle="tooltip" title="Programado para 2025"><i class="bi bi-check2" style="color: yellow;"></i></span>
                        @elseif($item->status_2025 == 0)<span data-bs-toggle="tooltip" title="Em estudo para 2026"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Participação do Cidadão -->
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title mb-3">Participação do Cidadão pela Internet</h5>
              <div class="table-responsive" style="max-height: 150px; overflow-y: auto;">
                <table class="table table-bordered align-middle mb-0">
                  <thead>
                    <tr><th>Ferramenta</th><th>2024</th><th>2025</th></tr>
                  </thead>
                  <tbody>
                    @foreach($participacao as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                        @if($item->status_2024 == 1)<i class="bi bi-check2-all text-success"></i>
                        @elseif($item->status_2024 == 0)<i class="bi bi-x-lg text-danger"></i>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025 == 1)<span data-bs-toggle="tooltip" title="Concluído"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025 == 3)<span data-bs-toggle="tooltip" title="Programado para 2025"><i class="bi bi-check2" style="color: yellow;"></i></span>
                        @elseif($item->status_2025 == 0)<span data-bs-toggle="tooltip" title="Em estudo para 2026"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  @include('componentes.jsonld', ['tipo' =>  'tabelas'])
</main>
@endsection
