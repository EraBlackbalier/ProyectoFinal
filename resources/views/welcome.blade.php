</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fuentes -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <!-- Estilos -->
    <style>
        body {
            margin: 0;
            font-family: 'Figtree', ui-sans-serif, system-ui, sans-serif;
            background-image: url('https://static.vecteezy.com/system/resources/thumbnails/004/957/542/small/camouflage-seamless-pattern-for-army-and-military-free-vector.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            padding: 2rem;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        .logo {
            margin-bottom: 1.5rem;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .description {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .boton-elegante {
  padding: 15px 30px;
  border: 2px solid #2c2c2c;
  background-color: #1a1a1a;
  color: #ffffff;
  font-size: 1.2rem;
  cursor: pointer;
  border-radius: 30px;
  transition: all 0.4s ease;
  outline: none;
  position: relative;
  overflow: hidden;
  font-weight: bold;
}

.boton-elegante::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(
    circle,
    rgba(255, 255, 255, 0.25) 0%,
    rgba(255, 255, 255, 0) 70%
  );
  transform: scale(0);
  transition: transform 0.5s ease;
}

.boton-elegante:hover::after {
  transform: scale(4);
}

.boton-elegante:hover {
  border-color: #666666;
  background: #292929;
}


    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="https://steamuserimages-a.akamaihd.net/ugc/2044106057039423669/C45F7825FC9C647F77782906EA10428416A7F2B2/?imw=5000&imh=5000&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=false" alt="Logo">
        </div>

        <!-- Título -->
        <div class="title">Bienvenido a Warstock Cache</div>

        <!-- Descripción -->
        <div class="description">
            La mejor plataforma para registrar equipo militar, Explora nuestras ofertas exclusivas.
        </div>
<!-- Botones -->
<div class="space-y-4">
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end space-x-4">
            @auth
                <button
                class="boton-elegante"
                    onclick="window.location='{{ url('/dashboard') }}'"
                >
                    Dashboard
                </button>
            @else
                <button
                class="boton-elegante"
                    onclick="window.location='{{ route('login') }}'"
                >
                    Log in
                </button>

                @if (Route::has('register'))
                    <button
                    class="boton-elegante"
                        onclick="window.location='{{ route('register') }}'"
                    >
                        Register
                    </button>
                @endif
            @endauth
        </nav>
    @endif
</div>

    </div>
</body>
</html>
