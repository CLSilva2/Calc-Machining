<?php

use App\Http\Controllers\SubscriptionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

$normalizeCpf = static fn (?string $value): string => preg_replace('/\D+/', '', (string) $value);
$normalizePhone = static fn (?string $value): string => preg_replace('/\D+/', '', (string) $value);

$isValidCpf = static function (string $cpf): bool {
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    for ($digitPosition = 9; $digitPosition < 11; $digitPosition++) {
        $sum = 0;

        for ($index = 0; $index < $digitPosition; $index++) {
            $sum += ((int) $cpf[$index]) * (($digitPosition + 1) - $index);
        }

        $calculatedDigit = ((10 * $sum) % 11) % 10;

        if ((int) $cpf[$digitPosition] !== $calculatedDigit) {
            return false;
        }
    }

    return true;
};

$loadGearSettingsForUser = static function (Request $request): void {
    $settings = DB::table('user_gear_settings')
        ->where('user_id', Auth::id())
        ->first();

    if (! $settings) {
        return;
    }

    $selectedGears = json_decode((string) $settings->engrenagens, true);

    session([
        'engrenagens_configuracao' => $settings->configuracao,
        'engrenagens_min' => $settings->engrenagem_min,
        'engrenagens_max' => $settings->engrenagem_max,
        'engrenagens_selecionadas' => is_array($selectedGears) ? $selectedGears : [],
    ]);
};

$storeCalculationHistory = static function (Request $request, string $calculationType): void {
    if (! $request->query()) {
        return;
    }

    DB::table('calculation_histories')->insert([
        'user_id' => Auth::id(),
        'calculation_type' => $calculationType,
        'input_data' => json_encode($request->query(), JSON_UNESCAPED_UNICODE),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
};

Route::get('/', function () {
    return view('Layout.welcome');
})->name('home');

Route::get('/login', function () {
    return redirect()->route('home');
})->name('login');

Route::post('/login', function (Request $request) use ($normalizeCpf, $normalizePhone, $isValidCpf) {
    $credentials = $request->validate([
        'identificador' => ['required', 'string'],
        'password' => ['required', 'string'],
    ], [
        'identificador.required' => 'Informe email, CPF ou telefone.',
        'password.required' => 'Informe a senha.',
    ]);

    $identifier = trim($credentials['identificador']);
    $normalizedCpf = $normalizeCpf($identifier);
    $normalizedPhone = $normalizePhone($identifier);

    $user = null;
    $errorField = 'identificador';
    $notFoundMessage = 'Identificador incorreto.';

    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        $user = User::where('email', $identifier)->first();
        $notFoundMessage = 'Email incorreto.';
    } elseif (preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $identifier) || strlen($normalizedCpf) === 11) {
        if (! $isValidCpf($normalizedCpf)) {
            throw ValidationException::withMessages([
                'identificador' => 'CPF incorreto.',
            ]);
        }

        $user = User::where('cpf', $normalizedCpf)->first();
        $notFoundMessage = 'CPF incorreto.';
    } else {
        $user = User::where('phone', $normalizedPhone)->first();
        $notFoundMessage = 'Telefone incorreto.';
    }

    if (! $user) {
        throw ValidationException::withMessages([
            $errorField => $notFoundMessage,
        ]);
    }

    if (! Hash::check($credentials['password'], $user->password)) {
        throw ValidationException::withMessages([
            'password' => 'Senha incorreta.',
        ]);
    }

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended(route('home'));
})->name('auth.login');

