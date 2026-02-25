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

        header .flex.gap-12.mt-3 a,
        header .flex.gap-6.mt-3 a {
            border: 1px solid #2563eb !important;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        header .flex.gap-12.mt-3 a:hover,
        header .flex.gap-6.mt-3 a:hover {
            background-color: #93c5fd !important;
            color: #1f2937 !important;
        }

        .auth-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.78);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-card {
            width: 100%;
            max-width: 560px;
        }

        .auth-hidden {
            display: none;
        }

        html.light-mode .auth-card .auth-title,
        html.light-mode .auth-card .auth-subtitle {
            color: #ffffff !important;
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
                <a href="{{ auth()->check() ? route('engrenagens') : '#' }}" class="text-black font-bold text-lg hover:text-gray-600 transition {{ auth()->check() ? '' : 'require-auth' }}" style="text-decoration: none;">CONFIGURAR ENGRENAGENS</a>
                <a href="{{ url('/sobre') }}" class="text-black font-bold text-lg hover:text-gray-600 transition" style="text-decoration: none;" data-guest-allowed="true">SOBRE</a>
            </div>
            
            <div class="absolute right-8 flex gap-4 items-center top-4">
                @if(auth()->check())
                    <span class="text-black text-base font-semibold">{{ auth()->user()->name }}</span>
                    <details class="relative">
                        <summary class="list-none bg-black text-white w-20 h-6 rounded text-xs font-semibold hover:bg-gray-800 transition cursor-pointer leading-none text-center p-0" style="display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;color:#ffffff !important;">ACCOUNT</summary>
                        <div class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded shadow-lg z-50">
                            <a href="{{ route('conta.dados') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-gray-100" style="text-decoration: none !important;">Dados</a>
                            <a href="{{ route('pagamentos') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-gray-100" style="text-decoration: none !important;">Assinatura</a>
                            <a href="{{ route('conta.historico-calculos') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-gray-100" style="text-decoration: none !important;">Histórico de cálculos</a>
                            <a href="{{ route('politica.privacidade') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-gray-100" style="text-decoration: none !important;">Política de privacidade</a>
                            <a href="{{ route('termos.uso') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-gray-100" style="text-decoration: none !important;">Termos de uso</a>
                        </div>
                    </details>
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-black text-white w-20 h-6 rounded text-xs font-semibold hover:bg-gray-800 transition cursor-pointer leading-none text-center p-0" style="display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;">SIGN OUT</button>
                    </form>
                @else
                    <a id="show-login" href="{{ route('home', ['auth' => 'login']) }}" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition" style="text-decoration: none !important;" data-guest-allowed="true">LOGIN</a>
                    <a id="show-register" href="{{ route('home', ['auth' => 'register']) }}" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition" style="text-decoration: none !important;" data-guest-allowed="true">CADASTRE-SE</a>
                @endif
                <button id="theme-toggle" class="ml-2 p-2 hover:bg-gray-200 rounded transition" title="Alterar Tema" data-guest-allowed="true">
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
    <a href="{{ auth()->check() ? route('medidaw.reto') : '#' }}" class="btn-custom inline-block text-center {{ auth()->check() ? '' : 'require-auth' }}">MEDIDA W(K) RETO</a>
    <a href="{{ auth()->check() ? route('medidaw.helicoidal') : '#' }}" class="btn-custom inline-block text-center {{ auth()->check() ? '' : 'require-auth' }}">MEDIDA W(K) HELICOIDAL</a>
    <a href="{{ auth()->check() ? route('helicoidal') : '#' }}" class="btn-custom inline-block text-center {{ auth()->check() ? '' : 'require-auth' }}">ENGRENAGEM HELICOIDAL</a>
    <a href="{{ auth()->check() ? route('kit.com-passo') : '#' }}" class="btn-custom inline-block text-center {{ auth()->check() ? '' : 'require-auth' }}">KIT ENGRENAGEM COM PASSO</a>
    <a href="{{ auth()->check() ? route('medida.cordal') : '#' }}" class="btn-custom inline-block text-center {{ auth()->check() ? '' : 'require-auth' }}">EM PROGRESSO</a>
    <a href="{{ auth()->check() ? route('em-progresso-2') : '#' }}" class="btn-custom inline-block text-center {{ auth()->check() ? '' : 'require-auth' }}">EM PROGRESSO</a>
</div>

    </main>

    @guest
        <div id="auth-overlay" class="auth-overlay auth-hidden">
            <div class="auth-card bg-gray-900 border border-gray-700 rounded-xl p-6 relative">
                <button id="close-auth-overlay" type="button" class="absolute right-3 top-2 text-gray-300 hover:text-white text-2xl leading-none" data-guest-allowed="true" aria-label="Fechar popup">&times;</button>
                <h2 class="auth-title text-2xl font-bold text-white text-center mb-2">Acesso necessário</h2>
                <p class="auth-subtitle text-gray-300 text-center mb-6">Faça login ou cadastre-se.</p>

                @if($errors->any())
                    <div class="mb-4 rounded border border-red-500 bg-red-500/10 px-3 py-2 text-sm text-red-300">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('password_reset_status'))
                    <div class="mb-4 rounded border border-green-500 bg-green-500/10 px-3 py-2 text-sm text-green-300">
                        {{ session('password_reset_status') }}
                    </div>
                @endif

                <div class="mb-4 flex justify-center gap-3">
                    <button id="tab-login" type="button" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded font-semibold transition">LOGIN</button>
                    <button id="tab-register" type="button" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded font-semibold transition">CADASTRAR</button>
                </div>

                <form id="login-form" action="{{ route('auth.login') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Email, CPF ou Telefone</label>
                        <input type="text" name="identificador" value="{{ old('identificador') }}" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Senha</label>
                        <input type="password" name="password" minlength="8" pattern="^[A-Za-z0-9@]+$" title="Use 8 ou mais caracteres, apenas letras, números e @" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="text-right">
                        <button id="show-forgot-password" type="button" class="text-sm text-blue-300 hover:text-blue-200" data-guest-allowed="true">Esqueceu a senha?</button>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded font-semibold transition">Entrar</button>
                </form>

                <form id="register-form" action="{{ route('auth.register') }}" method="POST" class="space-y-3 auth-hidden">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Nome</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Sobrenome</label>
                            <input type="text" name="surname" value="{{ old('surname') }}" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">CPF</label>
                            <input id="register-cpf" type="text" name="cpf" value="{{ old('cpf') }}" placeholder="000.000.000-00" pattern="^\d{3}\.\d{3}\.\d{3}-\d{2}$" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Telefone</label>
                            <input id="register-phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="(11) 912345678" pattern="^\([1-9][0-9]\)\s?9[0-9]{8}$" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" pattern="^[^\s@]+@(gmail|outlook|hotmail)\.[^\s@]+$" title="Use apenas email gmail, outlook ou hotmail" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Confirmar Email</label>
                            <input type="email" name="email_confirmation" value="{{ old('email_confirmation') }}" pattern="^[^\s@]+@(gmail|outlook|hotmail)\.[^\s@]+$" title="Use apenas email gmail, outlook ou hotmail" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Senha</label>
                        <input type="password" name="password" minlength="8" pattern="^[A-Za-z0-9@]+$" title="Use 8 ou mais caracteres, apenas letras, números e @" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Confirmar Senha</label>
                            <input type="password" name="password_confirmation" minlength="8" pattern="^[A-Za-z0-9@]+$" title="Use 8 ou mais caracteres, apenas letras, números e @" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    <div class="flex items-start gap-2 rounded border border-gray-700 bg-gray-800/60 px-3 py-2">
                        <input id="privacy-policy-accepted" type="checkbox" name="privacy_policy_accepted" value="1" class="mt-1 h-4 w-4 rounded border-gray-600 bg-gray-900 text-blue-500 focus:ring-blue-500" {{ old('privacy_policy_accepted') ? 'checked' : '' }} required>
                        <label for="privacy-policy-accepted" class="text-sm text-gray-200 leading-5">
                            Li e concordo com a <a href="{{ route('politica.privacidade') }}" target="_blank" class="text-blue-300 hover:text-blue-200" style="text-decoration: none !important;">Política de Privacidade</a>.
                        </label>
                    </div>
                    <button id="register-submit" type="submit" class="w-full bg-green-600 hover:bg-green-500 disabled:hover:bg-green-600 disabled:opacity-50 disabled:cursor-not-allowed text-white px-4 py-2 rounded font-semibold transition" {{ old('privacy_policy_accepted') ? '' : 'disabled' }}>Criar conta</button>
                </form>
            </div>
        </div>

        <div id="forgot-overlay" class="auth-overlay auth-hidden" data-guest-allowed="true">
            <div class="auth-card bg-gray-900 border border-gray-700 rounded-xl p-6 relative" data-guest-allowed="true">
                @php
                    $forgotStage = 'send_code';
                    if (session()->has('password_reset_verified_user_id')) {
                        $forgotStage = 'update_password';
                    } elseif (session('password_code_status') || $errors->has('reset_code')) {
                        $forgotStage = 'verify_code';
                    }
                @endphp

                <button id="close-forgot-overlay" type="button" class="absolute right-3 top-2 text-gray-300 hover:text-white text-2xl leading-none" data-guest-allowed="true" aria-label="Fechar popup">&times;</button>
                <h2 class="auth-title text-2xl font-bold text-white text-center mb-2">Recuperar senha</h2>
                <p class="auth-subtitle text-gray-300 text-center mb-6">
                    @if($forgotStage === 'send_code')
                        Informe seu CPF
                    @elseif($forgotStage === 'verify_code')
                        Informe o código
                    @else
                        Informe a nova senha
                    @endif
                </p>

                @if(session('password_code_status'))
                    <div class="mb-4 rounded border border-green-500 bg-green-500/10 px-3 py-2 text-sm text-green-300">
                        {{ session('password_code_status') }}
                    </div>
                @endif

                @if(session('password_code_debug'))
                    <div class="mb-4 rounded border border-yellow-500 bg-yellow-500/10 px-3 py-2 text-sm text-yellow-300">
                        Código de teste: {{ session('password_code_debug') }}
                    </div>
                @endif

                @if(session('password_code_verified_status'))
                    <div class="mb-4 rounded border border-green-500 bg-green-500/10 px-3 py-2 text-sm text-green-300">
                        {{ session('password_code_verified_status') }}
                    </div>
                @endif

                @if($errors->has('reset_cpf'))
                    <div class="mb-4 rounded border border-red-500 bg-red-500/10 px-3 py-2 text-sm text-red-300">
                        {{ $errors->first('reset_cpf') }}
                    </div>
                @endif

                @if($errors->has('reset_code'))
                    <div class="mb-4 rounded border border-red-500 bg-red-500/10 px-3 py-2 text-sm text-red-300">
                        {{ $errors->first('reset_code') }}
                    </div>
                @endif

                @if($errors->has('new_password'))
                    <div class="mb-4 rounded border border-red-500 bg-red-500/10 px-3 py-2 text-sm text-red-300">
                        {{ $errors->first('new_password') }}
                    </div>
                @endif

                @if($forgotStage === 'send_code')
                    <form action="{{ route('auth.password.send-code') }}" method="POST" class="space-y-3" data-guest-allowed="true">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">CPF</label>
                            <input id="reset-cpf" type="text" name="reset_cpf" value="{{ old('reset_cpf') }}" placeholder="000.000.000-00" pattern="^\d{3}\.\d{3}\.\d{3}-\d{2}$" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded font-semibold transition">Enviar código</button>
                    </form>
                @elseif($forgotStage === 'verify_code')
                    <form action="{{ route('auth.password.verify-code') }}" method="POST" class="space-y-3" data-guest-allowed="true">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Código de 6 dígitos</label>
                            <input type="text" name="reset_code" value="{{ old('reset_code') }}" inputmode="numeric" pattern="^\d{6}$" maxlength="6" placeholder="000000" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded font-semibold transition">Confirmar código</button>
                    </form>
                @elseif($forgotStage === 'update_password')
                    <form action="{{ route('auth.password.update-after-code') }}" method="POST" class="space-y-3 mt-4" data-guest-allowed="true">
                        @csrf
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Nova senha</label>
                            <input type="password" name="new_password" minlength="8" pattern="^[A-Za-z0-9@]+$" title="Use 8 ou mais caracteres, apenas letras, números e @" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Confirmar nova senha</label>
                            <input type="password" name="new_password_confirmation" minlength="8" pattern="^[A-Za-z0-9@]+$" title="Use 8 ou mais caracteres, apenas letras, números e @" class="w-full rounded border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded font-semibold transition">Trocar senha</button>
                    </form>
                @endif
            </div>
        </div>
    @endguest

    <!-- Footer -->
    <footer class="bg-black-900 text-white mt-8 py-4">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-xs">
                &copy; {{ date('Y') }} Calc Machining. Todos os direitos reservados.
            </p>
            <p class="text-xs mt-2">
                <a href="{{ route('termos.uso') }}" style="text-decoration: none !important;">Termos de Uso</a>
                &nbsp;|&nbsp;
                <a href="{{ route('politica.privacidade') }}" style="text-decoration: none !important;">Política de Privacidade</a>
            </p>
        </div>
    </footer>

    @guest
        <script>
            (() => {
                const loginForm = document.getElementById('login-form');
                const registerForm = document.getElementById('register-form');
                const tabLogin = document.getElementById('tab-login');
                const tabRegister = document.getElementById('tab-register');
                const openLogin = document.getElementById('show-login');
                const openRegister = document.getElementById('show-register');
                const authOverlay = document.getElementById('auth-overlay');
                const forgotOverlay = document.getElementById('forgot-overlay');
                const closeAuthOverlay = document.getElementById('close-auth-overlay');
                const closeForgotOverlay = document.getElementById('close-forgot-overlay');
                const openForgotPassword = document.getElementById('show-forgot-password');
                const gatedLinks = document.querySelectorAll('.require-auth');
                const registerCpf = document.getElementById('register-cpf');
                const registerPhone = document.getElementById('register-phone');
                const privacyPolicyAccepted = document.getElementById('privacy-policy-accepted');
                const registerSubmit = document.getElementById('register-submit');
                const resetCpf = document.getElementById('reset-cpf');
                const resetCpfConfirm = document.getElementById('reset-cpf-confirm');
                const hasRegisterOldValues = {!! json_encode(old('name') || old('surname') || old('cpf') || old('phone') || old('email')) !!};
                const hasForgotOldValues = {!! json_encode(old('reset_cpf') || old('reset_code') || $errors->has('reset_cpf') || $errors->has('reset_code') || $errors->has('new_password') || session()->has('password_code_status') || session()->has('password_code_verified_status') || session()->has('password_reset_verified_user_id')) !!};
                const authQuery = {!! json_encode(request()->query('auth')) !!};

                const updateRegisterSubmitState = () => {
                    if (!privacyPolicyAccepted || !registerSubmit) {
                        return;
                    }

                    registerSubmit.disabled = !privacyPolicyAccepted.checked;
                };

                const openOverlay = () => {
                    authOverlay?.classList.remove('auth-hidden');
                };

                const openForgot = () => {
                    forgotOverlay?.classList.remove('auth-hidden');
                };

                const closeOverlay = () => {
                    authOverlay?.classList.add('auth-hidden');
                };

                const closeForgot = () => {
                    forgotOverlay?.classList.add('auth-hidden');
                };

                const showLogin = () => {
                    loginForm.classList.remove('auth-hidden');
                    registerForm.classList.add('auth-hidden');
                    tabLogin.classList.remove('bg-gray-700');
                    tabLogin.classList.add('bg-blue-600', 'hover:bg-blue-500');
                    tabRegister.classList.remove('bg-green-600', 'hover:bg-green-500');
                    tabRegister.classList.add('bg-gray-700', 'hover:bg-gray-600');
                };

                const showRegister = () => {
                    registerForm.classList.remove('auth-hidden');
                    loginForm.classList.add('auth-hidden');
                    tabRegister.classList.remove('bg-gray-700');
                    tabRegister.classList.add('bg-green-600', 'hover:bg-green-500');
                    tabLogin.classList.remove('bg-blue-600', 'hover:bg-blue-500');
                    tabLogin.classList.add('bg-gray-700', 'hover:bg-gray-600');
                };

                tabLogin?.addEventListener('click', showLogin);
                tabRegister?.addEventListener('click', showRegister);
                openLogin?.addEventListener('click', () => {
                    openOverlay();
                    showLogin();
                });
                openRegister?.addEventListener('click', () => {
                    openOverlay();
                    showRegister();
                });
                closeAuthOverlay?.addEventListener('click', closeOverlay);
                openForgotPassword?.addEventListener('click', () => {
                    closeOverlay();
                    openForgot();
                });
                closeForgotOverlay?.addEventListener('click', closeForgot);
                privacyPolicyAccepted?.addEventListener('change', updateRegisterSubmitState);
                updateRegisterSubmitState();

                gatedLinks.forEach((link) => {
                    link.addEventListener('click', (event) => {
                        event.preventDefault();
                        openOverlay();
                        showLogin();
                    });
                });

                document.addEventListener('click', (event) => {
                    const target = event.target;
                    const allowedByData = target.closest('[data-guest-allowed="true"]');
                    const insideOverlay = authOverlay && authOverlay.contains(target);
                    const insideForgot = forgotOverlay && forgotOverlay.contains(target);

                    if (allowedByData || insideOverlay || insideForgot) {
                        return;
                    }

                    const blockedElement = target.closest('a, button, summary, [role="button"]');
                    if (!blockedElement) {
                        return;
                    }

                    event.preventDefault();
                    event.stopPropagation();
                    openOverlay();
                    showLogin();
                }, true);

                registerPhone?.addEventListener('input', (event) => {
                    const input = event.target;
                    let digits = input.value.replace(/\D/g, '').slice(0, 11);

                    if (digits.length > 0 && digits[0] === '0') {
                        digits = digits.slice(1);
                    }

                    const ddd = digits.slice(0, 2);
                    const number = digits.slice(2, 11);
                    let formatted = '';

                    if (ddd.length) {
                        formatted = `(${ddd}`;
                    }

                    if (ddd.length === 2) {
                        formatted += ')';
                    }

                    if (number.length) {
                        formatted += ` ${number}`;
                    }

                    input.value = formatted;
                });

                registerCpf?.addEventListener('input', (event) => {
                    const input = event.target;
                    const digits = input.value.replace(/\D/g, '').slice(0, 11);
                    let formatted = digits;

                    if (digits.length > 3) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3)}`;
                    }
                    if (digits.length > 6) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6)}`;
                    }
                    if (digits.length > 9) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6, 9)}-${digits.slice(9)}`;
                    }

                    input.value = formatted;
                });

                resetCpf?.addEventListener('input', (event) => {
                    const input = event.target;
                    const digits = input.value.replace(/\D/g, '').slice(0, 11);
                    let formatted = digits;

                    if (digits.length > 3) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3)}`;
                    }
                    if (digits.length > 6) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6)}`;
                    }
                    if (digits.length > 9) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6, 9)}-${digits.slice(9)}`;
                    }

                    input.value = formatted;
                });

                resetCpfConfirm?.addEventListener('input', (event) => {
                    const input = event.target;
                    const digits = input.value.replace(/\D/g, '').slice(0, 11);
                    let formatted = digits;

                    if (digits.length > 3) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3)}`;
                    }
                    if (digits.length > 6) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6)}`;
                    }
                    if (digits.length > 9) {
                        formatted = `${digits.slice(0, 3)}.${digits.slice(3, 6)}.${digits.slice(6, 9)}-${digits.slice(9)}`;
                    }

                    input.value = formatted;
                });

                if (hasForgotOldValues || authQuery === 'forgot') {
                    openForgot();
                } else if (hasRegisterOldValues || authQuery === 'register') {
                    openOverlay();
                    showRegister();
                } else if (authQuery === 'login') {
                    openOverlay();
                    showLogin();
                }
            })();
        </script>
    @endguest
</body>
</html>
