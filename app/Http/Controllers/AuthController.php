<?php

namespace App\Http\Controllers;

use App\Http\Response\ApiResponse;
use App\Mail\OtpSending;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{

    protected $apiResponse;
    public function __construct(ApiResponse $apiResponse)
    {

        $this->apiResponse = $apiResponse;
    }
    public function sendOtp(Request $request)
    {

        $validate = $request->validate(["email" => "required", "password" => "required", "type" => "required", "deviceId" => 'required']);
        try {
            $user = User::where('email', $request->email)->first();
            $luser = $user && Hash::check($request->password,  $user->password );

            $isAnotherDevice = User::where('email', $request->email)
                ->where('deviceId', '!=', $request->deviceId)
                ->exists();

                
            $suser = User::where("email", $request->email)->first();
            if ($suser && $request->type === 'signup') {
                return $this->apiResponse->errorResponse("User Already Exist", 404);
            }
            if (!$luser && $request->type == 'login') {
                return $this->apiResponse->errorResponse("Wrong Crenditial Please Try Again", 404);
            }
            if ($isAnotherDevice && $request->type == 'login') {
                return $this->apiResponse->errorResponse("This account is login from another device", 500);
            }
            
            $otpCode = rand(100000, 999999);
            if ($validate) {
                Cache::put("otp_" . $request->email, $otpCode, 300);
                Mail::to($request->email)->send(new OtpSending($otpCode));
                return response()->json(['message' => 'OTP sent', 'otp' => $otpCode, 'code' => 200]);
            }
        } catch (\Exception $e) {
            return $this->apiResponse->errorResponse($e->getMessage(), 500);
        }

    }
    public function verifyOtp(Request $request)
    {
        $data = $request->validate(["email" => "required", "password" => "required", "otp" => "required", "type" => "required", "deviceId" => "required"]);
        try {
            $storedOtp = Cache::get(key: "otp_" . $request->email);
            
            if (Cache::has("otp_" . $request->email)) {
                if ($storedOtp != $request->otp) {
                    return response()->json(['message' => 'Invalid OTP'], 401);
                }
            } else {
                return $this->apiResponse->errorResponse("Otp not found", 500);
            }

            if ($request->type === "login") {
                $encryptedPassword = bcrypt($request->password);
              
                $user = User::where('email', $request->email)->get()->except(['password'])->first();
               
                $luser = $user && Hash::check($request->password,  $user->password );
                $isAnotherDevice = User::where("email", $request->email)->where("password", $encryptedPassword)->where("deviceId", $request->deviceId)->exists();
                if ($isAnotherDevice) {
                    return $this->apiResponse->errorResponse("This account is login from another device", 500);
                }
                if (!$luser) {
                    return $this->apiResponse->errorResponse("User not found with this email", 404);
                } else {
                   
                    $token = $user->createToken('burmesefoodieapplication')->plainTextToken;
                    $data=['user'=>$user,"token"=>$token];
                    return $this->apiResponse->successResponse($data, "Login Successfully", 200);
                }
            } else {
                $encryptedPassword = bcrypt($request->password);
                $user = User::where("email", $request->email)->get()->except(['password'])->first();
                if ($user) {
                    return $this->apiResponse->errorResponse("User Already Exist With This Email", 404);
                }
                $user = User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => $encryptedPassword,
                    "deviceId" => $request->deviceId
                ]);

                $token = $user->createToken('signIN')->plainTextToken;
               $data=['user'=>$user,"token"=>$token];
                return $this->apiResponse->successResponse($data, "Create account Successfully", 200);
            }
        } catch (\Exception $e) {
            return $this->apiResponse->errorResponse($e->getMessage(), 500);
        }

    }
}
