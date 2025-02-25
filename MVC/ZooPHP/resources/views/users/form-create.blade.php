@extends('users.layout')
@section('title', 'Cadastro de usuário')

@section('content')
    <form action="{{ route('users.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control" name="email" placeholder="email">
        <input type="text" class="form-control" name="password" placeholder="senha">
        <input type="file" class="form-control" name="foto" placeholder="foto">

        <button>Cadastrar</button>
    </form>
@endsection
