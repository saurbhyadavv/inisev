<?php 

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\JsonResponse;

class SubscriptionController extends Controller
{
    public function subscribe(SubscriptionRequest $request): JsonResponse
    {
        $website = Website::findOrFail($request->website_id);
        
        $subscription = Subscription::create([
            'website_id' => $website->id,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Subscription created successfully',
            'data' => $subscription
        ], 201);
    }
}