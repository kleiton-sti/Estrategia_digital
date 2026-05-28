@extends('layouts.app')
@section('content')
@push('styles')
    <link rel="canonical" href="https://estrategiadigital.caraguatatuba.sp.gov.br/produtos/stii-em-numeros">
@endpush
<!-- <main class="main principios-details-page">
    <div class="container">
        <section id="objetivos" class="objetivos section">
            <iframe width="640" height="360" src="https://lookerstudio.google.com/embed/reporting/9e4720d6-b633-4d9e-9216-74a629362d09/page/RxWbF"></iframe>
        </section>
    </div>

</main> -->

<main class="main principios-details-page pagina-interna">
    <div class="container">
        <section id="objetivos" class="objetivos section dash">
        </section>
    </div>
@include('componentes.jsonld', ['tipo' => 'produtos', 'subtipo' => 'STII em Números'])
</main>

<!-- Tela de aviso -->
<div id="rotate-notice">
    <div class="rotate-icon">
        <i class="bi bi-phone"></i>
    </div>
    <p>Por favor, gire seu celular para uma melhor experiência</p>
</div>
@endsection
@push('styles')
<style>
    #rotate-notice {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        color: #fff;
        z-index: 9999;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: 1.5rem;
        padding: 20px;
        flex-direction: column;
        font-family: sans-serif;
    }

    #rotate-notice .rotate-icon {
        font-size: 5rem;
        margin-bottom: 20px;
        display: inline-block;
        animation: rotatePhone 3s infinite;
    }

    @keyframes rotatePhone {
        0% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(90deg);
        }

        50% {
            transform: rotate(0deg);
        }

        /* 75%  { transform: rotate(-90deg); }
    100% { transform: rotate(0deg); } */
    }

    #rotate-notice p {
        font-size: 1.2rem;
        line-height: 1.5;
    }
</style>
@endpush
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dashSection = document.querySelector(".dash");

        if (!dashSection) return;

        // Detecta o tipo de device
        const userAgent = navigator.userAgent.toLowerCase();
        let deviceType;

        if (/mobile|android|iphone|ipod|blackberry|iemobile|opera mini/i.test(userAgent)) {
            deviceType = "mobile";
        } else if (/tablet|ipad|playbook|silk/i.test(userAgent)) {
            deviceType = "tablet";
        } else {
            deviceType = "desktop";
        }

        // Define altura conforme o tipo de dispositivo
        let iframeHeight;

        switch (deviceType) {
            case "mobile":
                iframeHeight = "480px";
                break;
            case "tablet":
                iframeHeight = "700px";
                break;
            default: // desktop
                iframeHeight = "900px";
                break;
        }

        // Cria o iframe dinamicamente
        const iframe = document.createElement("iframe");
        iframe.src = "https://lookerstudio.google.com/embed/reporting/9e4720d6-b633-4d9e-9216-74a629362d09/page/RxWbF";
        iframe.height = iframeHeight;
        iframe.width = "100%";
        iframe.allowFullscreen = true;

        // Insere o iframe na section
        dashSection.appendChild(iframe);

        console.log(`Iframe carregado para dispositivo: ${deviceType}`);
    });
</script>

<script>
    function disableScroll() {
        document.body.style.overflow = 'hidden';
    }

    function enableScroll() {
        document.body.style.overflow = '';
    }

    function checkOrientation() {
        const isMobile = window.innerWidth <= 768;
        const isPortrait = window.innerHeight > window.innerWidth;
        if (isMobile && isPortrait) {
            document.getElementById("rotate-notice").style.display = "flex";
            document.querySelector(".principios-details-page").style.display = "none";
            disableScroll();
        } else {
            document.getElementById("rotate-notice").style.display = "none";
            document.querySelector(".principios-details-page").style.display = "block";
            enableScroll();
        }

    }

    window.addEventListener("load", checkOrientation);
    window.addEventListener("resize", checkOrientation);
    window.addEventListener("orientationchange", checkOrientation);
</script>
@endpush