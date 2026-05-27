@extends('layouts.app')
@section('content')
<main class="main">
  <section id="tabelas" class="section"
    style="background-color: var(--background-color); color: var(--default-color);">
    <div class="container" data-aos="fade-up">


      <style>
        .texto-esquerda-flex {
          display: flex !important;
          /* só se ainda não for flex */
          justify-content: flex-start !important;
          /* alinha no eixo principal (geralmente horiz.) */
          align-items: flex-start !important;
          /* alinha no eixo cruzado (geralmente vert.) */
        }

        .alinha-texto-esquerda {
          text-align: left !important;
        }

        @media (max-width: 767.98px) {
          .section-title.texto-esquerda-flex.mb-4 {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            text-align: center !important;
          }

          .section-title.texto-esquerda-flex.mb-4 p {
            text-align: center !important;
            max-width: 90% !important;
          }
        }

        table th:nth-child(2),
        table th:nth-child(3),
        table td:nth-child(2),
        table td:nth-child(3) {
          width: 70px;
          text-align: center;
        }
      </style>


      <!-- Título -->
      <div class="section-title texto-esquerda-flex mb-4">
        <h1 style="color: var(--heading-color);">Painel de Inovação</h1>
        <p class="alinha-texto-esquerda">O Painel de Inovação é um espaço de transparência e acompanhamento das ações digitais da Prefeitura de Caraguatatuba.
          Reúne um panorama atualizado dos projetos, serviços e iniciativas de transformação digital conduzidos pela Secretaria de Tecnologia da Informação e Inovação (STII), fortalecendo a cultura de inovação, eficiência e governo aberto no município.</p>
      </div>

      <div class="progress">
        <div class="progress-bar" id="progressBar" data-percent="{{ $percentual }}">
          0%
        </div>
      </div>

      <div class="row g-4">
        <!-- Coluna Esquerda: Serviços Online -->
        <div class="col-12 col-lg-8">
          <div class="card shadow-sm"
            style="background-color: var(--surface-color); color: var(--default-color); height: 100%;">
            <div class="card-body">
              <h5 class="card-title mb-3" style="color: var(--accent-color); font-size: 18px;">Serviços Online</h5>
              <div class="table-responsive"
                style="max-height: 100%; overflow-y: auto; scroll-behavior: smooth; scrollbar-width: thin; scrollbar-color: var(--default-color) rgba(0,0,0,0.1);">
                <table class="table table-bordered align-middle mb-0" style="color: var(--default-color); font-size: 14px;">
                  <thead style="background-color: #1f1f3b; color: var(--contrast-color);">
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

                        @if($item->status_2024==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2024==0)
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025==3)
                        <span style="color: yellow;"><i class="bi bi-check2"></i></span>
                        @else
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
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

        <!-- Coluna Direita: 3 tabelas pequenas -->
        <div class="col-12 col-lg-4 d-flex flex-column gap-4">

          <!-- Adequação Municipal -->
          <div class="card shadow-sm"
            style="background-color: var(--surface-color); color: var(--default-color);">
            <div class="card-body">
              <h5 class="card-title mb-3" style="color: var(--accent-color); font-size: 18px;">Adequação Municipal</h5>
              <div class="table-responsive"
                style="max-height: 145px; overflow-y: auto; scroll-behavior: smooth; scrollbar-width: thin; scrollbar-color: var(--default-color) rgba(0,0,0,0.1);">
                <table class="table table-bordered align-middle mb-0" style="color: var(--default-color); font-size: 14px;">
                  <thead style="background-color: #1f1f3b; color: var(--contrast-color);">
                    <tr>
                      <th>Item</th>
                      <th>2024</th>
                      <th>2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($adequacao as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                        @if($item->status_2024==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2024==0)
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025==3)
                        <span style="color: yellow;"><i class="bi bi-check2"></i></span>
                        @else
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Fim Adequação Municipal -->

          <!-- Sistemas Digitais -->
          <div class="card shadow-sm"
            style="background-color: var(--surface-color); color: var(--default-color);">
            <div class="card-body">
              <h5 class="card-title mb-3" style="color: var(--accent-color); font-size: 18px;">Sistemas Digitais no dia-a-dia da População</h5>
              <div class="table-responsive"
                style="max-height: 160px; overflow-y: auto; scroll-behavior: smooth; scrollbar-width: thin; scrollbar-color: var(--default-color) rgba(0,0,0,0.1);">
                <table class="table table-bordered align-middle mb-0" style="color: var(--default-color); font-size: 14px;">
                  <thead style="background-color: #1f1f3b; color: var(--contrast-color);">
                    <tr>
                      <th>Serviço/Sistema</th>
                      <th>2024</th>
                      <th>2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sistemas_digitais as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                        @if($item->status_2024==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2024==0)
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025==3)
                        <span style="color: yellow;"><i class="bi bi-check2"></i></span>
                        @else
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
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
          <div class="card shadow-sm"
            style="background-color: var(--surface-color); color: var(--default-color);">
            <div class="card-body">
              <h5 class="card-title mb-3" style="color: var(--accent-color); font-size: 18px;">Participação do Cidadão pela Internet</h5>
              <div class="table-responsive"
                style="max-height: 150px; overflow-y: auto; scroll-behavior: smooth; scrollbar-width: thin; scrollbar-color: var(--default-color) rgba(0,0,0,0.1);">
                <table class="table table-bordered align-middle mb-0" style="color: var(--default-color); font-size: 14px;">
                  <thead style="background-color: #1f1f3b; color: var(--contrast-color);">
                    <tr>
                      <th>Ferramenta</th>
                      <th>2024</th>
                      <th>2025</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($participacao as $item)
                    <tr>
                      <td>{{ $item->acao }}</td>
                      <td>
                         @if($item->status_2024==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2024==0)
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                      <td>
                        @if($item->status_2025==1)
                        <span style="color: green;"><i class="bi bi-check2-all text-success"></i></span>
                        @elseif($item->status_2025==3)
                        <span style="color: yellow;"><i class="bi bi-check2"></i></span>
                        @else
                        <span style="color: red;"><i class="bi bi-x-lg text-danger"></i></span>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>




        </div> <!-- /col direita -->
      </div> <!-- /row -->
    </div>
  </section>
  @include('componentes.jsonld', ['tipo' => 'tabelas'])
</main>
@endsection