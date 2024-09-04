<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

class BatStateUAuthentication
{
    public function __invoke(LoginRequest $request)
    {
        $params = $request->validated();

        $url = sprintf("%s/auth/employee?api_key=%s", env('DIONE_API_V3'), env('DIONE_API_V3_TOKEN'));
        $credentials = base64_encode(sprintf("%s:%s", $params['username'], $params['password']));
        $context = stream_context_create([
            "http" => [
                "method" => 'POST',
                "header" => "Authorization: Basic $credentials\r\nConnection: close\r\n"
            ]
        ]);
        $dioneResponse = json_decode(file_get_contents($url, false, $context));

        if ($dioneResponse->error == 0 && $dioneResponse->successful) {
            $dioneUserDetails = $dioneResponse->details;
            $userWhere = User::where(['username' => $params['username'], 'password' => null]);
            $user = null;
            if ($userWhere->count() === 0) {
                $user = User::create([
                    'name' => sprintf("%s %s %s", $dioneUserDetails->firstname, $dioneUserDetails->middlename, $dioneUserDetails->lastname),
                    'username' => $dioneUserDetails->emp_id,
                    'email' => $dioneUserDetails->email,
                    'password' => null,
                    'role' => 1
                ]);
            }
            $user ??= $userWhere->first();
            return $this->validationMessage($user);
        }

        $user = User::where(['username' => $params['username'], ['password', '!=', null]])->first();
        if ($user && Hash::check($params['password'], $user->password)) {
            return $user;
        }
    }

    private function validationMessage(User $user)
    {
        if ($user->email_verified_at != null) {
            return $user;
        }
        throw ValidationException::withMessages([Fortify::username() => 'account need validation']);
    }
}
