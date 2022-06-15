<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Passport\HasApiTokens;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();

        return view('dashboard', ['token' => $user]);
    }

    public function showTokenForm()
    {
        return view('token-create');
    }

    public function createToken(Request $request)
    {
        $request->validate([
           'name' => 'required'
        ]);

        $tokenName = $request->post('name');

        $user = $request->user();

        $token = $user->createToken($tokenName);

        $user->update([
           'remember_token' => $token->plainTextToken
        ]);

        return view('token-show',[
            'tokenName' => $tokenName,
            'token' => $token->plainTextToken
        ]);
    }

    public function deleteToken(PersonalAccessToken $token)
    {
        $token->delete();

        return redirect('dashboard');
    }

}
