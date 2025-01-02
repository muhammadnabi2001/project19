<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendMessage;
use App\Models\User;
use App\Models\VerfyUser;
use Illuminate\Http\Request;

class VerfyUserController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            VerfyUser::where('user_id', $user->id)->delete();

            $code = rand(1000, 9999);
            $data = [
                'email' => $user->email,
                'code' => $code
            ];
            VerfyUser::create([
                'user_id' => $user->id,
                'code' => $code
            ]);
            SendMessage::dispatch($data);
            return response()->json(['success' => 'Message Sended']);
        }
        return response()->json([
            'error' => 'Foydalanuvchi topilmadi.',
        ], 404);
    }
    public function newpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|numeric',
            'new_password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $verification = VerfyUser::where('user_id', $user->id)
                ->where('code', $request->code)
                ->first();

            if ($verification) {
                $timeDifference = now()->diffInMinutes($verification->created_at);

                if ($timeDifference <= 5) {
                    $user->password = bcrypt($request->new_password);
                    $user->save();

                    $verification->delete();

                    return response()->json(['success' => 'Password successfully updated and user verified.']);
                } else {
                    return response()->json(['error' => 'Verification code expired.'], 400);
                }
            } else {
                return response()->json(['error' => 'Invalid verification code.'], 400);
            }
        }

        return response()->json(['error' => 'User not found.'], 404);
    }
}