Route::post('/cadastro', function (Request $request) use ($normalizeCpf, $normalizePhone, $isValidCpf) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'cpf' => ['required', 'string'],
        'phone' => ['required', 'string', 'regex:/^\([1-9][0-9]\)\s?9[0-9]{8}$/'],
        'email' => ['required', 'string', 'email', 'max:255', 'regex:/^[^\s@]+@(gmail|outlook|hotmail)\.[^\s@]+$/i', 'unique:users,email', 'confirmed'],
        'email_confirmation' => ['required', 'string', 'email'],
        'password' => ['required', 'string', 'min:8', 'regex:/^[A-Za-z0-9@]+$/', 'confirmed'],
        'privacy_policy_accepted' => ['accepted'],
    ], [
        'name.required' => 'Informe o nome.',
        'surname.required' => 'Informe o sobrenome.',
        'cpf.required' => 'Informe o CPF.',
        'phone.required' => 'Informe o telefone.',
        'phone.regex' => 'Telefone inválido. Use no formato (DD) 9XXXXXXXX, sem 0 no DDD.',
        'email.required' => 'Informe o email.',
        'email.regex' => 'Email inválido. Use apenas gmail, outlook ou hotmail.',
        'email.unique' => 'Este email já está cadastrado.',
        'email.confirmed' => 'Os emails informados precisam estar iguais.',
        'email_confirmation.required' => 'Confirme o email.',
        'password.required' => 'Informe a senha.',
        'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        'password.regex' => 'A senha deve conter apenas letras, números e @.',
        'password.confirmed' => 'As senhas informadas precisam estar iguais.',
        'privacy_policy_accepted.accepted' => 'Você precisa aceitar a Política de Privacidade para continuar.',
    ]);

    $normalizedCpf = $normalizeCpf($validated['cpf']);
    $normalizedPhone = $normalizePhone($validated['phone']);

    if (! preg_match('/^[1-9][0-9]9[0-9]{8}$/', $normalizedPhone)) {
        throw ValidationException::withMessages([
            'phone' => 'Telefone inválido. Use no formato (DD) 9XXXXXXXX, sem 0 no DDD.',
        ]);
    }

    if (! $isValidCpf($normalizedCpf)) {
        throw ValidationException::withMessages([
            'cpf' => 'CPF inválido.',
        ]);
    }

    $existingCpfUser = User::where('cpf', $normalizedCpf)->first();
    if ($existingCpfUser) {
        $sameName = strcasecmp(trim((string) $existingCpfUser->name), trim($validated['name'])) === 0;
        $sameSurname = strcasecmp(trim((string) $existingCpfUser->surname), trim($validated['surname'])) === 0;

        if (! $sameName || ! $sameSurname) {
            throw ValidationException::withMessages([
                'cpf' => 'O CPF informado não corresponde ao nome e sobrenome informados.',
            ]);
        }

        throw ValidationException::withMessages([
            'cpf' => 'Este CPF já está cadastrado.',
        ]);
    }

    if (User::where('phone', $normalizedPhone)->exists()) {
        throw ValidationException::withMessages([
            'phone' => 'Este telefone já está cadastrado.',
        ]);
    }

    $user = User::create([
        'name' => trim($validated['name']),
        'surname' => trim($validated['surname']),
        'cpf' => $normalizedCpf,
        'phone' => $normalizedPhone,
        'email' => trim($validated['email']),
        'password' => Hash::make($validated['password']),
        'privacy_policy_accepted' => true,
        'privacy_policy_accepted_at' => now(),
        'privacy_policy_accepted_ip' => $request->ip(),
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('pagamentos');
})->name('auth.register');

Route::post('/password/send-code', function (Request $request) use ($normalizeCpf, $isValidCpf) {
    $validated = $request->validate([
        'reset_cpf' => ['required', 'string'],
    ], [
        'reset_cpf.required' => 'Informe o CPF.',
    ]);

    $normalizedCpf = $normalizeCpf($validated['reset_cpf']);

    if (! $isValidCpf($normalizedCpf)) {
        $request->session()->put('password_reset_stage', 'send_code');

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_cpf' => 'CPF inválido.'])
            ->withInput();
    }

    $user = User::where('cpf', $normalizedCpf)->first();

    if (! $user) {
        $request->session()->put('password_reset_stage', 'send_code');

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_cpf' => 'CPF não encontrado.'])
            ->withInput();
    }

    $code = (string) random_int(100000, 999999);
    $isPasswordResetTestMode = filter_var(env('PASSWORD_RESET_TEST_MODE', false), FILTER_VALIDATE_BOOL);

    Cache::put(
        'password_reset_code_'.$user->id,
        Hash::make($code),
        now()->addMinutes(15)
    );

    Mail::raw("Seu código de recuperação é: {$code}", function ($message) use ($user) {
        $message->to($user->email)
            ->subject('Código de recuperação de senha - Calc Machining');
    });

    $request->session()->forget([
        'password_reset_pending_user_id',
        'password_reset_verified_user_id',
        'password_reset_verified_cpf',
    ]);
    $request->session()->put('password_reset_pending_user_id', $user->id);
    $request->session()->put('password_reset_stage', 'verify_code');

    if ($isPasswordResetTestMode) {
        Log::info('Password reset test code generated', [
            'user_id' => $user->id,
            'email' => $user->email,
            'cpf' => $user->cpf,
            'code' => $code,
        ]);
    }

    return redirect()->route('home', ['auth' => 'forgot'])
        ->with('password_code_status', 'Código enviado')
        ->with('password_code_debug', $isPasswordResetTestMode ? $code : null);
})->name('auth.password.send-code');

