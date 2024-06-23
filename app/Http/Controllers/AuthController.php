<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{


    /**
     * Send OTP to the user's email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $otp = mt_rand(100000, 999999); // Generate random OTP
        $email = $request->input('email');

        // Store OTP in database
        OtpCode::updateOrCreate(
            ['email' => $email],
            ['otp' => $otp]
        );

        // Send OTP to user's email
        Mail::to($email)->send(new OtpEmail($otp));

        return response()->json(['message' => 'OTP sent successfully'], 200);
    }
    /**
     * Verify OTP and issue access token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $email = $request->input('email');
        $otp = $request->input('otp');

        // Check if OTP exists in database and is not expired
        $otpCode = OtpCode::where('email', $email)
        ->where('otp', $otp)
        ->where('updated_at', '>=', Carbon::now()->subSeconds(60)) // Adjust timeout as needed
        ->first();

        if (!$otpCode) {
            return response()->json(['error' => 'Invalid or expired OTP'], 401);
        }

        // Optionally, delete the OTP code after successful verification
        $otpCode->delete();

        // Proceed with login or whatever action is needed
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Issue access token using Laravel Passport or JWT
        $token = auth('api')->login($user);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'message' => 'Successfully Login',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], 200);
    }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request) {

        try {

            $validator = $request->validated();

            $user = User::create([
                'name'      => $validator['name'],
                'email'     => $validator['email'],
                'password'  => bcrypt($validator['password']),
            ]);

            $token = auth('api')->login($user);

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'message' => 'Successfully Register',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ],201);

        }
        catch (\Exception $ex) {
            return response()->json([
                'error' => 'Unable to save the user record, please refresh webpage and try again. If still problem persists contact with administrator'
            ], 401);
        }
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function login(Request $request)
    // {
    //     // Validate the incoming request
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email|exists:users,email',
    //         'password' => 'required',
    //         'otp' => 'nullable|digits:6', // Add OTP validation as optional
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()->first()], 422);
    //     }

    //     $credentials = $request->only(['email', 'password']);
    //     $requiresVerification = false;

    //     // Check if OTP is provided in the request
    //     if ($request->filled('otp')) {
    //         $otp = $request->input('otp');
    //         $otpCode = OtpCode::where('email', $credentials['email'])->where('otp', $otp)->first();

    //         if (!$otpCode) {
    //             return response()->json(['error' => 'Invalid OTP'], 401);
    //         }

    //         // Optionally, you can delete the OTP code after successful verification
    //         $otpCode->delete();
    //     } else {
    //         // If OTP is not provided in the request, set flag to require OTP verification
    //         $requiresVerification = true;
    //     }

    //     // Attempt to authenticate the user with email and password
    //     if (! $token = auth('api')->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'requiresVerification' => $requiresVerification, // Return flag indicating if OTP verification is required
    //         'expires_in' => auth('api')->factory()->getTTL() * 60
    //     ]);
    // }
    public function login(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'otp' => 'nullable|digits:6', // Add OTP validation as optional
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only(['email', 'password']);
        $requiresVerification = false;

        // Check if OTP is provided in the request
        if ($request->filled('otp')) {
            $otp = $request->input('otp');
            $otpCode = OtpCode::where('email', $credentials['email'])->where('otp', $otp)->first();

            if (!$otpCode) {
                return response()->json(['error' => 'Invalid OTP'], 401);
            }

            // Optionally, you can delete the OTP code after successful verification
            $otpCode->delete();
        } else {
            // If OTP is not provided in the request, set flag to require OTP verification
            $requiresVerification = true;
        }

        // Attempt to authenticate the user with email and password
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'requiresVerification' => $requiresVerification, // Return flag indicating if OTP verification is required
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'errors' => [] // Empty array for consistency
        ]);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
