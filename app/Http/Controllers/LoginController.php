<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateLoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    const PATH_VIEW = 'client.components.customer.';

    public function home()
    {
        return view('index');
    }

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
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        }
        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Đăng xuất thành công');
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

    public function password()
    {
        return view(self::PATH_VIEW . 'password');
    }

    public function passwordUser(StoreLoginRequest $request)
    {
        try {
            $authUser  = Auth::user();
            $customer = Customer::find($authUser->id);
            // Lấy instance mới có thể write
            if (!Hash::check($request->old_password, $customer->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu hiện tại không chính xác']);
            }

            $customer->password = Hash::make($request->new_password);
            $customer->save();

            return redirect()->route('home')->with('success', 'Đổi mật khẩu thành công');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view(self::PATH_VIEW . 'profile', compact('user'));
    }

    public function profileUser()
    {
        $user = Auth::user();
        return view(self::PATH_VIEW . 'updateUser', compact('user'));
    }

    public function updateProfile(StoreLoginRequest $request)
    {
        try {
            $user = Auth::user();
            $data = [
                'name' => $request->nameupdate,
            ];

            if ($request->hasFile('image')) {
                if ($user->image && Storage::exists($user->image)) {
                    Storage::delete($user->image);
                }
                $data['image'] = Storage::put('customers', $request->file('image'));
            }
            Customer::where('id', $user->id)->update($data);
            return redirect()->route('profileUser')->with('success', 'Cập nhật thông tin thành công');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}
