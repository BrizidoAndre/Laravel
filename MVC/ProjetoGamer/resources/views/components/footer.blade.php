<footer>
    <div class="container row justify-content-between w-100">
        <div class="col d-flex flex-column align-items-center gap-3">
            <img src="{{ asset('/public/assets/img/icons/logotipo-gamer.svg') }}" alt="">

            <p class="valores">
                Nosso sucesso na criação de soluções de negócios se deve em grande parte à nossa equipe talentosa e
                altamente comprometida.
            </p>

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

        <div class="col">
            <h2>links úteis</h2>

            <div class="d-flex flex-column">
                <a class="text-footer" href=""><span>-</span> Inicio</a>
                <a class="text-footer" href=""><span>-</span> Jogadores</a>
                <a class="text-footer" href=""><span>-</span> Noticias</a>
                <a class="text-footer" href=""><span>-</span> Login</a>
                <a class="text-footer" href=""><span>-</span> Equipes</a>
            </div>
        </div>

        <div class="col contatos">
            <h2>Contatos</h2>

            <div class="d-flex flex-column">
                <div>
                    <span>Localização:</span>
                    <p class="text-footer">
                        Rua Niterói, 180 - São Caetano do Sul- SP
                    </p>
                </div>
                
                <div>
                    <span>Junte-se a nós:</span>
                    <p class="text-footer">
                        contato@gamer.com.br
                    </p>
                </div>

                <div>
                    <span>Telefone:</span>
                    <p class="text-footer">
                        (11) 0900-1010
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <h2>Newsletter</h2>

            <form class="d-flex flex-column align-items-center gap-3 w-100" action="">
                <input type="email" placeholder="Digite seu e-mail:">
                <button class="btn btn-warning d-flex justify-content-center align-items-center">Enviar</button>
            </form>
        </div>
    </div>
</footer>
