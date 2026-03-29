<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WalletUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletUserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|min:1',
            'wallet_address' => 'required|string|max:88|min:32',
            'cluster' => 'nullable|string|max:32',
            'premium' => 'sometimes|boolean',
        ]);

        $wallet = trim($validated['wallet_address']);
        $username = trim($validated['username']);
        $premium = array_key_exists('premium', $validated)
            ? (bool) $validated['premium']
            : false;

        // If wallet already exists, return its token directly (re-login).
        $existing = WalletUser::where('wallet_address', $wallet)->first();
        if ($existing) {
            $existing->cluster = $validated['cluster'] ?? $existing->cluster;
            $existing->api_token = Str::random(64);
            $existing->save();

            return response()->json([
                'message' => 'Re-registered',
                'token' => $existing->api_token,
                'user' => $existing,
            ]);
        }

        // New wallet — check username uniqueness.
        if (WalletUser::where('username', $username)->exists()) {
            return response()->json([
                'message' => 'This username is already registered to another wallet.',
            ], 422);
        }

        $user = new WalletUser();
        $user->username = $username;
        $user->wallet_address = $wallet;
        $user->cluster = $validated['cluster'] ?? null;
        $user->premium = $premium;
        if ($premium) {
            $user->premium_date = now();
        }
        $user->api_token = Str::random(64);
        $user->save();

        return response()->json([
            'message' => 'Registered',
            'token' => $user->api_token,
            'user' => $user,
        ], 201);
    }

    public function updatePremium(Request $request)
    {
        $validated = $request->validate([
            'wallet_address' => 'required|string|max:88|min:32',
            'premium' => 'required|boolean',
        ]);

        $wallet = trim($validated['wallet_address']);
        $user = WalletUser::where('wallet_address', $wallet)->first();

        if (! $user) {
            return response()->json([
                'message' => 'Wallet not registered. Complete onboarding first.',
            ], 404);
        }

        $isPremium = (bool) $validated['premium'];
        $data = ['premium' => $isPremium];

        if ($isPremium && ! $user->premium) {
            $data['premium_date'] = now();
        }
        if (! $isPremium) {
            $data['premium_date'] = null;
        }

        $user->update($data);

        return response()->json([
            'message' => 'Updated',
            'user' => $user->fresh(),
        ]);
    }

    /**
     * Update wallet address for the authenticated app user (by api_token).
     * Rotates api_token so the client must persist the new token.
     */
    public function changeWallet(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|min:32|max:80',
            'wallet_address' => 'required|string|max:88|min:32',
            'cluster' => 'nullable|string|max:32',
        ]);

        $user = WalletUser::where('api_token', $validated['token'])->first();

        if (! $user) {
            return response()->json([
                'message' => 'Invalid or expired token.',
            ], 401);
        }

        $newWallet = trim($validated['wallet_address']);

        if ($newWallet !== $user->wallet_address) {
            $taken = WalletUser::where('wallet_address', $newWallet)
                ->where('id', '!=', $user->id)
                ->exists();

            if ($taken) {
                return response()->json([
                    'message' => 'This wallet is already linked to another account.',
                ], 422);
            }

            $user->wallet_address = $newWallet;
        }

        if (array_key_exists('cluster', $validated) && $validated['cluster'] !== null) {
            $user->cluster = $validated['cluster'];
        }

        $user->api_token = Str::random(64);
        $user->save();

        return response()->json([
            'message' => 'Updated',
            'token' => $user->api_token,
            'user' => $user->fresh(),
        ]);
    }
}
