<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.show', compact('users'));
    }

    public function create(Request $request)
    {
        if (is_null($request->email)) {
            return view('users.form-create');
        }

        // $fileNameToStore = '';

        if ($request->hasFile('foto')) {
            // Pegar o nome do arquivo com a extensão
            $filenameWithExt = $request->file('foto')->getClientOriginalName();

            // Pegar apenas o nome do arquivo
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Pegar apenas a extensão
            $ext = $request->file('foto')->getClientOriginalExtension();

            // Arquivo que será cadastrado
            $fileNameToStore = $filename . '_' . time() . '.' . $ext;

            $path = $request->file('foto')->storeAs('./images', $fileNameToStore, 'public');
        }

        $user = User::create([
            'email' => $request->email,
            'password' => hash('sha256', $request->password),
            'foto' => $fileNameToStore
        ]);

        return redirect()->route('users.view', ['id' => $user->id]);
    }

    public function view($id)
    {
        $user = User::where('id', $id)->first();

        if (is_null($user))
            return view('users.view', ['message' => 'Usuario não encontrado']);

        return view('users.view', compact('user'));
    }
}
