@extends('users.layout');
@section('title', 'login')

@section('content')
    <form action="{{action([UserController::class, 'create'])}}" class="d-flex flex-column gap-3 w-25">
        <input type="email" placeholder="email">
        <input type="password" minlength="8" placeholder="senha">

        <input type="file">

        <button>Login</button>
    </form>
@endsection