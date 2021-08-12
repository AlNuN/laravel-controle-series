<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index() {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = session('mensagem', '');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create() {
        return view('series.create');
    }

    public function store (SeriesFormRequest $request) {
        $serie = Serie::create($request->all());

        return redirect()->route('listar_series')
            ->with('mensagem', 
                "Série $serie->id criada com sucesso: $serie->nome");
    }

    public function destroy (Request $request) {
        Serie::destroy($request->id);
        return redirect()->route('listar_series')
            ->with('mensagem', 
                "Série $request->id removida com sucesso");
    }
}
