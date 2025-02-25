<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('equipes', ['equipes' => Team::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validando a requisição
        $validator = Validator::make(
            // Valores que serão validados
            $request->all(),
            // Regras de validaçãos
            [
                'name' => 'required|unique:team',
                'shield' => 'required'
            ],
            // Mensagens customizadas
            [
                'required' => 'O campo :attribute é necessário',
                'unique' => 'Esse nome já está sendo utilizado'
            ]
        );

        // Caso a validação falhe
        if ($validator->fails()) {
            // Redireciona para a pagina de equipes, junto com os erros
            return redirect('equipes')->withErrors($validator, 'store');
        }

        // Lógica para salvar um arquivo (imagens)

        // Nome do arquivo com a extensão
        $fileNameWithExt = $request->file('shield')->getClientOriginalName();

        // Somente a extensão do arquivo
        $ext = $request->file('shield')->getClientOriginalExtension();

        // Extrai somente o nome do arquivo
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // Modifica o nome do arquivo, adicionando o timestamp
        $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

        // Salva o arquivo dentro do storage, na pasta public
        $request->file('shield')->storeAs('./images', $fileNameToStore, 'public');

        // Salva os dados validados no banco
        Team::create([
            'team_id' => $request->team_id,
            'name' => $request->name,
            'shield' => $fileNameToStore
        ]);

        return redirect('equipes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $team_id, Team $team)
    {
        // Segue a mesma lógicada criação de equipes (rota store)
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:team',
                'shield' => 'required'
            ],
            [
                'required' => 'O campo :attribute é necessário',
                'unique' => 'Esse nome já está sendo utilizado'
            ]
        );

        if ($validator->fails()) {
            return redirect('equipes')->withErrors($validator, 'store');
        }

        $team = Team::where('team_id', '#' . $team_id)->first();

        return view('equipes', ['equipes' => Team::all(), 'equipe' => $team]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $team_id, Request $request)
    {
        $team = Team::where('team_id', '#' . $team_id)->first();
        $team->update([
            'name' => $request->name
        ]);


        if (!is_null($request->shield)) {
            $fileNameWithExt = $request->file('shield')->getClientOriginalName();
            $ext = $request->file('shield')->getClientOriginalExtension();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

            $request->file('shield')->storeAs('./images', $fileNameToStore, 'public');

            $team->update([
                'shield' => $fileNameToStore
            ]);
        }

        return redirect('equipes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $team_id)
    {
        Team::where('team_id', '#' . $team_id)->delete();

        return redirect('equipes');
    }
}
