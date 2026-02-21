<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kit com Passo</title>
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

		.resultado-linha td {
			border-bottom: 1px solid #9ca3af !important;
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
		<h1 class="text-2xl font-bold mb-6 text-white text-center" style="font-family: 'Roboto', sans-serif;">KIT DE ENGRENAGENS COM PASSO</h1>
		<p class="text-gray-300 text-center mb-6" style="font-family: 'Roboto', sans-serif;">Encontre o kit de engrenagens usando o passo.</p>

		<div class="max-w-md mx-auto bg-white/5 p-6 rounded-lg shadow-md">
			<form id="kitcompasso-form" action="{{ route('kit.com-passo') }}" method="GET" class="space-y-4">
				@csrf
				<div>
					<label for="passo" class="block text-sm font-medium text-gray-200">Passo</label>
					<input id="passo" name="passo" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="12,3456" value="{{ request()->input('passo') }}">
				</div>

				<div class="text-center mt-4">
					<button type="submit" class="btn-custom">Mostrar</button>
				</div>
			</form>
		</div>

		{{-- Resultado dos cálculos --}}
		@if(request()->has('passo'))
			@php
				$engrenagens = [24, 26, 27, 28, 29, 30, 31, 32, 33, 34, 36, 40, 44, 48, 52, 56, 60, 64, 72, 80, 83, 88, 100, 115, 127];
				$rawPasso = str_replace(',', '.', (string) request()->input('passo'));
				$targetPasso = is_numeric($rawPasso) ? (float) $rawPasso : null;
				$validCombinations = [];
				$melhor = null;

				if (is_numeric($targetPasso)) {
					foreach ($engrenagens as $A) {
						foreach ($engrenagens as $B) {
							$AB = $A / $B;
							foreach ($engrenagens as $C) {
								foreach ($engrenagens as $D) {
									$ratio = $AB * ($C / $D);
									$error = abs($ratio - $targetPasso);

									$validCombinations[] = [
										'A' => $A,
										'B' => $B,
										'C' => $C,
										'D' => $D,
										'Ratio' => $ratio,
										'Error' => $error,
									];
								}
							}
						}
					}

					usort($validCombinations, function ($a, $b) {
						return $a['Error'] <=> $b['Error'];
					});

					$melhor = $validCombinations[0] ?? null;
				}
				
			@endphp

			<div class="mt-6 max-w-5xl mx-auto bg-white/5 p-4 rounded-lg">
				<h3 class="text-lg font-semibold text-white text-center mb-2">Resultado</h3>
				@if(is_numeric($targetPasso))
					<div class="text-sm text-gray-200 mb-4 text-center">
						Passo informado: <strong class="text-yellow-400">{{ number_format($targetPasso, 5, '.', '') }}</strong>
					</div>

					@if($melhor)
						<div class="overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-200">
								<thead class="text-xs uppercase text-gray-300 border-b border-gray-700">
									<tr>
										<th class="py-2 px-2 text-green-400">A</th>
										<th class="py-2 px-2 text-cyan-400">B</th>
										<th class="py-2 px-2 text-green-400">C</th>
										<th class="py-2 px-2 text-cyan-400">D</th>
										<th class="py-2 px-2">Resultado</th>
										<th class="py-2 px-2">Erro</th>
										<th class="py-2 px-2">Erro %</th>
									</tr>
								</thead>
								<tbody>
									@php
										$erroPercentual = $targetPasso > 0 ? ($melhor['Error'] / $targetPasso) * 100 : 0;
									@endphp
									<tr class="resultado-linha">
										<td class="py-2 px-2 font-semibold">{{ $melhor['A'] }}</td>
										<td class="py-2 px-2 font-semibold">{{ $melhor['B'] }}</td>
										<td class="py-2 px-2 font-semibold">{{ $melhor['C'] }}</td>
										<td class="py-2 px-2 font-semibold">{{ $melhor['D'] }}</td>
										<td class="py-2 px-2 font-semibold">{{ number_format($melhor['Ratio'], 5  , '.', '') }}</td>
										<td class="py-2 px-2 font-semibold">{{ number_format($melhor['Error'], 6, '.', '') }}</td>
										<td class="py-2 px-2 font-semibold">{{ number_format($erroPercentual, 4, '.', '') }}%</td>
									</tr>
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center text-sm text-gray-200">
							Nenhuma combinação encontrada.
						</div>
					@endif
				@else
					<div class="text-center text-sm text-gray-200">
						Valor de passo inválido.
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
			const form = document.getElementById('kitcompasso-form');
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

