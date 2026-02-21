<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Medida W Helicoidal</title>
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
				<a href="{{ route('helicoidal') }}" class="text-black font-bold text-sm hover:text-gray-600 transition" style="text-decoration: none;">ENGRENAGEM HELICOIDAL</a>
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
		<h1 class="text-2xl font-bold mb-6 text-white text-center" style="font-family: 'Roboto', sans-serif;">MEDIDA W (K) HELICOIDAL</h1>
		<p class="text-gray-300 text-center mb-6" style="font-family: 'Roboto', sans-serif;">Cálculo da Medida W (K) com dentes helicoidais.</p>

		<div class="max-w-md mx-auto bg-white/5 p-6 rounded-lg shadow-md">
			<form id="medidaw-form" action="{{ route('medidaw.helicoidal') }}" method="GET" class="space-y-4">
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
					<label for="angulo_helice" class="block text-sm font-medium text-gray-200">Ângulo de hélice</label>
					<input id="angulo_helice" name="angulo_helice" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 20" value="{{ request()->input('angulo_helice') }}">
				</div>

				<div>
					<label for="angulo_depressao" class="block text-sm font-medium text-gray-200">Ângulo de pressão</label>
					<input id="angulo_depressao" name="angulo_depressao" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 20" value="{{ request()->input('angulo_depressao') }}">
				</div>

				<div>
					<label for="folga_dente" class="block text-sm font-medium text-gray-200">Folga no dente</label>
					<input id="folga_dente" name="folga_dente" type="number" step="any" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 0.1" value="{{ request()->input('folga_dente') }}">
				</div>

				<div>
					<label for="dentes_medidos" class="block text-sm font-medium text-gray-200">Dentes medidos</label>
					<input id="dentes_medidos" name="dentes_medidos" type="number" min="0" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 5" value="{{ request()->input('dentes_medidos') }}">
				</div>

                <div>
					<label for="fator_correcao" class="block text-sm font-medium text-gray-200">Fator de correção do perfil</label>
					<input id="fator_correcao" name="fator_correcao" type="number" step="any" required class="mt-1 block w-full px-3 py-2 bg-white/10 border border-gray-700 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 0.1" value="{{ request()->input('fator_correcao') }}">
				</div>

				<div class="text-center mt-4">
					<button type="submit" class="btn-custom">Calcular</button>
				</div>
			</form>
		</div>

		{{-- Resultado dos cálculos --}}
		@if(request()->hasAny(['modulo', 'numero_dentes', 'angulo_helice', 'angulo_depressao', 'folga_dente', 'dentes_medidos', 'fator_correcao']))
			@php
				$modulo = request()->input('modulo');
				$numero_dentes = request()->input('numero_dentes');
				$angulo_helice = request()->input('angulo_helice');
				$angulo = request()->input('angulo_depressao');
				$folga = request()->input('folga_dente');
				$dentes_medidos = request()->input('dentes_medidos');
				$fator_correcao = request()->input('fator_correcao');
				$calcs = [];


				if (is_numeric($modulo) && is_numeric($numero_dentes)) {

                    
					// Cálculo do diâmetro da engrenagem:
					$calculo1 = floatval($numero_dentes) + 2;
					$calcs['diametro'] = floatval($modulo) * $calculo1;
				}


		
				if (is_numeric($angulo)) {
					// Cálculo para colocar angulo em radianos: angulo de pressao * 3,1416 / 180
					$calcs['angulo_radiano'] = floatval($angulo) * 3.1416 / 180;
					// Cosseno do angulo em radianos
					$calcs['cosseno'] = cos($calcs['angulo_radiano']);
					// Tangente do angulo em radianos
					$calcs['tangente'] = tan($calcs['angulo_radiano']);
				}

				// Calculo cosseno e tangente do angulo da helice
				if (is_numeric($angulo_helice)) {
                    // Cálculo para colocar angulo em radianos: angulo de helice * 3,1416 / 180
					$angulo_helice_radiano = floatval($angulo_helice) * 3.1416 / 180;
					// Cosseno do angulo em radianos
                    $calcs['cosseno_helice'] = cos($angulo_helice_radiano);
                    // Tangente do angulo em radianos
					$calcs['tangente_helice'] = tan($angulo_helice_radiano);
				}

				// Calculo modulo normal
				if (is_numeric($modulo) && isset($calcs['cosseno_helice'])) {
					$calcs['modulo_normal'] = floatval($modulo) * $calcs['cosseno_helice'];
				}

				// Formula medida W Helicoidal Sem correção
				if (is_numeric($dentes_medidos)) {
					$calcs['parte1_helicoidal'] = (floatval($dentes_medidos) - 0.5) * 3.1416;
				
					$calcs['w_sem_correcao'] = $calcs['modulo_normal'] * $calcs['parte1_helicoidal'];
				}

				// Formula medida W Helicoidal Com correção
				if (is_numeric($fator_correcao) && isset($calcs['tangente'])) {
					$calcs['parte2'] = (2 * floatval($fator_correcao)) * $calcs['tangente'];
				}

				// Conexão Formula
				if (isset($calcs['parte1_helicoidal']) && isset($calcs['parte2'])) {
					$calcs['formula'] = $calcs['parte1_helicoidal'] + $calcs['parte2'];
				}

				if (isset($calcs['modulo_normal']) && isset($calcs['formula'])) {
					$calcs['w_com_correcao'] = $calcs['modulo_normal'] * $calcs['formula'];
				}


			// Definir qual medida usar baseado no fator de correção
			if (floatval($fator_correcao) == 0) {
				$calcs['medida_w'] = isset($calcs['w_sem_correcao']) ? $calcs['w_sem_correcao'] : 0;
			} else {
				$calcs['medida_w'] = isset($calcs['w_com_correcao']) ? $calcs['w_com_correcao'] : 0;
			}

			// Subtrair folga após definir medida_w
			if ($calcs['medida_w'] != 0) {
				$valor_j = 0.06 * floatval($modulo);
				$calcs['medida_final'] = $calcs['medida_w'] - $valor_j - floatval($folga);
			}
				
				
			@endphp

			<div class="mt-6 max-w-md mx-auto bg-white/5 p-4 rounded-lg">
				<h3 class="text-lg font-semibold text-white text-center mb-2">Resultado</h3>
				<div class="text-sm text-gray-200 space-y-1">
				@if(isset($calcs['diametro']))
					<div class="text-lg font-semibold text-center">Diâmetro (mm): <strong class="text-yellow-400">{{ number_format($calcs['diametro'], 2) }}</strong></div>
				@endif
				@if(isset($calcs['medida_final']))
					<div class="text-lg font-semibold text-center">Medida W(K) (mm): <strong class="text-yellow-400">{{ number_format($calcs['medida_final'], 2) }}</strong></div>
					@endif
				</div>
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
			const form = document.getElementById('medidaw-form');
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
