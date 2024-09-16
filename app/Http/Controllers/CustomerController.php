<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    const PATH_VIEW = 'client.components.customer.';


    public function index(){


    }
    
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
        return redirect()->route('khach-hang.login')->with('success', 'Đăng ký tài khoản thành công');
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
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
