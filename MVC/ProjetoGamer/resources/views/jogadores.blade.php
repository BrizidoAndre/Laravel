<link rel="stylesheet" href="{{ asset('public/assets/css/jogadores.css') }}">
@extends('layouts.layout')

@section('content')
    <section class="form-jogadores">
        <div class="container w-100">

            <div class="box-form  d-flex flex-column align-items-center py-5">
                <h2 class="my-5">
                    @empty($jogador)
                        cadastro de jogadores
                    @endempty
                    @isset($jogador)
                        editar jogador
                    @endisset
                </h2>

                <form method="POST" class="d-flex flex-column align-items-center gap-3 w-75"
                    action="
                        @empty($jogador){{ route('app.jogadores.store') }}@endempty
                    ">
                    @csrf

                    <input type="hidden" name="player_id" id="player_id"
                        value="@isset($jogador){{ $jogador->player_id }}@endisset">

                    <input type="text" placeholder="Digite o id do jogador" id="input-false"
                        value="@isset($jogador){{ $jogador->player_id }}@endisset" disabled>

                    <select name="team_id">
                        <option value="">Selecione uma Equipe:</option>

                        @foreach ($equipes as $equipe)
                            <option value="{{ $equipe->team_id }}">
                                {{ $equipe->name }}
                            </option>
                        @endforeach

                    </select>

                    <div class="w-100">
                        <input type="text" placeholder="Digite o nome do jogador:" name="name">
                        @isset($errors->store)
                            <p class="text-danger">{{ $errors->store->first('name') }}</p>
                        @endisset
                    </div>

                    <div class="w-100">
                        <input type="email" placeholder="Digite o email do jogador:" name="email">
                        @isset($errors->store)
                            <p class="text-danger">{{ $errors->store->first('email') }}</p>
                        @endisset
                    </div>

                    <div class="w-100">
                        <input type="password" placeholder="Digite a senha do jogador:" name="password">
                        @isset($errors->store)
                            <p class="text-danger">{{ $errors->store->first('password') }}</p>
                        @endisset
                    </div>

                    <button class="btn btn-warning">Cadastro</button>
                </form>
            </div>

            <table>
                <thead>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Email</th>
                </thead>
                <tbody>
                    @foreach ($jogadores as $j)
                        <tr>
                            <td>
                                <div>{{ $j->player_id }}</div>
                                <div>{{ $j->name }}</div>
                                <div>{{ $j->email }}</div>
                            </td>
                            <td>
                                <img src="{{ asset('/public/assets/img/icons/trash.svg ') }}" alt="">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
