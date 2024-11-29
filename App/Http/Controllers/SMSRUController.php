<?php

namespace Modules\SMSRU\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\SMSRU\Services\SmsruService;

class SMSRUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $service = new SmsruService();
        $validated = $request->validate([
            'to' => 'required|string',
            'message' => 'required|string|max:160',
        ]);


        return $service->sendSms($validated['to'], $validated['message']);
    }

}
