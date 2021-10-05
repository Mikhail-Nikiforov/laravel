<?php declare(strict_types=1);

namespace App\Services;

use App\Contract\Social;
use App\Models\User as Model;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User;

class SocialService implements Social
{
    public function socialLogin(User $user): string
    {

        $checkUser = Model::where('email', $user->getEmail())->first();

        if ($checkUser) {
            $checkUser->name = $user->getName();
            $checkUser->avatar = $user->getAvatar();
            if ($checkUser->save()) {
                \Auth::loginUsingId($checkUser->id);
                return route('account');
            }
        } else {
            $checkUser = new Model;

            $checkUser->email = $user->getEmail();
            $checkUser->name = $user->getName();
            $checkUser->password = 12345678;
            $checkUser->avatar = $user->getAvatar();

            if ($checkUser->save()) {
                \Auth::loginUsingId($checkUser->id);
                return route('account');
            }
        }

        //register ...

        throw new \Exception('Error social login');
    }
}
