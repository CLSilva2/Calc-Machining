<!DOCTYPE html>
<html lang="pt-BR" style="background-color: #000000;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Política de Privacidade - Calc Machining</title>
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
		html.light-mode h6,
		html.light-mode p {
			color: #000000 !important;
		}
		html.light-mode .privacy-content,
		html.light-mode .privacy-content * {
			color: #000000 !important;
		}
		html.light-mode footer {
			background-color: #ffffff !important;
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
	</style>
</head>
<body class="bg-black text-white min-h-screen" id="main-body">
	<input type="checkbox" id="menu-toggle" class="hidden peer">

	<header class="bg-black shadow-sm z-40">
		<div class="w-full bg-white flex flex-col items-center justify-center relative" style="height: 180px;">
			<span class="text-black font-bold text-xl absolute left-8 top-4">Calcmachining.com</span>
			<a href="{{ url('/') }}" class="flex items-center justify-center">
				<img src="/logo.png" alt="Logo" class="object-contain" style="height: 120px;">
			</a>
			<div class="flex gap-12 mt-3 items-center justify-center">
				<a href="{{ url('/') }}" class="text-black font-bold text-lg hover:text-gray-600 transition" style="text-decoration: none;">INICIO</a>
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
					<a href="{{ route('home', ['auth' => 'login']) }}" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition" style="text-decoration: none !important;">LOGIN</a>
					<a href="{{ route('home', ['auth' => 'register']) }}" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition" style="text-decoration: none !important;">CADASTRE-SE</a>
				@endif
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
			<div class="flex-shrink-0"></div>
			<div class="hidden md:flex items-center gap-6"></div>
			<label for="menu-toggle" class="md:hidden cursor-pointer flex flex-col gap-1.5">
				<span class="w-6 h-0.5 bg-white transition transform peer-checked:rotate-45 peer-checked:translate-y-2"></span>
				<span class="w-6 h-0.5 bg-white transition opacity-0 peer-checked:opacity-0"></span>
				<span class="w-6 h-0.5 bg-white transition transform peer-checked:-rotate-45 peer-checked:-translate-y-2"></span>
			</label>
		</nav>

		<div class="md:hidden max-h-0 peer-checked:max-h-64 overflow-hidden transition-all duration-300">
			<div class="px-4 py-4 space-y-3 bg-gray-900"></div>
		</div>
	</header>

	<main class="max-w-7xl mx-auto px-4 py-12">
		<div class="privacy-content max-w-4xl mx-auto text-gray-300 text-sm leading-relaxed space-y-5">
			<h1 class="text-xs font-bold text-white text-center mt-2">POLÍTICA DE PRIVACIDADE</h1>
			<br>
			<p><strong>Última atualização:</strong> 24/02/2026</p>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">1. QUEM SOMOS</h2>
				<br>
				<p>Somos uma plataforma digital de cálculos automatizados para usinagem em máquinas como torno, fresa, retífica e centros de usinagem CNC.</p>
				<p><strong>Responsável pelo tratamento de dados:</strong> Calc Machining<br><strong>Email para contato:</strong> contato@calcmachining.com.br</p>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">2. QUAIS DADOS COLETAMOS</h2>
				<br>
				<p>Coletamos os seguintes dados pessoais:</p>
				<ul class="list-disc list-inside space-y-1">
					<li>Nome</li>
					<li>CPF</li>
					<li>Email</li>
					<li>Telefone</li>
					<li>Dados de login</li>
					<li>Informações de uso da plataforma</li>
				</ul>
				<p>Não armazenamos dados de cartão de crédito.</p>
				<p>Pagamentos são processados por plataforma externa segura (Stripe).</p>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">3. FINALIDADE DA COLETA</h2>
				<br>
				<p>Utilizamos os dados para:</p>
				<ul class="list-disc list-inside space-y-1">
					<li>Criar e gerenciar contas</li>
					<li>Processar pagamentos</li>
					<li>Emitir notas fiscais (quando aplicável)</li>
					<li>Melhorar funcionalidades do sistema</li>
					<li>Enviar comunicações relacionadas ao serviço</li>
				</ul>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">4. COMPARTILHAMENTO DE DADOS</h2>
				<br>
				<p>Os dados podem ser compartilhados com:</p>
				<ul class="list-disc list-inside space-y-1">
					<li>Stripe (processamento de pagamento)</li>
					<li>Serviços de hospedagem (Hostinger)</li>
					<li>Serviços de email</li>
				</ul>
				<p>Não vendemos dados pessoais.</p>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">5. ARMAZENAMENTO E SEGURANÇA</h2>
				<br>
				<p>Adotamos medidas técnicas como:</p>
				<ul class="list-disc list-inside space-y-1">
					<li>Criptografia de senha</li>
					<li>Acesso restrito ao banco de dados</li>
					<li>Conexão HTTPS (SSL)</li>
					<li>Controle de acesso administrativo</li>
				</ul>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">6. DIREITOS DO TITULAR</h2>
				<br>
				<p>O usuário pode:</p>
				<ul class="list-disc list-inside space-y-1">
					<li>Solicitar cópia dos dados</li>
					<li>Corrigir dados</li>
					<li>Solicitar exclusão da conta</li>
					<li>Revogar consentimento</li>
				</ul>
				<p>Solicitações devem ser feitas atraves da plataforma.</p>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">7. EXCLUSÃO DE DADOS</h2>
				<br>
				<p>Ao solicitar exclusão:</p>
				<ul class="list-disc list-inside space-y-1">
					<li>A conta será desativada</li>
					<li>Dados poderão ser mantidos apenas quando exigido por lei</li>
				</ul>
			</div>

			<div class="space-y-2">
				<br>
				<h2 class="text-xs font-bold text-white" style="font-size:14px;">8. ALTERAÇÕES</h2>
				<br>
				<p>Esta política pode ser atualizada a qualquer momento.</p>
			</div>
		</div>
	</main>

	<footer class="bg-black-900 text-white mt-8 py-4">
		<div class="max-w-7xl mx-auto px-4 text-center">
			<p class="text-xs">&copy; {{ date('Y') }} Calc Machining. Todos os direitos reservados.</p>
			<p class="text-xs mt-2">
				<a href="{{ route('termos.uso') }}" style="text-decoration: none !important;">Termos de Uso</a>
				&nbsp;|&nbsp;
				<a href="{{ route('politica.privacidade') }}" style="text-decoration: none !important;">Política de Privacidade</a>
			</p>
		</div>
	</footer>
</body>
</html>
