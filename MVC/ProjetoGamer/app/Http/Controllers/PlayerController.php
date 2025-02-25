<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    public function index() {
        return view('jogadores', [
            'jogadores' => Player::all(), 
            'equipes' => Team::all()
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'team_id' => 'required',
                'name' => 'required',
                'email' => 'required|unique:player',
                'password' => 'required'
            ],
            [
                'required' => 'O campo :attribute é necessário',
                'unique' => 'Esse email já está sendo utilizado'
            ]
        );

        if($validator->fails()) {
            return redirect('jogadores')->withErrors($validator, 'store');
        }

        Player::create($request->all());

        return redirect('jogadores');
    }
}
