<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hamcrest\Core\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthenController extends Controller
{
    public function login_otp()
    {
        $data = [
            'title' => 'Generate OTP Page',
            'icon' => Settings::where('setting_name', 'icon-site')->first()
        ];
        return response()
            ->json($data)
            ->setStatusCode(200);
    }
    public function login_otp_action(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $check_otp = VerificationCode::where('user_id', $user->id)->first();

        if ($user) {
            $otp = rand(123456, 999999);

            if ($check_otp) {
                $data = [
                    'otp' => $otp,
                    'expire_at' => now()->addMinutes(10)
                ];

                VerificationCode::where('user_id', $user->id)
                    ->update($data);
            } else {
                $data = [
                    'user_id' => $user_id,
                    'otp' => $otp,
                    'expire_at' => now()
                        ->addMinutes(10)
                ];
                VerificationCode::create($data);
            }
            $mailData = [
                'otp' => $otp,
            ];
            Mail::to($request->email)->send(new MailOTP($mailData));
        }
        return response();
    }
}
