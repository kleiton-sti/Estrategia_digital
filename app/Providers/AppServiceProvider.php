<?php

namespace App\Providers;

use App\Models\Eixo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::share('todosEixos', Eixo::select('id_eixos', 'titulo')->get());
    }
}
