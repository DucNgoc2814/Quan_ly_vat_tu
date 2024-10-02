<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    const PATH_VIEW = 'client.components.customer.';

    public function register()
    {
        return view(self::PATH_VIEW . 'register');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function handleRegister(StoreLoginRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'number_phone' => $request->number_phone,
        ];
        $data['customer_rank_id'] = 1;
        Customer::create($data);
        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công');
    }

    /**
     * Display the specified resource.
     */
    public function login()
    {
        return view(self::PATH_VIEW . 'login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function handleLogin(StoreLoginRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('register')->with('success', 'Đăng nhập thành công');
        }
        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function forgotPassword()
    {
        return view(self::PATH_VIEW . 'forgotPassword');
    }


    public function sendMaill(StoreLoginRequest $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }
        
        $otp = rand(100000, 999999);
        Mail::raw("Mã OTP của bạn là: {$otp}", function ($message) use ($request) {
            $message->to($request->email)->subject('Mã OTP để đặt lại mật khẩu');
        });
        session(['otp' => $otp, 'otp_email' => $request->email, 'otp_expires' => now()->addMinutes(1)]);
        return redirect()->route('showVerifyOtp');
    }


    public function showVerifyOtp()
    {
        return view(self::PATH_VIEW . 'verifyOtp');
    }

    public function verifyOtp(Request $request)
    {
        $storedOtp = session('otp');
        session(['email' => session('otp_email')]);
        if ($request->otp == $storedOtp) {
            session()->forget(['otp']);
            return redirect()->route('changepassword');
        }
        
        return back()->withErrors(['otp' => 'OTP không hợp lệ hoặc đã hết hạn.']);
    }

    //queb mat khau
    public function changepassword()
    {
        return view(self::PATH_VIEW . 'changepassword');

    }

    public function passwordchange(StoreLoginRequest $request)
    {
        try {
            Customer::where('email', session('email'))->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('login');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }
}
