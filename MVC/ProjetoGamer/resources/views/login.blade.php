<link rel="stylesheet" href="{{ asset('public/assets/css/login.css') }}">
@extends('layouts.layout')

@section('content')
<section class="form-login">
<div class="container w-100">

    <div class="box-form  d-flex flex-column align-items-center py-5">
        <h2 class="my-5">login</h2>

        <form class="d-flex flex-column align-items-center gap-3 w-75" action="">
            <input type="email" placeholder="Digite seu email:">
            <input type="password" placeholder="Digite sua senha:">

            <button class="btn btn-warning">Entrar</button>
        </form>
    </div>

</div>
</section>
@endsection