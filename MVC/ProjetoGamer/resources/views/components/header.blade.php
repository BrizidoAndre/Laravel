<header class="d-flex flex-column justify-content-center z-3 position-fixed top-0 left-0 w-100">
    <div class="position-absolute mb-2 start-5 w-100 border-top border-warning"></div>

    <div class="container  h-100">
        <div class="d-flex align-items-center justify-content-between w-100  h-25 pt-3">
            <div class="text-light d-flex align-items-center gap-5">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('public/assets/img/icons/phone.svg') }}" alt="">
                    <p class="m-0">(11) 0900-1010</p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('public/assets/img/icons/email.svg') }}" alt="">
                    <p class="m-0">contato@gmail.com</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-5">
                <a target="_blank" href="https://www.facebook.com">
                    <img src="{{ asset('public/assets/img/icons/facebook.svg') }}" alt="">
                </a>
                <a target="_blank" href="https://www.linkedin.com">
                    <img src="{{ asset('public/assets/img/icons/linkedin.svg') }}" alt="">
                </a>
                <a target="_blank" href="https://www.instagram.com">
                    <img src="{{ asset('public/assets/img/icons/instagram.svg') }}" alt="">
                </a>
            </div>
        </div>


        <nav class="d-flex align-items-center justify-content-between w-100 h-75 mt-3">
            <img src="{{ asset('public/assets/img/icons/logotipo-gamer.svg') }}" alt="">

            <div class="d-flex justify-content-between align-items-center gap-5">
                <a class="link-light link-underline-opacity-0" href="{{ route('app.home') }}">Início</a>
                <a class="link-light link-underline-opacity-0" href="{{ route('app.jogadores') }}">Jogadores</a>
                <a class="link-light link-underline-opacity-0" href="{{ route('app.equipes') }}">Equipes</a>
                <a class="link-light link-underline-opacity-0" href="">Notícias</a>
            </div>

            <div class="d-flex align-items-center gap-5">
                <a href="{{ route('app.login') }}"><img src="{{ asset('public/assets/img/icons/conta.svg') }}" alt=""></a>
                <a href=""><img src="{{ asset('public/assets/img/icons/compras.svg') }}" alt=""></a>
                <a href=""><img src="{{ asset('public/assets/img/icons/lupa.svg') }}" alt=""></a>
            </div>
        </nav>
    </div>
</header>
