<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Conta - Dados</title>
	@vite(['resources/css/app.css','resources/js/app.js','resources/js/theme-toggle.js'])
</head>
<body class="bg-black text-white min-h-screen">
	<header class="bg-black z-40">
		<div class="w-full bg-white flex items-center justify-center relative" style="height: 180px;">
			<span class="text-black font-bold text-xl absolute left-8 top-4">Calcmachining.com</span>
			<a href="{{ url('/') }}">
				<img src="/logo.png" alt="Logo" class="object-contain" style="height: 160px;">
			</a>
			<div class="absolute right-8 flex gap-4 items-center top-4">
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
			</div>
		</div>
	</header>

	<main class="max-w-4xl mx-auto px-4 py-12">
		<h1 class="text-3xl font-bold mb-8">Dados da Conta</h1>
		<div class="bg-white/5 rounded-lg p-6 space-y-3">
			<p><strong>Nome:</strong> {{ $user->name }}</p>
			<p><strong>Sobrenome:</strong> {{ $user->surname }}</p>
			<p><strong>CPF:</strong> {{ $user->cpf }}</p>
			<p><strong>Telefone:</strong> {{ $user->phone }}</p>
			<p><strong>Email:</strong> {{ $user->email }}</p>
		</div>
	</main>
</body>
</html>
