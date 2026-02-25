<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Conta - Histórico de Cálculos</title>
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

	<main class="max-w-5xl mx-auto px-4 py-12">
		<h1 class="text-3xl font-bold mb-8">Histórico de Cálculos</h1>
		@if($histories->isEmpty())
			<p class="text-gray-300">Nenhum cálculo registrado ainda.</p>
		@else
			<div class="space-y-3">
				@foreach($histories as $item)
					<div class="bg-white/5 rounded-lg p-4">
						<p><strong>Tipo:</strong> {{ $item->calculation_type }}</p>
						<p><strong>Data:</strong> {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</p>
					</div>
				@endforeach
			</div>
		@endif
	</main>
</body>
</html>
