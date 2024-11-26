<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer_rank;
use Exception;

class CustomerController extends Controller
{

    const PATH_VIEW = 'admin.components.customer.';

    public function index()

    {
        $customers = Customer::with('customerRank')->get();
        return view(self::PATH_VIEW . 'index', compact('customers'));
    }

    public function create(){
        $customer_ranks = Customer_rank::all();
        return view(self::PATH_VIEW .'create', compact('customer_ranks'));
    }
    public function store(StoreLoginRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'number_phone' => $request->number_phone,
            'customer_rank_id'=> $request->customer_id,
        ];
        $data['customer_rank_id'] = 1;
        Customer::create($data);
        return redirect()->route('customer.index')->with('success', 'Đăng ký tài khoản thành công');
    }
}
