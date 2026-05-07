<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eixo;
use App\Models\Objetivo;
use App\Models\Iniciativa;

class EixoController extends Controller
{
    // homepage: lista eixos
    public function index()
    {
        // Carrega todos os eixos para o menu
        $todosEixos = Eixo::select('id_eixos','titulo')->get();

        $eixos = Eixo::withCount(['objetivos as iniciativas_count' => function ($q) {
            $q->join('iniciativas', 'objetivos.id_objetivo', '=', 'iniciativas.id_objetivo');
        }])->get();

        // Carregar eixos com objetivos e contagens por objetivo
        $eixos = Eixo::with(['objetivos.iniciativas'])->get();

        // Contagens gerais
        $totalIniciativas = 0;
        $concluidas = 0;
        $andamento = 0;
        $naoIniciadas = 0;

        foreach ($eixos as $eixo) {
            foreach ($eixo->objetivos as $objetivo) {
                $totalIniciativas += $objetivo->iniciativas->count();
                $concluidas += $objetivo->iniciativas->where('status', 'Concluída')->count();
                $andamento += $objetivo->iniciativas->where('status', 'Em execução')->count();
                $naoIniciadas += $objetivo->iniciativas->where('status', 'Não iniciada')->count();
            }
        }

        // Mapeamento dos ícones dos eixos
        $eixosIcons = [
            1  => 'bi bi-person-circle',
            2  => 'bi bi-diagram-3',
            3  => 'bi bi-lightbulb',
            4  => 'bi bi-shield-check',
            5  => 'bi bi-cloud-check',
            6  => 'bi bi-check2-circle',
            // continue para todos os eixos
        ];

        return view('home', [
            'eixos' => $eixos,
            'eixosIcons' => $eixosIcons,
            'totalIniciativas' => $totalIniciativas,
            'concluidas' => $concluidas,
            'andamento' => $andamento,
            'naoIniciadas' => $naoIniciadas,
            'todosEixos' => $todosEixos, // <-- garante que o menu funcione
        ]);
    }

    // mostra um eixo, com objetivos e iniciativas (eixo por id)
    public function show($id)
    {
        $eixo = Eixo::where('id_eixos', $id)
                    ->with(['objetivos.iniciativas'])
                    ->firstOrFail();

        // todos os eixos (para menu navegação)
        $todosEixos = Eixo::select('id_eixos','titulo')->get();

        // prepara os dados para JS
        $objetivosData = $eixo->objetivos->map(function($o) {
            return [
                'id' => $o->id_objetivo,
                'titulo' => $o->titulo,
                'descricao' => $o->descricao,
                'iniciativas' => $o->iniciativas->map(function($i){
                    return [
                        'id' => $i->id_iniciativa,
                        'codigo' => $i->codigo,
                        'titulo' => $i->titulo,
                        'descricao' => $i->descricao,
                        'status' => $i->status,
                    ];
                })->toArray(),
            ];
        })->toArray();

        // calcula contagens da sidebar
        $sidebar = [
            'total' => $eixo->objetivos->sum(fn($o) => $o->iniciativas->count()),
            'concluidas' => $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status','Concluída')->count()),
            'andamento' => $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status','Em execução')->count()),
            'nao' => $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status','Não iniciada')->count()),
        ];

        // Mapeamento ODS por objetivo
        $odsMap = [
            1  => [['id' => 10, 'ext' => 'png'], ['id' => 16, 'ext' => 'jpg']],
            2  => [['id' => 10, 'ext' => 'png'], ['id' => 16, 'ext' => 'jpg']],
            3  => [['id' => 10, 'ext' => 'png'], ['id' => 16, 'ext' => 'jpg']],
            4  => [['id' => 9, 'ext' => 'jpg'],  ['id' => 16, 'ext' => 'jpg']],
            5  => [['id' => 9, 'ext' => 'jpg'],  ['id' => 16, 'ext' => 'jpg']],
            6  => [['id' => 9, 'ext' => 'jpg'],  ['id' => 16, 'ext' => 'jpg']],
            7  => [['id' => 9, 'ext' => 'jpg']],
            8  => [['id' => 9, 'ext' => 'jpg']],
            9  => [['id' => 9, 'ext' => 'jpg']],
            10 => [['id' => 16, 'ext' => 'jpg']],
            11 => [['id' => 16, 'ext' => 'jpg']],
            12 => [['id' => 16, 'ext' => 'jpg']],
            13 => [['id' => 16, 'ext' => 'jpg']],
            14 => [['id' => 16, 'ext' => 'jpg']],
            15 => [['id' => 16, 'ext' => 'jpg']],
            16 => [['id' => 9, 'ext' => 'jpg'],  ['id' => 12, 'ext' => 'jpg']],
            17 => [['id' => 9, 'ext' => 'jpg'],  ['id' => 12, 'ext' => 'jpg']],
            18 => [['id' => 9, 'ext' => 'jpg'],  ['id' => 12, 'ext' => 'jpg']],
        ];

        return view('eixos.show', compact('eixo', 'objetivosData', 'sidebar', 'odsMap', 'todosEixos'));
    }
}
