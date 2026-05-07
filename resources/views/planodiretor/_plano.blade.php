@extends('layouts.app')

<!-- Flipbook StyleSheets -->
<link href="{{ asset('assets/plugin-flip/css/dflip.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugin-flip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">

<style>
    .flipbook-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 20px 0;
    }

    #flipbook {
        width: 100%;
        max-width: 900px;
        height: 500px;
        margin: 0 auto;
        border-radius: 8px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: #05071e;
    }

    .df-container>.df-ui-next,
    .df-container>.df-ui-prev {
        font-size: 36px;
        font-weight: bold;

        color: grey;
        text-align: center;
        opacity: 1;
        /* background-color: #ffffff; */
</style>

@section('content')
<main class="main principios-details-page">
    <section id="objetivos" class="objetivos section">
        <div class="container" data-aos="fade-up">
            <div class="section-title mb-4 text-center">
                <h1>Plano Diretor de Tecnologia</h1>
                <p>
                    O Plano Diretor de Tecnologia da Informação (PDTI) é o instrumento estratégico que orienta a transformação digital da Prefeitura de Caraguatatuba.
                </p>
            </div>

            <div class="flipbook-wrapper">
                <div class="_df_book" id="flipbook" source="{{ asset('assets/pdf/pdti_caraguatatuba.pdf') }}"></div>
            </div>
        </div>
    </section>

</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/plugin-flip/js/libs/jquery.min.js') }}"></script>

<!-- Biblioteca principal (depois da configuração acima) -->
<script src="{{ asset('assets/plugin-flip/js/dflip.min.js') }}"></script>
<!-- backgroundColor: "#05071e", -->

<script>
    var option_flipbook = {
        backgroundColor: "#05071e",

    };
</script>


@endpush