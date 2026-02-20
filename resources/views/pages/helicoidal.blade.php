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
				<a href="{{ route('medidaw.reto') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">MEDIDA W RETO</a>
				<a href="{{ route('medidaw.helicoidal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">MEDIDA W HELICOIDAL</a>
				<a href="{{ route('kit.com-passo') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">KIT ENGRENAGEM COM PASSO</a>
				<a href="{{ route('medida.cordal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">MEDIDA CORDAL</a>
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
					<label for="angulo_pressao" class="block text-sm font-medium text-gray-200">Ângulo de pressão</label>
					<input id="angulo_pressao" name="angulo_pressao" type="text" inputmode="decimal" data-angle="true" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="20, 20° ou 20°23&quot;" value="{{ request()->input('angulo_pressao') }}">
				</div>

				<div>
					<label for="angulo_helice" class="block text-sm font-medium text-gray-200">Ângulo de Hélice</label>
					<input id="angulo_helice" name="angulo_helice" type="text" inputmode="decimal" data-angle="true" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="20, 20° ou 20°23&quot;" value="{{ request()->input('angulo_helice') }}">
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

		
		@if(request()->hasAny(['modulo', 'numero_dentes', 'angulo_pressao', 'angulo_helice', 'divisor', 'fuso']))
			@php
				$parseAngle = function ($value) {
					if ($value === null) {
						return null;
					}
					$raw = trim((string) $value);
					if ($raw === '') {
						return null;
					}
					$normalized = str_replace(',', '.', $raw);
					if (strpos($normalized, '°') === false) {
						return is_numeric($normalized) ? floatval($normalized) : null;
					}
					$pattern = '/^\s*([0-9]+(?:\.[0-9]+)?)\s*°\s*([0-9]+(?:\.[0-9]+)?)?\s*(?:"|”)?\s*$/';
					if (!preg_match($pattern, $normalized, $matches)) {
						return null;
					}
					$degrees = floatval($matches[1]);
					$seconds = isset($matches[2]) && $matches[2] !== '' ? floatval($matches[2]) : 0.0;
					return $degrees + ($seconds / 3600.0);
				};

				$modulo = request()->input('modulo');
				$numero_dentes = request()->input('numero_dentes');
				$angulo_pressao = $parseAngle(request()->input('angulo_pressao'));
				$angulo_helice = $parseAngle(request()->input('angulo_helice'));
				$divisor = request()->input('divisor');
				$fuso = request()->input('fuso');
				$calcs = [];




			// Lista de engrenagens disponíveis
			$engrenagens = [
				24, 26, 27, 28, 29, 30, 31, 32, 33, 34,
				36, 40, 44, 48, 52, 56, 60, 64, 72, 80,
				88, 100, 127
			];







			//FORMULA


			// Calculo quant_avanco
			$quant_avanco = floatval($divisor) * floatval($fuso);
			$calcs['quant_avanco'] = $quant_avanco;


			// Calculo angulox
			$angulox = floatval($angulo_pressao);
			$calcs['angulo_pressao'] = $angulox;
			$calcs['angulo_helice'] = floatval($angulo_helice);

			// Calculo para angulos radianos
			$angulo_radianos = $angulox * pi() / 180;
			$calcs['angulo_radianos'] = $angulo_radianos;
			$calcs['cosseno'] = cos($angulo_radianos);
			$calcs['tangente'] = tan($angulo_radianos);

			
			// Calculo Primitivo
			$parte1 = floatval($modulo) / $calcs['cosseno'];
			$parte2 = $parte1 * floatval($numero_dentes);
			$parte3 = $parte2 * pi() / $calcs['tangente'];
			$passo = $parte3 / $quant_avanco;
			$calcs['parte1'] = $parte1;
			$calcs['parte2'] = $parte2;
			$calcs['parte3'] = $parte3;

			// Buscar combinações válidas de engrenagens
			$targetRatio = $passo;
			$tolerance = 0.001;
			$validCombinations = [];

			foreach ($engrenagens as $A) {
				foreach ($engrenagens as $B) {
					foreach ($engrenagens as $C) {
						foreach ($engrenagens as $D) {
							$ratio = ($A * $C) / ($B * $D);
							
							if (abs($ratio - $targetRatio) <= $tolerance) {
								$error = abs($ratio - $targetRatio);
								$validCombinations[] = [
									'A' => $A,
									'B' => $B,
									'C' => $C,
									'D' => $D,
									'error' => $error,
									'ratio' => $ratio
								];
							}
						}
					}
				}
			}

			// Ordenar por erro (menor primeiro)
			usort($validCombinations, function($x, $y) {
				return $x['error'] <=> $y['error'];
			});

			$calcs['passo'] = $passo;
			$calcs['validCombinations'] = $validCombinations;
			$calcs['targetRatio'] = $targetRatio;
			
			@endphp

		<div class="mt-6 max-w-2xl mx-auto bg-white/5 p-6 rounded-lg">
			<h3 class="text-lg font-semibold text-white text-center mb-6">Resultado</h3>
			
			@if(isset($calcs['passo']))
				<div class="text-center mb-6 pb-6 border-b border-gray-600">
					<p class="text-sm text-gray-300 mb-2">Passo Calculado (mm):</p>
					<div class="text-4xl font-bold text-yellow-400">{{ number_format($calcs['passo'], 4) }}</div>
				</div>
			@endif

			@if(isset($calcs['angulo_radianos']))
				<div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6 pb-6 border-b border-gray-600 text-center">
					<div>
						<p class="text-sm text-gray-300 mb-1">Ângulo de pressão (graus):</p>
						<p class="text-lg font-semibold text-white">{{ number_format(floatval($angulo_pressao), 5) }}</p>
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
							<span class="text-gray-300">Ângulo de pressão (graus):</span>
							<span class="text-white">{{ number_format($calcs['angulo_pressao'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Ângulo de hélice (graus):</span>
							<span class="text-white">{{ number_format($calcs['angulo_helice'], 5) }}</span>
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
							<span class="text-gray-300">Parte 1:</span>
							<span class="text-white">{{ number_format($calcs['parte1'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Parte 2:</span>
							<span class="text-white">{{ number_format($calcs['parte2'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Parte 3:</span>
							<span class="text-white">{{ number_format($calcs['parte3'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Passo:</span>
							<span class="text-white">{{ number_format($calcs['passo'], 5) }}</span>
						</div>
						<div class="bg-black/30 p-3 rounded">
							<span class="text-gray-300">Target ratio:</span>
							<span class="text-white">{{ number_format($calcs['targetRatio'], 5) }}</span>
						</div>
					</div>
				</div>
			@endif

			@if(isset($calcs['validCombinations']) && count($calcs['validCombinations']) > 0)
				<div>
					<p class="text-center mb-4 font-semibold text-white">Engrenagens Recomendadas (A-B-C-D):</p>
					<div class="space-y-2 max-h-64 overflow-y-auto">
						@foreach($calcs['validCombinations'] as $index => $combo)
							@if($index < 10)
								<div class="bg-black/30 p-3 rounded text-sm font-mono">
									<span class="text-yellow-400 font-bold">{{ $combo['A'] }}</span>-<span class="text-cyan-400 font-bold">{{ $combo['B'] }}</span>-<span class="text-green-400 font-bold">{{ $combo['C'] }}</span>-<span class="text-pink-400 font-bold">{{ $combo['D'] }}</span>
									<span class="text-gray-400 ml-3">(Erro: {{ number_format($combo['error'], 6) }})</span>
								</div>
							@endif
						@endforeach
					</div>
					<p class="text-xs text-gray-400 mt-3 text-center">Mostrando 10 melhores combinações de {{ count($calcs['validCombinations']) }} encontradas.</p>
				</div>
			@else
				<div class="text-center text-gray-400">
					Nenhuma combinação de engrenagens encontrada com a tolerância de 0.001
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
				const fields = form.querySelectorAll('input[type="number"], input[data-angle="true"]');
				let hasError = false;

				const isValidAngle = (value) => {
					const raw = value.trim();
					if (raw === '') return false;
					const normalized = raw.replace(',', '.');
					if (!normalized.includes('°')) {
						const numberValue = Number(normalized);
						return !Number.isNaN(numberValue) && numberValue >= 0;
					}
					const pattern = /^\s*[0-9]+(?:\.[0-9]+)?\s*°\s*([0-9]+(?:\.[0-9]+)?)?\s*(?:"|”)?\s*$/;
					return pattern.test(normalized);
				};

				fields.forEach((field) => {
					const value = field.value.trim();
					if (field.dataset.angle === 'true') {
						if (!isValidAngle(value)) {
							hasError = true;
						}
						return;
					}
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
