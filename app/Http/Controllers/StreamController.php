<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Events\ChatTokenReceived;

class StreamController extends Controller
{
    public function streamTokens(Request $request)
    {
        $apiUrl = 'https://api.together.xyz/inference';
        $model = 'togethercomputer/RedPajama-INCITE-7B-Instruct';

        $payload = [
            "model" => $model,
            "prompt" => "Alan Turing was",
            "max_tokens" => 128,
            "stop" => ["\n\n"],
            "temperature" => 0.7,
            "top_p" => 0.7,
            "top_k" => 50,
            "repetition_penalty" => 1,
            "stream_tokens" => true
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('TOGETHER_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post($apiUrl, $payload);

        $response->throw();

        $done = false;

        // Decode the JSON response
        $decodedResponse = json_decode($response->body(), true);
        Log::info($decodedResponse);

        if (is_array($decodedResponse) && isset($decodedResponse['data'])) {
            foreach ($decodedResponse['data'] as $line) {
                if ($line === "[DONE]") {
                    $done = true;
                    break;
                }

                // Parse the streaming token data here
                $partialResult = json_decode($line, true);
                $token = $partialResult["choices"][0]["text"];
                // You can do something with $token here (e.g., save to a database, return as a response, etc.)

                // Broadcast to the Chat channel
                broadcast(new ChatTokenReceived($token));
            }
        } else {
            Log::info("NO GOOD DATA?");
        }

        if ($done) {
            // Final message handling here
            Log::info("Done?");
        }
    }
}
