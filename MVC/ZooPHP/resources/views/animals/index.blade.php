@php
    $teste = 'olá';
@endphp

@extends('users.layout')
@section('title', 'show')
@section('content')
    @component('components.table-animals')
        @slot('cells')
            @foreach ($animals as $animal)
                <tr>
                    <td><a href="">{{ $animal->nome }}</a></td>
                    <td>{{ $animal->nome_cientifico }}</td>
                    <td>{{ $animal->altura }}</td>
                    <td>{{ $animal->comprimento }}</td>
                    <td>{{ $animal->peso }}</td>
                    <td>{{ $animal->expectativa_vida }}</td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endsection