Route::post('/password/verify-code', function (Request $request) use ($normalizeCpf, $isValidCpf) {
    $validated = $request->validate([
        'reset_code' => ['required', 'digits:6'],
    ], [
        'reset_code.required' => 'Informe o código de 6 dígitos.',
        'reset_code.digits' => 'O código deve ter 6 dígitos.',
    ]);

    $pendingUserId = $request->session()->get('password_reset_pending_user_id');

    if (! $pendingUserId) {
        $request->session()->put('password_reset_stage', 'send_code');

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_cpf' => 'Solicite um novo código para continuar.']);
    }

    $user = User::find($pendingUserId);

    if (! $user) {
        $request->session()->forget('password_reset_pending_user_id');
        $request->session()->put('password_reset_stage', 'send_code');

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_cpf' => 'Solicite um novo código para continuar.']);
    }

    $cachedCodeHash = Cache::get('password_reset_code_'.$user->id);

    if (! $cachedCodeHash || ! Hash::check($validated['reset_code'], $cachedCodeHash)) {
        $request->session()->put('password_reset_stage', 'verify_code');

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_code' => 'Código inválido ou expirado.'])
            ->withInput();
    }

    $request->session()->forget('password_reset_pending_user_id');
    $request->session()->put('password_reset_verified_user_id', $user->id);
    $request->session()->put('password_reset_verified_cpf', $user->cpf);
    $request->session()->put('password_reset_stage', 'update_password');

    return redirect()->route('home', ['auth' => 'forgot'])
        ->with('password_code_verified_status', 'Código confirmado. Agora defina sua nova senha.');
})->name('auth.password.verify-code');

Route::post('/password/update-after-code', function (Request $request) {
    $validated = $request->validate([
        'new_password' => ['required', 'string', 'min:8', 'regex:/^[A-Za-z0-9@]+$/', 'confirmed'],
        'new_password_confirmation' => ['required', 'string'],
    ], [
        'new_password.required' => 'Informe a nova senha.',
        'new_password.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
        'new_password.regex' => 'A nova senha deve conter apenas letras, números e @.',
        'new_password.confirmed' => 'As senhas informadas precisam estar iguais.',
    ]);

    $verifiedUserId = $request->session()->get('password_reset_verified_user_id');

    if (! $verifiedUserId) {
        $request->session()->put('password_reset_stage', 'verify_code');

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_code' => 'Confirme o código de 6 dígitos antes de trocar a senha.']);
    }

    $user = User::find($verifiedUserId);

    if (! $user) {
        $request->session()->forget([
            'password_reset_pending_user_id',
            'password_reset_verified_user_id',
            'password_reset_verified_cpf',
            'password_reset_stage',
        ]);

        return redirect()->route('home', ['auth' => 'forgot'])
            ->withErrors(['reset_cpf' => 'Usuário não encontrado para redefinição.']);
    }

    $user->password = Hash::make($validated['new_password']);
    $user->save();

    Cache::forget('password_reset_code_'.$user->id);
    $request->session()->forget([
        'password_reset_pending_user_id',
        'password_reset_verified_user_id',
        'password_reset_verified_cpf',
        'password_reset_stage',
    ]);

    return redirect()->route('home', ['auth' => 'login'])
        ->with('password_reset_status', 'Senha alterada com sucesso. Faça login com a nova senha.');
})->name('auth.password.update-after-code');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->name('auth.logout');

