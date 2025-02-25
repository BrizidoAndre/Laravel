@php
    use App\Models\User;
@endphp

@extends('users.layout')
@section('title', 'show')
@section('content')
    @component('components.table-users')
        @slot('cells')
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td><a href="{{ route('users.view', $user->id) }}">{{ $user->email }}</a></td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endsection
