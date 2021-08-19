<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $epPorTemporada
    ): Serie {

        DB::beginTransaction();

        $serie = Serie::create(['nome' => $nomeSerie]);

        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemporada; $j++) {
                $episodio = $temporada->episodios()->create(['numero' => $j]);
            }
        }

        DB::commit();

        return $serie;
    }
}
