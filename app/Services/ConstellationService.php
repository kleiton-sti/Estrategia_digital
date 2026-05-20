<?php

namespace App\Services;

class ConstellationService
{
    /**
     * Retorna a definição da constelação (nós e arestas) para um eixo pelo id.
     * Coordenadas normalizadas em 0–100 (viewBox 0 0 100 60).
     */
    public static function porEixo(int $eixoId): array
    {
        return match ($eixoId) {

            /* Gestão Centrada no Munícipe */
            1 => [
                'nos' => [
                    ['x' => 50, 'y' => 8,  'r' => 4,   'principal' => true],
                    ['x' => 25, 'y' => 25, 'r' => 3,   'principal' => false],
                    ['x' => 75, 'y' => 25, 'r' => 3,   'principal' => false],
                    ['x' => 15, 'y' => 48, 'r' => 2,   'principal' => false],
                    ['x' => 40, 'y' => 48, 'r' => 2,   'principal' => false],
                    ['x' => 62, 'y' => 48, 'r' => 2,   'principal' => false],
                    ['x' => 85, 'y' => 48, 'r' => 2,   'principal' => false],
                    ['x' => 50, 'y' => 38, 'r' => 2.5, 'principal' => false],
                ],
                'arestas' => [
                    [0, 1], [0, 2], [1, 3], [1, 4], [2, 5], [2, 6], [0, 7], [7, 4], [7, 5],
                ],
            ],

            /* Gestão e Governança Digital */
            2 => [
                'nos' => [
                    ['x' => 10,  'y' => 30, 'r' => 2.5, 'principal' => false],
                    ['x' => 30,  'y' => 10, 'r' => 3,   'principal' => true],
                    ['x' => 50,  'y' => 30, 'r' => 4,   'principal' => true],
                    ['x' => 70,  'y' => 10, 'r' => 3,   'principal' => true],
                    ['x' => 90,  'y' => 30, 'r' => 2.5, 'principal' => false],
                    ['x' => 30,  'y' => 50, 'r' => 2,   'principal' => false],
                    ['x' => 70,  'y' => 50, 'r' => 2,   'principal' => false],
                    ['x' => 50,  'y' => 55, 'r' => 2,   'principal' => false],
                ],
                'arestas' => [
                    [0, 1], [1, 2], [2, 3], [3, 4], [1, 5], [3, 6], [5, 7], [6, 7], [2, 7],
                ],
            ],

            /* Inovação e Tecnologia */
            3 => [
                'nos' => [
                    ['x' => 50, 'y' => 5,  'r' => 4,   'principal' => true],
                    ['x' => 20, 'y' => 22, 'r' => 2.5, 'principal' => false],
                    ['x' => 80, 'y' => 22, 'r' => 2.5, 'principal' => false],
                    ['x' => 8,  'y' => 45, 'r' => 2,   'principal' => false],
                    ['x' => 35, 'y' => 42, 'r' => 3,   'principal' => true],
                    ['x' => 65, 'y' => 42, 'r' => 3,   'principal' => true],
                    ['x' => 92, 'y' => 45, 'r' => 2,   'principal' => false],
                    ['x' => 50, 'y' => 55, 'r' => 2,   'principal' => false],
                ],
                'arestas' => [
                    [0, 1], [0, 2], [1, 3], [1, 4], [2, 5], [2, 6], [4, 7], [5, 7], [4, 5],
                ],
            ],

            /* Infraestrutura e Conectividade */
            4 => [
                'nos' => [
                    ['x' => 5,  'y' => 30, 'r' => 2,   'principal' => false],
                    ['x' => 22, 'y' => 15, 'r' => 2.5, 'principal' => false],
                    ['x' => 22, 'y' => 45, 'r' => 2.5, 'principal' => false],
                    ['x' => 42, 'y' => 30, 'r' => 4,   'principal' => true],
                    ['x' => 60, 'y' => 12, 'r' => 2.5, 'principal' => false],
                    ['x' => 60, 'y' => 48, 'r' => 2.5, 'principal' => false],
                    ['x' => 78, 'y' => 22, 'r' => 3,   'principal' => true],
                    ['x' => 78, 'y' => 38, 'r' => 3,   'principal' => true],
                    ['x' => 95, 'y' => 30, 'r' => 2,   'principal' => false],
                ],
                'arestas' => [
                    [0, 1], [0, 2], [1, 3], [2, 3], [3, 4], [3, 5], [4, 6], [5, 7], [6, 8], [7, 8], [6, 7],
                ],
            ],

            /* Segurança e Privacidade */
            5 => [
                'nos' => [
                    ['x' => 50, 'y' => 5,  'r' => 4,   'principal' => true],
                    ['x' => 15, 'y' => 28, 'r' => 3,   'principal' => true],
                    ['x' => 85, 'y' => 28, 'r' => 3,   'principal' => true],
                    ['x' => 30, 'y' => 52, 'r' => 2.5, 'principal' => false],
                    ['x' => 70, 'y' => 52, 'r' => 2.5, 'principal' => false],
                    ['x' => 50, 'y' => 35, 'r' => 3.5, 'principal' => true],
                    ['x' => 50, 'y' => 58, 'r' => 2,   'principal' => false],
                ],
                'arestas' => [
                    [0, 1], [0, 2], [1, 3], [2, 4], [3, 6], [4, 6], [0, 5], [1, 5], [2, 5], [5, 6],
                ],
            ],

            /* Sustentabilidade Digital */
            6 => [
                'nos' => [
                    ['x' => 50, 'y' => 8,  'r' => 3.5, 'principal' => true],
                    ['x' => 18, 'y' => 30, 'r' => 2.5, 'principal' => false],
                    ['x' => 82, 'y' => 30, 'r' => 2.5, 'principal' => false],
                    ['x' => 34, 'y' => 30, 'r' => 3,   'principal' => true],
                    ['x' => 66, 'y' => 30, 'r' => 3,   'principal' => true],
                    ['x' => 10, 'y' => 52, 'r' => 2,   'principal' => false],
                    ['x' => 50, 'y' => 52, 'r' => 3,   'principal' => true],
                    ['x' => 90, 'y' => 52, 'r' => 2,   'principal' => false],
                ],
                'arestas' => [
                    [0, 1], [0, 2], [0, 3], [0, 4], [1, 5], [3, 6], [4, 6], [2, 7], [6, 5], [6, 7],
                ],
            ],

            default => [
                'nos'    => [],
                'arestas'=> [],
            ],
        };
    }
}
