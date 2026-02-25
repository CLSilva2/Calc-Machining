<!DOCTYPE html>
<html lang="pt-BR" style="background-color: #000000;">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Engrenagens - Calc Machining</title>
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
		html.light-mode .engrenagens-content,
		html.light-mode .engrenagens-content * {
			color: #000000 !important;
		}
		html.light-mode .engrenagens-content input::placeholder {
			color: #000000 !important;
			opacity: 1;
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

		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		input[type=number] {
			-moz-appearance: textfield;
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
				<a href="{{ url('/sobre') }}" class="text-black font-bold text-lg hover:text-gray-600 transition" style="text-decoration: none;">SOBRE</a>
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
					<a href="{{ route('home', ['auth' => 'login']) }}" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition">LOGIN</a>
					<a href="{{ route('home', ['auth' => 'register']) }}" class="bg-black text-white px-3 py-0.5 rounded text-xs font-semibold hover:bg-gray-800 transition">CADASTRE-SE</a>
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

	<main class="engrenagens-content max-w-7xl mx-auto px-4 py-12">
		<div class="text-center mb-10">
			<h1 class="text-5xl md:text-6xl font-bold text-white mb-4" style="font-family: 'Roboto', sans-serif;">
				ENGRENAGENS
			</h1>
			<p class="text-xl text-gray-300" style="font-family: 'Roboto', sans-serif;">
				ESCOLHA QUAIS ENGRENAGENS IRÁ USAR PARA OS CÁLCULOS
                <br>
			</p>
		</div>

		<div class="max-w-6xl mx-auto bg-white/5 p-6 rounded-lg shadow-md">
			@php
				$configuracaoSalva = session('engrenagens_configuracao', 'minmax');
				$engrenagemMinSalva = session('engrenagens_min', 18);
				$engrenagemMaxSalva = session('engrenagens_max', 127);
				$engrenagensSelecionadasSalvas = session('engrenagens_selecionadas', []);
			@endphp
			<form id="engrenagens-config-form" class="space-y-6" action="{{ route('engrenagens.save') }}" method="POST">
				@csrf
				@if(session('status'))
					<div class="text-green-400 text-center font-semibold">{{ session('status') }}</div>
				@endif
				@if($errors->any())
					<div class="text-red-400 text-center font-semibold">{{ $errors->first() }}</div>
				@endif
				<div>
					<p class="text-lg text-gray-200 mb-3 text-center font-semibold">Qual configuração você quer usar?</p>
					<div class="flex flex-wrap gap-4 justify-center">
						<label class="inline-flex items-center gap-2 text-lg text-gray-200">
							<input type="radio" name="configuracao" value="minmax" {{ $configuracaoSalva === 'minmax' ? 'checked' : '' }}>
							<span>Min - Max</span>
						</label>
						<label class="inline-flex items-center gap-2 text-lg text-gray-200">
							<input type="radio" name="configuracao" value="selecionada" {{ $configuracaoSalva === 'selecionada' ? 'checked' : '' }}>
							<span>Selecionar</span>
						</label>
					</div>
				</div>

				<div id="minmax-section" class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<div>
						<label for="engrenagem_min" class="block text-base font-medium text-gray-200">Engrenagem mínima</label>
						<input id="engrenagem_min" name="engrenagem_min" type="number" min="18" max="127" class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 18" value="{{ old('engrenagem_min', $engrenagemMinSalva) }}">
					</div>
					<div>
						<label for="engrenagem_max" class="block text-base font-medium text-gray-200">Engrenagem máxima</label>
						<input id="engrenagem_max" name="engrenagem_max" type="number" min="18" max="127" class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 127" value="{{ old('engrenagem_max', $engrenagemMaxSalva) }}">
					</div>
				</div>

				<div id="selecionada-section" class="hidden">
					<p class="text-lg text-gray-200 mb-3 text-center font-semibold">Selecione suas engrenagens:</p>
					@php
						$numerosEngrenagens = range(18, 127);
					@endphp
					<div class="bg-black/20 rounded p-3 grid grid-cols-4 gap-3">
						@foreach($numerosEngrenagens as $numero)
							<label class="flex items-center gap-3 text-xl text-gray-200 rounded px-2 py-1">
								<input type="checkbox" name="engrenagens[]" value="{{ $numero }}" class="w-6 h-6" {{ in_array($numero, old('engrenagens', $engrenagensSelecionadasSalvas), true) ? 'checked' : '' }}>
								<span>{{ $numero }}</span>
							</label>
						@endforeach
					</div>
					<div class="mt-4 flex justify-center">
						<button type="button" id="limpar-selecao" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold text-base px-6 py-2 rounded transition">
							Limpar
						</button>
					</div>
				</div>

				<div class="pt-2 flex justify-center">
					<button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-semibold text-lg px-8 py-2 rounded transition" style="color:#ffffff !important;">
						Salvar
					</button>
				</div>
			</form>
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

	<script>
		(function () {
			const radios = document.querySelectorAll('input[name="configuracao"]');
			const minMaxSection = document.getElementById('minmax-section');
			const selecionadaSection = document.getElementById('selecionada-section');
			const limparSelecaoButton = document.getElementById('limpar-selecao');

			const toggleSections = () => {
				const selected = document.querySelector('input[name="configuracao"]:checked')?.value;
				if (selected === 'selecionada') {
					minMaxSection.classList.add('hidden');
					selecionadaSection.classList.remove('hidden');
					return;
				}

				minMaxSection.classList.remove('hidden');
				selecionadaSection.classList.add('hidden');
			};

			radios.forEach((radio) => radio.addEventListener('change', toggleSections));
			if (limparSelecaoButton) {
				limparSelecaoButton.addEventListener('click', () => {
					const checkboxes = selecionadaSection.querySelectorAll('input[type="checkbox"][name="engrenagens[]"]');
					checkboxes.forEach((checkbox) => {
						checkbox.checked = false;
					});
				});
			}
			toggleSections();
		})();
	</script>
</body>
</html>
