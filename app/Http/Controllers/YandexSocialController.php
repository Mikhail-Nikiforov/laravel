<?php

namespace App\Http\Controllers;

use App\Contract\Social;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class YandexSocialController extends Controller
{
    public function start()
    {
        return Socialite::driver('yandex')->redirect();
    }

    public function callback(Social $service)
    {
        try {
            return redirect($service->socialLogin(Socialite::driver('yandex')->user()));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
