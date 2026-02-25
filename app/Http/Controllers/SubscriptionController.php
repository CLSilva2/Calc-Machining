<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $user = $request->user();

        return $user->newSubscription('default', 'prod_U2IOHqGwJIHQRO')
            ->checkout([
                'success_url' => route('dashboard'),
                'cancel_url' => route('assinatura'),
            ]);
    }
}
