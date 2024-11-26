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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    const PATH_VIEW = 'client.components.customer.';

    public function homeCustomer()
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
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            // Xác thực và tạo token
            if (!$token = JWTAuth::attempt($credentials)) {
                return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác']);
            }

            // Lấy thông tin user và lưu vào session
            $customer = Auth::user();
            Session::put([
                'token' => $token,
                'customer' => $customer,
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_image' => $customer->image
            ]);

            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Hệ thống đang gặp sự cố, vui lòng thử lại sau']);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Vô hiệu hóa token hiện tại
            $token = Session::get('token');
            if ($token) {
                JWTAuth::setToken($token)->invalidate();
            }

            // Xóa toàn bộ session
            Session::forget(['token', 'customer', 'customer_id', 'customer_name', 'customer_email', 'customer_image']);
            Session::flush();

            // Đăng xuất user
            Auth::logout();

            // Tạo mới session token
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'Đăng xuất thành công');
        } catch (Exception $e) {
            return redirect()->route('home')->with('success', 'Đăng xuất thành công');
        }
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
            $customer = Customer::find(Session::get('customer_id'));

            // Xác minh mật khẩu cũ
            if (!Hash::check($request->old_password, $customer->password)) {
                return back()->withErrors(['old_password' => 'Mật khẩu hiện tại không chính xác']);
            }

            // Cập nhật mật khẩu
            $customer->update([
                'password' => Hash::make($request->new_password)
            ]);

            // Nhận mã thông báo mới sau khi thay đổi mật khẩu
            $credentials = [
                'email' => $customer->email,
                'password' => $request->new_password
            ];

            $token = JWTAuth::attempt($credentials);

            // Cập nhật phiên với mã thông báo mới
            Session::put('token', $token);

            return redirect()->route('home')->with('success', 'Đổi mật khẩu thành công');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }


    public function profile()
    {
        $user = Customer::find(Session::get('customer_id'));
        return view(self::PATH_VIEW . 'profile', compact('user'));
    }


    public function profileUser()
    {
        $user = Customer::find(Session::get('customer_id'));
        return view(self::PATH_VIEW . 'updateUser', compact('user'));
    }



    public function updateProfile(StoreLoginRequest $request)
    {
        try {
            $user = Customer::find(Session::get('customer_id')); // Get user from session ID

            $data = [
                'name' => $request->name,
            ];

            if ($request->hasFile('image')) {
                if ($user->image && Storage::exists($user->image)) {
                    Storage::delete($user->image);
                }
                $data['image'] = Storage::put('customers', $request->file('image'));
                Session::put('customer_image', $data['image']);
            }

            // Update customer record
            $user->update($data);

            // Update session data
            Session::put('customer_name', $data['name']);
            Session::put('customer', $user->fresh());

            return redirect()->route('profileUser')->with('success', 'Cập nhật thông tin thành công');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}
