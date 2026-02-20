<!DOCTYPE html>
<html lang="pt-BR" style="background-color: #000000;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculos para Usinagem</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme-toggle.js'])
    <style>
        html.light-mode {
            background-color: #ffffff !important;
        }
        html.light-mode body {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        html.light-mode h1,
        html.light-mode h2,
        html.light-mode h3,
        html.light-mode h4,
        html.light-mode h5,
        html.light-mode h6 {
            color: #000000 !important;
        }
        html.light-mode p {
            color: #000000 !important;
        }
        html.light-mode footer {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        html.light-mode footer p {
            color: #000000 !important;
        }
        html.light-mode footer * {
            color: #000000 !important;
        }
        html.light-mode header {
            background-color: #ffffff !important;
            box-shadow: none !important;
            border: none !important;
        }
        html.light-mode header > div {
            box-shadow: none !important;
            border: none !important;
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen" id="main-body">
    <!-- Mobile Menu Toggle (Hidden) -->
    <input type="checkbox" id="menu-toggle" class="hidden peer">

    <!-- Header -->
    <header class="bg-black shadow-sm z-40">
        <!-- White Banner with Logo (roda junto com a página) -->
        <div class="w-full bg-white flex flex-col items-center justify-center relative" style="height: 180px;">
            <span class="text-black font-bold text-xl absolute left-8 top-4">Calcmachining.com</span>
            
            <!-- Logo centralizada -->
            <a href="{{ url('/') }}" class="flex items-center justify-center">
                <img src="/logo.png" alt="Logo" class="object-contain" style="height: 120px;">
            </a>
            
            <!-- Menu abaixo da logo centralizado -->
            <div class="flex gap-12 mt-3 items-center justify-center">
                <a href="{{ url('/pagamentos') }}" class="text-black font-bold text-lg hover:text-gray-600 transition" style="text-decoration: none;">PAGAMENTO</a>
                <a href="{{ url('/sobre') }}" class="text-black font-bold text-lg hover:text-gray-600 transition" style="text-decoration: none;">SOBRE</a>
            </div>
            
            <div class="absolute right-8 flex gap-4 items-center top-4">
                <button class="bg-black text-white px-6 py-2 rounded font-semibold hover:bg-gray-800 transition">LOGIN</button>
                <button class="bg-black text-white px-6 py-2 rounded font-semibold hover:bg-gray-800 transition">CADASTRE-SE</button>
                <button id="theme-toggle" class="ml-2 p-2 hover:bg-gray-200 rounded transition" title="Alterar Tema">
                    <svg id="sun-icon" class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v2a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l-2.12-2.12a1 1 0 00-1.414 0l-2.12 2.12a1 1 0 101.414 1.414L9 11.414l1.464 1.465a1 1 0 001.414-1.414zM15 5a1 1 0 100-2 1 1 0 000 2zM3 5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <svg id="moon-icon" class="w-6 h-6 text-black hidden" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <nav class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <!-- Logo removed - now in white banner above -->
            <div class="flex-shrink-0">
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-6">
            </div>

            <!-- Mobile Menu Button -->
            <label for="menu-toggle" class="md:hidden cursor-pointer flex flex-col gap-1.5">
                <span class="w-6 h-0.5 bg-white transition transform peer-checked:rotate-45 peer-checked:translate-y-2"></span>
                <span class="w-6 h-0.5 bg-white transition opacity-0 peer-checked:opacity-0"></span>
                <span class="w-6 h-0.5 bg-white transition transform peer-checked:-rotate-45 peer-checked:-translate-y-2"></span>
            </label>
        </nav>

        <!-- Mobile Menu -->
        <div class="md:hidden max-h-0 peer-checked:max-h-64 overflow-hidden transition-all duration-300">
            <div class="px-4 py-4 space-y-3 bg-gray-900">
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-12">
        <!-- Title Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" style="font-family: 'Roboto', sans-serif;">
                CÁLCULOS PARA USINAGEM
            </h1>
            <p class="text-lg text-gray-300" style="font-family: 'Roboto', sans-serif;">
                FERRAMENTA PARA OTMIZAÇÃO DE PROCESSOS DE USINAGEM
            </p>
        </div>

        <div class="d-grid gap-2">
    <a href="{{ route('medidaw.reto') }}" class="btn-custom inline-block text-center">MEDIDA W(K) RETO</a>
    <a href="{{ route('medidaw.helicoidal') }}" class="btn-custom inline-block text-center">MEDIDA W(K) HELICOIDAL</a>
    <a href="{{ route('helicoidal') }}" class="btn-custom inline-block text-center">ENGRENAGEM HELICOIDAL</a>
    <a href="{{ route('kit.com-passo') }}" class="btn-custom inline-block text-center">KIT ENGRENAGEM COM PASSO</a>
    <a href="#" class="btn-custom inline-block text-center">EM PROGRESSO</a>
    <a href="#" class="btn-custom inline-block text-center">EM PROGRESSO</a>
</div>

    </main>

    <!-- Footer -->
    <footer class="bg-black-900 text-white mt-8 py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-xs">
                &copy; {{ date('Y') }} Calc Machining. Todos os direitos reservados.
            </p>
        </div>
    </footer>
</body>
</html>
