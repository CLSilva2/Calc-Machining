<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Engrenagem Helicoidal</title>
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

		html.light-mode header .flex.gap-6 a {
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
				<a href="{{ route('kit.com-passo') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">KIT ENGRENAGEM COM PASSO</a>
				<a href="{{ route('medida.cordal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">EM PROGRESSO</a>
				<a href="{{ route('em-progresso-2') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">EM PROGRESSO</a>
				<a href="{{ route('sobre') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">SOBRE</a>
			</div>
			
			<div class="absolute right-8 flex gap-4 items-center top-4">
				<a href="#" class="bg-black text-white px-6 py-2 rounded font-semibold hover:bg-gray-800 transition">LOGIN</a>
				<a href="#" class="bg-black text-white px-6 py-2 rounded font-semibold hover:bg-gray-800 transition">CADASTRE-SE</a>
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
		<h1 class="text-2xl font-bold mb-6 text-white text-center" style="font-family: 'Roboto', sans-serif;">ENGRENAGEM HELICOIDAL	</h1>
		<p class="text-gray-300 text-center mb-6" style="font-family: 'Roboto', sans-serif;">Cálculo de Engrenagem Helicoidal para achar kit de engrenagens.</p>

		<div class="max-w-md mx-auto bg-white/5 p-6 rounded-lg shadow-md">
			<form id="helicoidal-form" action="{{ route('helicoidal') }}" method="GET" class="space-y-4">
				@csrf
				<div>
					<label for="modulo" class="block text-sm font-medium text-gray-200">Módulo</label>
					<input id="modulo" name="modulo" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 2" value="{{ request()->input('modulo') }}">
				</div>

				<div>
					<label for="numero_dentes" class="block text-sm font-medium text-gray-200">Número de dentes</label>
					<input id="numero_dentes" name="numero_dentes" type="number" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 35" value="{{ request()->input('numero_dentes') }}">
				</div>

				<div>
					<label for="angulo" class="block text-sm font-medium text-gray-200">Ângulo</label>
					<input id="angulo" name="angulo" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 20" value="{{ request()->input('angulo') }}">
				</div>

				<div>
					<label for="divisor" class="block text-sm font-medium text-gray-200">Divisor</label>
					<input id="divisor" name="divisor" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 40" value="{{ request()->input('divisor') }}">
				</div>

                <div>
					<label for="fuso" class="block text-sm font-medium text-gray-200">Fuso</label>
					<input id="fuso" name="fuso" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 5" value="{{ request()->input('fuso') }}">
				</div>

				<div class="text-center mt-4">
					<button type="submit" class="btn-custom">Calcular</button>
				</div>
			</form>
		</div>

		
		@if(request()->hasAny(['modulo', 'numero_dentes', 'angulo', 'divisor', 'fuso']))
			@php
				$engrenagens = [24, 26, 27, 28, 29, 30, 31, 32, 33, 34, 36, 40, 44, 48, 52, 56, 60, 64, 72, 80, 88, 100, 127];
				$pi = round(pi(), 4);

				$modulo = request()->input('modulo');
				$angulo_graus = request()->input('angulo');
				$dentes = request()->input('numero_dentes');
				$divisor = request()->input('divisor');
				$fuso = request()->input('fuso');

				$calcs = [];
				$melhores = [];

				if (is_numeric($modulo) && is_numeric($angulo_graus) && is_numeric($dentes) && is_numeric($divisor) && is_numeric($fuso)
					&& floatval($divisor) > 0 && floatval($fuso) > 0) {
					$angulo_radianos = floatval($angulo_graus) * pi() / 180;
					$cosseno = round(cos($angulo_radianos), 5);
					$tangente = round(tan($angulo_radianos), 5);

					if ($cosseno != 0.0 && $tangente != 0.0) {
						$quant_avanco = floatval($divisor) * floatval($fuso);
						$calculo_um = floatval($modulo) / $cosseno;
						$calculo_dois = $calculo_um * floatval($dentes);
						$calculo_tres = $calculo_dois * $pi / $tangente;
						$passo = $calculo_tres / $quant_avanco;

						$targetRatio = $passo;
						$tolerance = 0.001;
						$validCombinations = [];

						foreach ($engrenagens as $A) {
							foreach ($engrenagens as $B) {
								foreach ($engrenagens as $C) {
									foreach ($engrenagens as $D) {
										$ratio = ($A * $C) / ($B * $D);
										$error = abs($ratio - $targetRatio);

										if ($error <= $tolerance) {
											$validCombinations[] = [
												'A' => $A,
												'B' => $B,
												'C' => $C,
												'D' => $D,
												'Error' => $error,
											];
										}
									}
								}
							}
						}

						usort($validCombinations, function ($a, $b) {
							return $a['Error'] <=> $b['Error'];
						});

						$melhores = array_slice($validCombinations, 0, 10);

						$calcs['pi'] = $pi;
						$calcs['angulo_graus'] = floatval($angulo_graus);
						$calcs['angulo_radianos'] = $angulo_radianos;
						$calcs['cosseno'] = $cosseno;
						$calcs['tangente'] = $tangente;
						$calcs['quant_avanco'] = $quant_avanco;
						$calcs['calculo_um'] = $calculo_um;
						$calcs['calculo_dois'] = $calculo_dois;
						$calcs['calculo_tres'] = $calculo_tres;
						$calcs['passo'] = $passo;
						$calcs['melhores'] = $melhores;
					}
				}
			
			@endphp

		<div class="mt-6 max-w-4xl mx-auto bg-white/5 p-6 rounded-lg">
			<h3 class="text-lg font-semibold text-white text-center mb-6">Resultado</h3>
			
			@if(isset($calcs['passo']))
				<div class="text-center mb-6 pb-6 border-b border-gray-600">
					<p class="text-sm text-gray-300 mb-2">Passo Calculado (mm):</p>
					<div class="text-4xl font-bold text-yellow-400">{{ number_format($calcs['passo'], 5) }}</div>
				</div>
			@endif

			@if(isset($calcs['angulo_radianos']))
				<div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 pb-6 border-b border-gray-600 text-center">
					<div>
						<p class="text-sm text-gray-300 mb-1">Ângulo (graus):</p>
						<p class="text-lg font-semibold text-white">{{ number_format($calcs['angulo_graus'], 5) }}</p>
					</div>
					<div>
						<p class="text-sm text-gray-300 mb-1">Ângulo (rad):</p>
						<p class="text-lg font-semibold text-white">{{ number_format($calcs['angulo_radianos'], 5) }}</p>
					</div>
					<div>
						<p class="text-sm text-gray-300 mb-1">Tangente:</p>
						<p class="text-lg font-semibold text-white">{{ number_format($calcs['tangente'], 5) }}</p>
					</div>
					<div>
						<p class="text-sm text-gray-300 mb-1">Cosseno:</p>
						<p class="text-lg font-semibold text-white">{{ number_format($calcs['cosseno'], 5) }}</p>
					</div>
				</div>
			@endif

			@if(isset($calcs['quant_avanco']))
				<div class="mb-6 pb-6 border-b border-gray-600">
					<p class="text-center mb-4 font-semibold text-white">Detalhes dos Cálculos</p>
					<div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Ângulo (graus):</span>
							<span class="text-white">{{ number_format($calcs['angulo_graus'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Pi (arredondado):</span>
							<span class="text-white">{{ number_format($calcs['pi'], 4) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Ângulo (rad):</span>
							<span class="text-white">{{ number_format($calcs['angulo_radianos'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Cosseno:</span>
							<span class="text-white">{{ number_format($calcs['cosseno'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Tangente:</span>
							<span class="text-white">{{ number_format($calcs['tangente'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Quant. avanço:</span>
							<span class="text-white">{{ number_format($calcs['quant_avanco'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Cálculo um:</span>
							<span class="text-white">{{ number_format($calcs['calculo_um'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Cálculo dois:</span>
							<span class="text-white">{{ number_format($calcs['calculo_dois'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Cálculo três:</span>
							<span class="text-white">{{ number_format($calcs['calculo_tres'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Passo:</span>
							<span class="text-white">{{ number_format($calcs['passo'], 5) }}</span>
						</div>
					</div>
				</div>
			@endif

			@if(isset($calcs['melhores']) && count($calcs['melhores']) > 0)
				<div>
					<p class="text-center mb-4 font-semibold text-white">Melhores combinações de engrenagens:</p>
					<div class="space-y-2 max-h-64 overflow-y-auto">
						@foreach($calcs['melhores'] as $combo)
							<div class="bg-black/30 p-3 rounded text-sm font-mono">
								A: <span class="text-yellow-400 font-bold">{{ $combo['A'] }}</span>,
								B: <span class="text-cyan-400 font-bold">{{ $combo['B'] }}</span>,
								C: <span class="text-green-400 font-bold">{{ $combo['C'] }}</span>,
								D: <span class="text-pink-400 font-bold">{{ $combo['D'] }}</span>
								<span class="text-gray-400 ml-3">Erro: {{ number_format($combo['Error'], 6) }}</span>
							</div>
						@endforeach
					</div>
					<p class="text-xs text-gray-400 mt-3 text-center">Mostrando 10 melhores combinações encontradas.</p>
				</div>
			@else
				<div class="text-center text-gray-400">
					Nenhuma combinação encontrada dentro da tolerância.
				</div>
			@endif
		</div>
		@endif
	</main>

	<footer class="bg-black-900 text-white mt-8 py-4">
		<div class="max-w-7xl mx-auto px-4 text-center">
			<p class="text-xs">&copy; {{ date('Y') }} Calc Machining. Todos os direitos reservados.</p>
		</div>
	</footer>

	<script>
		(function() {
			const form = document.getElementById('helicoidal-form');
			if (!form) return;

			form.addEventListener('submit', function(event) {
				const fields = form.querySelectorAll('input[type="number"]');
				let hasError = false;

				fields.forEach((field) => {
					const value = field.value.trim();
					const numberValue = Number(value);
					if (value === '' || Number.isNaN(numberValue) || numberValue < 0) {
						hasError = true;
					}
				});

				if (hasError) {
					event.preventDefault();
					alert('Preencha todos os campos com valores maiores ou iguais a zero.');
				}
			});
		})();
	</script>
</body>
</html>
