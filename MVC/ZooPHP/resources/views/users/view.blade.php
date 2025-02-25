@extends('users.layout')
@section('title', 'view')

@section('content')
    <div>
        <img src="/storage/images/{{$user->foto}}" class="w-50 h-50" alt="">

        <p>Email: {{ $user->email }}</p>
    </div>

@endsection
