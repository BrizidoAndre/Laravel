<link rel="stylesheet" href="{{ asset('public/assets/css/equipes.css') }}">
@extends('layouts.layout')

@section('content')
    <section class="form-equipes">
        <div class="container w-100">
            <div class="box-form  d-flex flex-column align-items-center py-5">
                <h2 class="my-5">
                    @empty($equipe) cadastro de equipes @endempty
                    @isset($equipe) editar equipe @endisset
                </h2>

                <form 
                    class="d-flex flex-column align-items-center gap-3 w-75"
                    action="
                        @isset($equipe)
                        {{ route('app.equipes.update', ['team_id' => str_replace('#', '', $equipe->team_id)]) }}
                         @endisset
                        @empty($equipe){{ route('app.equipes.store') }}@endempty"
                        method="POST" 
                        enctype="multipart/form-data"
                    >
                    @csrf

                    <input 
                        type="hidden" 
                        name="player_id" 
                        id="player_id"
                        value="@isset($jogador){{ $jogador->player_id }}@endisset"
                    >

                    <input 
                        type="text" 
                        id="input-false"
                        value="@isset($jogador){{ $jogador->player_id }}@endisset" 
                        disabled
                    >

                    <div class="w-100">
                        <input 
                            class="mb-3" 
                            type="text" 
                            placeholder="Digite o nome da sua equipe:" 
                            name="name"
                            value="@isset($equipe){{ $equipe->name }}@endisset"
                        >

                        @isset($errors->store)
                            <p class="text-danger">{{ $errors->store->first('name') }}</p>    
                        @endisset
                    </div>

                    <div class="w-100">    
                        <input 
                            class="mb-3" 
                            type="file" 
                            name="shield"
                        >
                        
                        @isset($errors->store)
                            <p class="text-danger">{{ $errors->store->first('shield') }}</p>
                        @endisset
                    </div>

                    <button class="btn btn-warning">
                        @empty($equipe) Casdastrar @endempty
                        @isset($equipe) Atualizar @endisset
                    </button>
                </form>
            </div>

            <table>
                <thead>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Foto</th>
                </thead>
                <tbody>
                    @foreach ($equipes as $equipe)
                        <tr>
                            <td>
                                <div>{{ $equipe->team_id }}</div>
                                <div>{{ $equipe->name }}</div>
                                <div>
                                    <img 
                                        class="shield rounded"
                                        src="{{ asset('/public/storage/images/' . $equipe->shield) }}" 
                                        alt=""
                                    >
                                </div>
                            </td>
                            <td class="flex align-items-center gap-3">
                                <form
                                    action="{{ route('app.equipes.delete', ['team_id' => str_replace('#', '', $equipe->team_id)]) }}"
                                    class="m-0"
                                >
                                    <button class="btn flex align-items-center justify-content-center">
                                        <img src="{{ asset('/public/assets/img/icons/trash.svg') }}" alt="">
                                    </button>
                                </form>

                                <form 
                                    method="POST"
                                    action="{{ route('app.equipes.edit', ['team_id' => str_replace('#', '', $equipe->team_id)]) }}"
                                    class="m-0"
                                >
                                
                                    <button class="btn flex align-items-center justify-content-center">
                                        @csrf
                                        <img src="{{ asset('/public/assets/img/icons/edit.svg') }}" alt="">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

