<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = session('mensagem', '');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {

        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );

        return redirect()->route('listar_series')
            ->with(
                'mensagem',
                "Série $serie->id e suas temporadas e episódios criados com sucesso: $serie->nome"
            );
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        Serie::destroy($request->id);
        return redirect()->route('listar_series')
            ->with(
                'mensagem',
                "Série $nomeSerie e suas temporadas e episódios removidos com sucesso"
            );
    }
}
