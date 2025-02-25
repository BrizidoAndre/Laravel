<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projeto Gamer</title>
    <link rel="stylesheet" href="{{ asset('/public/assets/css/components/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/components/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/fonts-import.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body onload="GerarId(7)">
    @component('components.header')
    @endcomponent

    <main style="margin-top: 140px">
        @yield('content')
    </main>
    
    @component('components.footer')
    @endcomponent

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

     <script>
        const inputTeamId = document.getElementById('team_id');
        const inputPlayerId = document.getElementById('player_id');
        const inputFalse = document.getElementById('input-false');


        function GerarId(length) {
            if (inputFalse.value === '') {
                const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let result = '';
                const charactersLength = characters.length;
                for (let i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }

                inputFalse.value = '#' + result;
                inputTeamId = inputPlayerId = inputFalse;
            }
        }
    </script>

    @yield('script')
</body>

</html>
