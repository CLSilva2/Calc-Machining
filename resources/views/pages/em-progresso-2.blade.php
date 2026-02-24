<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Em Progresso - Calc Machining</title>
	@vite(['resources/css/app.css','resources/js/app.js','resources/js/theme-toggle.js'])
	<style>
		/* Pequeno ajuste local caso necessário */
		.page-content { padding: 2rem; }

		/* Remove as setas dos inputs number */
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}
		input[type=number] {
			-moz-appearance: textfield;
		}

		/* Remove linha/borda do header */
		header, header > div {
			border: none !important;
			box-shadow: none !important;
		}

		/* Remove sublinhado dos botões LOGIN e CADASTRE-SE */
		header a {
			text-decoration: none !important;
		}

		/* Modo claro - quando a lua estiver visível */
		html.light-mode body {
			background-color: white !important;
			color: black !important;
		}

		html.light-mode footer {
			background-color: white !important;
			color: black !important;
		}

		html.light-mode h1,
		html.light-mode p,
		html.light-mode label {
			color: black !important;
		}

		html.light-mode .text-white:not(header a) {
			color: black !important;
		}

		html.light-mode header a {
			color: white !important;
		}

		html.light-mode header .flex.gap-6 a,
		html.light-mode header .flex.gap-12 a {
			color: black !important;
		}

		html.light-mode .text-gray-300 {
			color: #4b5563 !important;
		}

		html.light-mode .text-gray-200 {
			color: #6b7280 !important;
		}

		html.light-mode header a {
			color: white !important;
		}

		html.light-mode input {
			background-color: #f3f4f6 !important;
			color: black !important;
			border-color: #000000 !important;
		}

		html.light-mode .text-yellow-400 {
			color: #166534 !important;
		}

		html.light-mode .bg-white\/5,
		html.light-mode .bg-white\/10 {
			background-color: #dbdddf !important;
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
<body class="bg-black text-white min-h-screen">
	<!-- White banner (mantido igual ao welcome) -->
	<header class="bg-black z-40">
		<div class="w-full bg-white flex flex-col items-center justify-center relative" style="height: 180px;">
			<span class="text-black font-bold text-xl absolute left-8 top-4">Calcmachining.com</span>

			<!-- Logo centralizada -->
			<a href="{{ url('/') }}" class="flex items-center justify-center">
				<img src="/logo.png" alt="Logo" class="object-contain" style="height: 120px;">
			</a>

			<!-- Menu abaixo da logo centralizado -->
			<div class="flex gap-6 mt-3 items-center justify-center flex-wrap">
				<a href="{{ url('/') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">INCIO</a>
				<a href="{{ route('medidaw.reto') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">MEDIDA W RETO</a>
				<a href="{{ route('medidaw.helicoidal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">MEDIDA W HELICOIDAL</a>
				<a href="{{ route('helicoidal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">ENGRENAGEM HELICOIDAL</a>
				<a href="{{ route('kit.com-passo') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">KIT ENGRENAGEM COM PASSO</a>
				<a href="{{ route('medida.cordal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">EM PROGRESSO</a>
				<a href="{{ route('sobre') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">SOBRE</a>
			</div>
			<div class="absolute right-8 flex gap-4 items-center top-4">
				<a href="#" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition">LOGIN</a>
				<a href="#" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition">CADASTRE-SE</a>
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
	</header>

	<main class="page-content max-w-7xl mx-auto px-4 py-12">
		<h1 class="text-2xl font-bold mb-6 text-white text-center" style="font-family: 'Roboto', sans-serif;">EM PROGRESSO</h1>
		<div class="max-w-4xl mx-auto">
			<p class="text-gray-300 mb-4 text-center" style="font-family: 'Roboto', sans-serif;">Página em progresso.</p>
		</div>
	</main>

	<footer class="bg-black text-white mt-8 py-4">
		<div class="max-w-7xl mx-auto px-4 text-center">
			<p class="text-xs">&copy; {{ date('Y') }} Calc Machining. Todos os direitos reservados.</p>
		</div>
	</footer>
</body>
</html>
