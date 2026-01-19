<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/ai-recommend', function (Request $request) {
    $validated = $request->validate([
        'student_name' => 'required|string',
        'current_position' => 'required|string', 
        'election_name' => 'required|string'
    ]);

    $response = Http::withHeaders([
        'Authorization' => 'Bearer '.env('HF_API_KEY'),
    ])
    ->timeout(30)
    ->post('https://api-inference.huggingface.co/models/facebook/bart-large-mnli', [
        'inputs' => "Should {$validated['student_name']} ({$validated['current_position']}) be approved for {$validated['election_name']}?",
        'parameters' => [
            'candidate_labels' => ['approve', 'reject'],
            'multi_label' => false
        ]
    ]);

    $result = $response->json();

    return [
        'recommendation' => $result['labels'][0],
        'confidence' => round($result['scores'][0] * 100),
        'reason' => $result['labels'][0] === 'approve'
            ? "Qualified based on position hierarchy"
            : "Needs more experience for this role"
    ];
});