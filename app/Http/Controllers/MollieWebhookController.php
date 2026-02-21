<?php

namespace App\Http\Controllers;

use App\Services\MolliePayments;
use Illuminate\Http\Request;

class MollieWebhookController extends Controller
{
    public function __invoke(Request $request, MolliePayments $molliePayments)
    {
        $id = $request->input('id');
        if (! $id) return response()->noContent();

        $molliePayments->handleWebhook($id);

        return response()->noContent();
    }
}
