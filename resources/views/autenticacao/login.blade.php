@extends('layouts.app')

@section('title', 'Entrar')

@section('content')
<main class="main">
  <section class="login-section d-flex align-items-center justify-content-center">
    <div class="login-card">
      <h2 class="login-titulo">Entrar</h2>

      @if ($errors->any())
        <div class="login-erro">{{ $errors->first() }}</div>
      @endif

      <form action="{{ route('autenticar') }}" method="POST">
        @csrf

        <div class="login-campo">
          <label for="email" class="login-label">E-mail</label>
          <input
            type="email"
            id="email"
            name="email"
            class="login-input"
            value="{{ old('email') }}"
            autocomplete="email">
        </div>

        <div class="login-campo">
          <label for="password" class="login-label">Senha</label>
          <input
            type="password"
            id="password"
            name="password"
            class="login-input"
            autocomplete="current-password">
        </div>

        <button type="submit" class="btn-login">Entrar</button>
      </form>
    </div>
  </section>
</main>
@endsection
