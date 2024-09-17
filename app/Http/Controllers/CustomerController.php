<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    const PATH_VIEW = 'client.components.customer.';

    public function register()
    {
        return view(self::PATH_VIEW . 'register');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function handleRegister(StoreCustomerRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'number_phone' => $request->number_phone,
        ];
        $data['customer_rank_id'] = 1;
        Customer::create($data);
        return redirect()->route('khach-hang.dang-nhap')->with('success', 'Đăng ký tài khoản thành công');
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
    public function handleLogin(StoreCustomerRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('khach-hang.dang-ky')->with('success', 'Đăng nhập thành công');
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


    public function sendMaill(StoreCustomerRequest $request)
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
        return redirect()->route('khach-hang.nhap-otp');
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
            return redirect()->route('khach-hang.doi-mat-khau');
        }
        return back()->withErrors(['otp' => 'OTP không hợp lệ hoặc đã hết hạn.']);
    }


    public function changepassword()
    {
        return view(self::PATH_VIEW . 'changepassword');
    }

    public function passwordchange(StoreCustomerRequest $request)
    {
        try {
            Customer::where('email', session('email'))->update([
                'password' => bcrypt($request->password)
            ]);
            return redirect()->route('khach-hang.dang-nhap');
        } catch (Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }
}
