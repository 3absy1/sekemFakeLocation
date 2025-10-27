<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PerDiemController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'notes' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        $imageBase64 = '';
        if ($request->hasFile('image')) {
            $imageBase64 = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        }

        $payload = [
            'jsonrpc' => '2.0',
            'method' => 'call',
            'params' => [
                'model' => 'per.diem',
                'method' => 'create',
                'args' => [[
                    'customer_name' => $request->customer_name,
                    'notes' => $request->notes,
                    'is_mocking' => $request->boolean('is_mocking'),
                    'image_data' => $imageBase64,
                    'latitude' => (float) $request->latitude,
                    'longitude' => (float) $request->longitude,
                ]],
                'kwargs' => new \stdClass(),
                'context' => new \stdClass(),
            ],
        ];

        $response = Http::withHeaders([
            'Cookie' => 'session_id=14675a2df9421631a80754b6dcf3960d6e7de827',
            'Accept' => 'application/json',
        ])
        ->withoutVerifying()
        ->post('https://sekemportal.hooktrack.life/web/dataset/call_kw/per.diem/create', $payload);

        return back()->with('response', $response->json());
    }
}