// Rotas para as páginas de cálculos
Route::middleware('auth')->group(function () use ($loadGearSettingsForUser, $storeCalculationHistory) {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/medidaw-reto', function (Request $request) use ($loadGearSettingsForUser, $storeCalculationHistory) {
        $loadGearSettingsForUser($request);
        $storeCalculationHistory($request, 'medidaw.reto');

        return view('pages.medidaw-reto');
    })->name('medidaw.reto');

    Route::get('/medidaw-helicoidal', function (Request $request) use ($loadGearSettingsForUser, $storeCalculationHistory) {
        $loadGearSettingsForUser($request);
        $storeCalculationHistory($request, 'medidaw.helicoidal');

        return view('pages.medidaw-helicoidal');
    })->name('medidaw.helicoidal');

    Route::get('/helicoidal', function (Request $request) use ($loadGearSettingsForUser, $storeCalculationHistory) {
        $loadGearSettingsForUser($request);
        $storeCalculationHistory($request, 'helicoidal');

        return view('pages.helicoidal');
    })->name('helicoidal');

    Route::get('/kit-com-passo', function (Request $request) use ($loadGearSettingsForUser, $storeCalculationHistory) {
        $loadGearSettingsForUser($request);
        $storeCalculationHistory($request, 'kit.com-passo');

        return view('pages.kit-com-passo');
    })->name('kit.com-passo');

    Route::get('/medida-cordal', function (Request $request) use ($loadGearSettingsForUser, $storeCalculationHistory) {
        $loadGearSettingsForUser($request);
        $storeCalculationHistory($request, 'medida.cordal');

        return view('pages.em-progresso-1');
    })->name('medida.cordal');

    // Rotas para páginas institucionais
    Route::get('/engrenagens', function (Request $request) use ($loadGearSettingsForUser) {
        $loadGearSettingsForUser($request);

        return view('pages.engrenagens');
    })->name('engrenagens');

    Route::post('/engrenagens', function (Request $request) {
        $configuracao = $request->input('configuracao');

        if ($configuracao === 'minmax') {
            $validated = $request->validate([
                'configuracao' => ['required', 'in:minmax,selecionada'],
                'engrenagem_min' => ['required', 'integer', 'min:18', 'max:127'],
                'engrenagem_max' => ['required', 'integer', 'min:18', 'max:127', 'gte:engrenagem_min'],
            ]);

            $engrenagens = range((int) $validated['engrenagem_min'], (int) $validated['engrenagem_max']);
        } else {
            $validated = $request->validate([
                'configuracao' => ['required', 'in:minmax,selecionada'],
                'engrenagens' => ['required', 'array', 'min:1'],
                'engrenagens.*' => ['integer', 'min:18', 'max:127'],
            ]);

            $engrenagens = array_values(array_unique(array_map('intval', $validated['engrenagens'])));
            sort($engrenagens);
        }

        session([
            'engrenagens_configuracao' => $configuracao,
            'engrenagens_min' => $request->input('engrenagem_min'),
            'engrenagens_max' => $request->input('engrenagem_max'),
            'engrenagens_selecionadas' => $engrenagens,
        ]);

        DB::table('user_gear_settings')->updateOrInsert(
            ['user_id' => Auth::id()],
            [
                'configuracao' => $configuracao,
                'engrenagem_min' => $request->input('engrenagem_min'),
                'engrenagem_max' => $request->input('engrenagem_max'),
                'engrenagens' => json_encode($engrenagens, JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        return redirect()->route('engrenagens')->with('status', 'Configuração salva com sucesso.');
    })->name('engrenagens.save');

    Route::get('/pagamentos', function () {
        DB::table('payment_histories')->insert([
            'user_id' => Auth::id(),
            'event_type' => 'acesso_pagina_pagamentos',
            'details' => json_encode(['mensagem' => 'Acesso à página de pagamentos'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('pages.pagamentos');
    })->name('pagamentos');

    Route::get('/assinatura', function () {
        return redirect()->route('pagamentos');
    })->name('assinatura');

    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

    Route::get('/conta/dados', function () {
        return view('pages.conta-dados', [
            'user' => Auth::user(),
        ]);
    })->name('conta.dados');

    Route::get('/conta/historico-calculos', function () {
        $histories = DB::table('calculation_histories')
            ->where('user_id', Auth::id())
            ->latest()
            ->limit(100)
            ->get();

        return view('pages.conta-historico-calculos', [
            'histories' => $histories,
        ]);
    })->name('conta.historico-calculos');

    Route::get('/em-progresso-2', function (Request $request) use ($storeCalculationHistory) {
        $storeCalculationHistory($request, 'em-progresso-2');

        return view('pages.em-progresso-2');
    })->name('em-progresso-2');
});

// Rotas para páginas institucionais
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/politica-de-privacidade', 'pages.politica-de-privacidade')->name('politica.privacidade');
Route::view('/termos-de-uso', 'pages.termos-de-uso')->name('termos.uso');
