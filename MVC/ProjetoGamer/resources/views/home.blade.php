<link rel="stylesheet" href="{{ asset('public/assets/css/home.css') }}">
@extends('layouts.layout')

@section('content')
        <section class="banner d-flex align-items-center">
            <div class="d-flex flex-column justify-content-between align-items-center w-100 h-100 p-5">
                <h1>Liga Gamers</h1>

                <button class="btn btn-warning d-flex justify-content-center align-items-center">
                    Sobre
                </button>
            </div>
        </section>

        <section class="destaques p-5 w-100">
            <div class="container d-flex align-items-center justify-content-evenly">
                <img src="{{ asset('/public/assets/img/card-fifa.png') }}" alt="">
                <img src="{{ asset('/public/assets/img/card-csgo.png') }}" alt="">
            </div>
        </section>

        <section class="progamer py-5">
            <div class="container d-flex flex-column align-items-center gap-5">
                <h1>entre para o time progamer</h1>

                <div class="d-flex justify-content-between w-100">
                    {{-- Kiljoy --}}
                    <div class="position-relative z-1">
                        <img src="{{ asset('/public/assets/img/kiljoy.png') }}" alt="">

                        <div class="glass-card d-flex flex-column align-items-center position-absolute bottom-0 end-0">
                            <img src="{{ asset('/public/assets/img/icons/controle.svg') }}" alt="">

                            <h2>20 jogos diferentes</h2>

                            <p>
                                São mais de 20 jogos em 2 plataformas dispóniveis para que você possa aprender melhores
                                técnicas.
                            </p>
                        </div>
                    </div>

                    {{-- Jinx --}}
                    <div class="position-relative z-1">
                        <img src="{{ asset('/public/assets/img/Jinx.png') }}" alt="">

                        <div class="glass-card d-flex flex-column align-items-center position-absolute bottom-0 start-0">
                            <img src="{{ asset('/public/assets/img/icons/professores.svg') }}" alt="">

                            <h2>50 professores</h2>

                            <p>
                                Temos 53 Proplayers no nosso time para ensinar todas as estratégias, você vai aprender
                                do básico ao avançado. Tempo de treinamento, descanso, equipamentos.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <section class="noticias d-flex flex-column align-items-center py-5">
            <h2 class="my-5">noticias</h2>

            <div class="w-100 container d-flex align-items-center justify-content-evenly flex-wrap">
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-1.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-2.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-3.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-4.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-1.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-2.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-3.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
                <div class="card w-25 m-3">
                    <img src="{{ asset('/public/assets/img/noticias-esports-4.png') }}" class="w-100">

                    <h2>Titulo da Notícia</h2>

                    <p>
                        Mussum Ipsum, cacilds vidis litro abertis. Sapien in monti palavris qui num significa nadis i pareci
                        latim.Viva Forevis aptent taciti sociosqu ad litora torquent.Pra lá , depois divoltis porris,
                        paradis.
                    </p>
                </div>
            </div>
        </section>
@endsection
