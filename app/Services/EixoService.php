<?php

namespace App\Services;

use App\Models\Eixo;
use Illuminate\Support\Facades\Log;

class EixoService
{
    private const EIXOS_ICONS = [
        1  => 'bi bi-person-circle',
        2  => 'bi bi-diagram-3',
        3  => 'bi bi-lightbulb',
        4  => 'bi bi-shield-check',
        5  => 'bi bi-cloud-check',
        6  => 'bi bi-check2-circle',
    ];

    private const ODS_MAP = [
        1  => [['id' => 10, 'ext' => 'png'], ['id' => 16, 'ext' => 'jpg']],
        2  => [['id' => 10, 'ext' => 'png'], ['id' => 16, 'ext' => 'jpg']],
        3  => [['id' => 10, 'ext' => 'png'], ['id' => 16, 'ext' => 'jpg']],
        4  => [['id' => 9,  'ext' => 'jpg'], ['id' => 16, 'ext' => 'jpg']],
        5  => [['id' => 9,  'ext' => 'jpg'], ['id' => 16, 'ext' => 'jpg']],
        6  => [['id' => 9,  'ext' => 'jpg'], ['id' => 16, 'ext' => 'jpg']],
        7  => [['id' => 9,  'ext' => 'jpg']],
        8  => [['id' => 9,  'ext' => 'jpg']],
        9  => [['id' => 9,  'ext' => 'jpg']],
        10 => [['id' => 16, 'ext' => 'jpg']],
        11 => [['id' => 16, 'ext' => 'jpg']],
        12 => [['id' => 16, 'ext' => 'jpg']],
        13 => [['id' => 16, 'ext' => 'jpg']],
        14 => [['id' => 16, 'ext' => 'jpg']],
        15 => [['id' => 16, 'ext' => 'jpg']],
        16 => [['id' => 9,  'ext' => 'jpg'], ['id' => 12, 'ext' => 'jpg']],
        17 => [['id' => 9,  'ext' => 'jpg'], ['id' => 12, 'ext' => 'jpg']],
        18 => [['id' => 9,  'ext' => 'jpg'], ['id' => 12, 'ext' => 'jpg']],
    ];

    public function dadosHome(): array
    {
        try {
            $eixos = Eixo::with(['objetivos.iniciativas'])->get();

            $totais = [
                'totalIniciativas' => 0,
                'concluidas'       => 0,
                'andamento'        => 0,
                'naoIniciadas'     => 0,
            ];

            foreach ($eixos as $eixo) {
                foreach ($eixo->objetivos as $objetivo) {
                    $ini = $objetivo->iniciativas;
                    $totais['totalIniciativas'] += $ini->count();
                    $totais['concluidas']       += $ini->where('status', 'Concluída')->count();
                    $totais['andamento']        += $ini->where('status', 'Em execução')->count();
                    $totais['naoIniciadas']     += $ini->where('status', 'Não iniciada')->count();
                }
            }

            /* progresso por eixo para a home */
            $progressoPorEixo = $eixos->mapWithKeys(function ($eixo) {
                $total      = $eixo->objetivos->sum(fn($o) => $o->iniciativas->count());
                $concluidas = $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Concluída')->count());
                return [
                    $eixo->id_eixos => $total > 0 ? round($concluidas / $total, 4) : 0.0,
                ];
            })->toArray();

            /* constelações para a home */
            $constelacoesPorEixo = $eixos->mapWithKeys(function ($eixo) {
                return [
                    $eixo->id_eixos => \App\Services\ConstellationService::porEixo($eixo->id_eixos),
                ];
            })->toArray();

            return array_merge($totais, [
                'eixos'               => $eixos,
                'eixosIcons'          => self::EIXOS_ICONS,
                'progressoPorEixo'    => $progressoPorEixo,
                'constelacoesPorEixo' => $constelacoesPorEixo,
            ]);
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar dados da home: ' . $e->getMessage());
            abort(500);
        }
    }

    public function dadosEixo(int $id): array
    {
        try {
            $eixo = Eixo::where('id_eixos', $id)
                ->with(['objetivos.iniciativas'])
                ->firstOrFail();

            $objetivosData = $eixo->objetivos->map(fn($o) => [
                'id'          => $o->id_objetivo,
                'titulo'      => $o->titulo,
                'descricao'   => $o->descricao,
                'iniciativas' => $o->iniciativas->map(fn($i) => [
                    'id'        => $i->id_iniciativa,
                    'codigo'    => $i->codigo,
                    'titulo'    => $i->titulo,
                    'descricao' => $i->descricao,
                    'status'    => $i->status,
                ])->toArray(),
            ])->toArray();

            $total      = $eixo->objetivos->sum(fn($o) => $o->iniciativas->count());
            $concluidas = $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Concluída')->count());

            $sidebar = [
                'total'      => $total,
                'concluidas' => $concluidas,
                'andamento'  => $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Em execução')->count()),
                'nao'        => $eixo->objetivos->sum(fn($o) => $o->iniciativas->where('status', 'Não iniciada')->count()),
            ];

            $progresso    = $total > 0 ? round($concluidas / $total, 4) : 0.0;
            $constelacao  = \App\Services\ConstellationService::porEixo($id);

            return [
                'eixo'          => $eixo,
                'objetivosData' => $objetivosData,
                'sidebar'       => $sidebar,
                'odsMap'        => self::ODS_MAP,
                'progresso'     => $progresso,
                'constelacao'   => $constelacao,
            ];
        } catch (\Throwable $e) {
            Log::error('Erro ao carregar eixo #' . $id . ': ' . $e->getMessage());
            abort(500);
        }
    }
}
