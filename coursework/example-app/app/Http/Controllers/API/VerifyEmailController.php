<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return response(['message'=>'Эта почта уже подтверждена']);
        }

        $request->user()->markEmailAsVerified();

        return response(['message'=>'Ваша почта успешно подтверждена']);
    }
}
